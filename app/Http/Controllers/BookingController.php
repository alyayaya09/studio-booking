<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Photographer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Menampilkan form pesan sesi dengan daftar paket yang aktif
    public function create()
    {
        $packages = Package::where('is_active', true)->get();

        return view('booking.create', compact('packages'));
    }

    // Menampilkan halaman "Booking Saya": hanya booking milik user yang login
    public function index(Request $request)
    {
        $bookings = Booking::with(['package', 'photographer'])
            ->where('user_id', $request->user()->id)
            ->latest('booking_date')
            ->latest('start_time')
            ->get();

        return view('booking.index', compact('bookings'));
    }

    // Memproses pemesanan sesi foto
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $data = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:500'],
        ]);

        // Hanya paket yang aktif yang boleh dipesan
        $package = Package::where('is_active', true)->findOrFail($data['package_id']);

        // 2. Hitung jam mulai dan jam selesai berdasarkan durasi paket
        $date = Carbon::parse($data['booking_date']);
        $start = Carbon::parse($data['booking_date'] . ' ' . $data['start_time']);
        $end = $start->copy()->addMinutes($package->duration_minutes);

        // 3. Cek jam operasional
        // Senin-Sabtu 09.00-20.00, Minggu 10.00-17.00
        $open = $date->copy()->setTime($date->isSunday() ? 10 : 9, 0);
        $close = $date->copy()->setTime($date->isSunday() ? 17 : 20, 0);

        // Tolak jika jam mulai sudah lewat (untuk booking hari ini)
        if ($start->isPast()) {
            return back()->withErrors(['start_time' => 'Jam mulai sudah lewat.'])->withInput();
        }

        // Tolak jika sesi mulai sebelum buka atau selesai setelah tutup
        if ($start->lt($open) || $end->gt($close)) {
            return back()->withErrors([
                'start_time' => 'Sesi harus selesai dalam jam operasional ('
                    . $open->format('H.i') . ' - ' . $close->format('H.i') . ').',
            ])->withInput();
        }

        // 4. Cek fotografer yang bentrok
        // Ambil fotografer pertama yang tidak punya booking bertabrakan.
        // Dua jadwal dianggap bentrok jika:
        //   jam mulai booking lama < jam selesai booking baru
        //   DAN jam selesai booking lama > jam mulai booking baru.
        // Booking yang berstatus cancelled tidak dihitung.
        $photographer = Photographer::all()->first(function ($p) use ($data, $start, $end) {
            return ! Booking::where('photographer_id', $p->id)
                ->whereDate('booking_date', $data['booking_date'])
                ->where('status', '!=', 'cancelled')
                ->where('start_time', '<', $end->format('H:i:s'))
                ->where('end_time', '>', $start->format('H:i:s'))
                ->exists();
        });

        // Jika semua fotografer bentrok, minta user memilih jam lain
        if (! $photographer) {
            return back()->withErrors([
                'start_time' => 'Semua fotografer sudah penuh di jam itu. Coba pilih jam lain.',
            ])->withInput();
        }

        // 5. Simpan booking dengan status awal pending
        Booking::create([
            'user_id' => $request->user()->id,
            'package_id' => $package->id,
            'photographer_id' => $photographer->id,
            'booking_date' => $data['booking_date'],
            'start_time' => $start->format('H:i:s'),
            'end_time' => $end->format('H:i:s'),
            'status' => 'pending',
            'total_price' => $package->price,
            'notes' => $data['notes'] ?? null,
        ]);

        return redirect()->route('booking.create')->with('status', 'Booking berhasil dibuat.');
    }
}