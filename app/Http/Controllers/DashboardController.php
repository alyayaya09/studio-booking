<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Photographer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->is_admin) {
            $stats = [
                'total' => Booking::count(),
                'pending' => Booking::where('status', 'pending')->count(),
                'confirmed' => Booking::where('status', 'confirmed')->count(),
                'revenue' => Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price'),
                'packages' => Package::count(),
                'photographers' => Photographer::count(),
            ];

            $latest = Booking::with(['user', 'package'])
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard', compact('stats', 'latest'));
        }

        $upcoming = Booking::with(['package', 'photographer'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereDate('booking_date', '>=', today())
            ->orderBy('booking_date')
            ->orderBy('start_time')
            ->first();

        $myTotal = Booking::where('user_id', $user->id)->count();

        return view('dashboard', compact('upcoming', 'myTotal'));
    }
}