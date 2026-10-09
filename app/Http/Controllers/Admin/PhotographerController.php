<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photographer;
use Illuminate\Http\Request;

class PhotographerController extends Controller
{
    public function index()
    {
        $photographers = Photographer::latest()->paginate(10);

        return view('admin.photographers.index', compact('photographers'));
    }

    public function create()
    {
        return view('admin.photographers.create');
    }

    public function store(Request $request)
    {
        Photographer::create($this->validated($request));

        return redirect()->route('admin.photographers.index')
            ->with('success', 'Fotografer berhasil ditambahkan.');
    }

    public function edit(Photographer $photographer)
    {
        return view('admin.photographers.edit', compact('photographer'));
    }

    public function update(Request $request, Photographer $photographer)
    {
        $photographer->update($this->validated($request));

        return redirect()->route('admin.photographers.index')
            ->with('success', 'Fotografer berhasil diperbarui.');
    }

    public function destroy(Photographer $photographer)
    {
        if ($photographer->bookings()->exists()) {
            return back()->with('error', 'Fotografer tidak bisa dihapus karena sudah punya booking. Nonaktifkan saja.');
        }

        $photographer->delete();

        return redirect()->route('admin.photographers.index')
            ->with('success', 'Fotografer berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}