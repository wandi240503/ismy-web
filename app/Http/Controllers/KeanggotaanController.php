<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranAnggota;
use Illuminate\Http\Request;

class KeanggotaanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'pendidikan_terakhir' => 'required|string|max:100',
            'bidang_keahlian' => 'required|string|max:100',
            'foto' => 'nullable|image|max:2048',
            'ktp' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pendaftaran/foto', 'public');
        }

        if ($request->hasFile('ktp')) {
            $validated['ktp'] = $request->file('ktp')->store('pendaftaran/ktp', 'public');
        }

        PendaftaranAnggota::create($validated);

        return back()->with('success', 'Pendaftaran Anda telah berhasil dikirim! Tim kami akan meninjau berkas Anda.');
    }
}
