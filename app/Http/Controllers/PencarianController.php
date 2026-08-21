<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Dokumen;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));

        if (empty($query)) {
            return view('pages.pencarian', [
                'query' => '',
                'beritas' => collect(),
                'kegiatans' => collect(),
                'dokumens' => collect(),
                'anggotas' => collect(),
                'totalResults' => 0,
            ]);
        }

        // Scout search on database driver
        $beritas = Berita::search($query)->get();
        $kegiatans = Kegiatan::search($query)->get();
        $dokumens = Dokumen::search($query)->get();
        $anggotas = Anggota::search($query)->get();

        $totalResults = $beritas->count() + $kegiatans->count() + $dokumens->count() + $anggotas->count();

        return view('pages.pencarian', compact(
            'query', 'beritas', 'kegiatans', 'dokumens', 'anggotas', 'totalResults'
        ));
    }
}
