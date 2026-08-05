<?php

namespace App\Http\Controllers;

use App\Http\Requests\PengaturanSekolahRequest;
use App\Models\PengaturanSekolah;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengaturanSekolahController extends Controller
{
    public function edit(): View
    {
        $pengaturan = PengaturanSekolah::first();

        return view('pengaturan.edit', compact('pengaturan'));
    }

    public function update(PengaturanSekolahRequest $request): RedirectResponse
    {
        $pengaturan = PengaturanSekolah::first();
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($pengaturan && $pengaturan->logo) {
                Storage::disk('public')->delete($pengaturan->logo);
            }
            $data['logo'] = $request->file('logo')->store('logo-sekolah', 'public');
        }

        if ($pengaturan) {
            $pengaturan->update($data);
        } else {
            PengaturanSekolah::create($data);
        }

        ActivityLogService::catat('Memperbarui pengaturan sekolah', 'Pengaturan Sekolah');

        return redirect()->route('pengaturan.edit')->with('success', 'Pengaturan sekolah berhasil diperbarui.');
    }
}
