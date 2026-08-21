<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Pengurus;
use App\Models\Wilayah;
use App\Models\Dokumen;
use App\Models\Faq;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function beranda()
    {
        $beritas = Berita::with('kategori')->latest('tanggal_terbit')->take(4)->get();
        $kegiatans = Kegiatan::where('tanggal', '>=', now())->orderBy('tanggal')->take(3)->get();
        $pengurusInti = Pengurus::with('jabatan')->orderBy('urutan')->take(4)->get();
        $wilayahs = Wilayah::all();

        return view('pages.beranda', compact('beritas', 'kegiatans', 'pengurusInti', 'wilayahs'));
    }

    public function tentangKami()
    {
        $dokumenAdArt = Dokumen::where('kategori', 'ad_art')->first();
        $faqs = Faq::orderBy('urutan')->get();

        return view('pages.tentang-kami', compact('dokumenAdArt', 'faqs'));
    }

    public function strukturOrganisasi()
    {
        $penguruses = Pengurus::with('jabatan')->orderBy('urutan')->get();
        $wilayahs = Wilayah::all();

        return view('pages.struktur-organisasi', compact('penguruses', 'wilayahs'));
    }

    public function keanggotaan()
    {
        $wilayahs = Wilayah::all();

        return view('pages.keanggotaan', compact('wilayahs'));
    }

    public function berita(Request $request)
    {
        $query = Berita::with('kategori');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $beritas = $query->latest('tanggal_terbit')->paginate(6)->withQueryString();
        $beritaUtama = Berita::with('kategori')->latest('tanggal_terbit')->first();
        $kategoriList = \App\Models\KategoriBerita::all();

        return view('pages.berita', compact('beritas', 'beritaUtama', 'kategoriList'));
    }

    public function beritaDetail($slug)
    {
        $berita = Berita::with('kategori')->where('slug', $slug)->firstOrFail();
        $berita->increment('view_count');

        $beritaTerkait = Berita::where('id', '!=', $berita->id)
            ->where('kategori_berita_id', $berita->kategori_berita_id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.berita-detail', compact('berita', 'beritaTerkait'));
    }

    public function verifikasiKta($nomor)
    {
        $anggota = \App\Models\Anggota::with(['wilayah', 'kegiatan' => function($q) {
            $q->latest('tanggal');
        }])->where('nomor_anggota', $nomor)->firstOrFail();

        $kegiatanTerkini = Kegiatan::where('tanggal', '>=', now()->subDays(30))->orderBy('tanggal')->get();

        return view('pages.verifikasi-kta', compact('anggota', 'kegiatanTerkini'));
    }

    public function presensiDariScan(Request $request, $nomor)
    {
        $anggota = \App\Models\Anggota::where('nomor_anggota', $nomor)->firstOrFail();
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
        ]);

        $kegiatan = Kegiatan::findOrFail($request->kegiatan_id);
        $kegiatan->anggota()->syncWithoutDetaching([
            $anggota->id => ['status' => 'hadir'],
        ]);

        return back()->with('success', 'Presensi kehadiran ' . $anggota->nama_lengkap . ' pada acara "' . $kegiatan->judul . '" berhasil dicatat!');
    }
}
