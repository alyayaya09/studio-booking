<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    // Daftar semua paket
    public function index()
    {
        $packages = Package::latest()->paginate(10);

        return view('admin.packages.index', compact('packages'));
    }

    // Form tambah paket
    public function create()
    {
        return view('admin.packages.create');
    }

    // Simpan paket baru
    public function store(Request $request)
    {
        $data = $this->validated($request);

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    // Form edit paket
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    // Simpan perubahan paket
    public function update(Request $request, Package $package)
    {
        $package->update($this->validated($request));

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    // Hapus paket (ditolak jika sudah punya booking)
    public function destroy(Package $package)
    {
        if ($package->bookings()->exists()) {
            return back()->with('error', 'Paket tidak bisa dihapus karena sudah punya booking. Nonaktifkan saja.');
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus.');
    }

    // Aturan validasi dipakai bersama oleh store dan update
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
           'duration_minutes' => ['required', 'integer', 'min:15', 'max:480'],
        ]);

        // Checkbox tidak terkirim kalau tidak dicentang
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}