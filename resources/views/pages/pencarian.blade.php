@extends('layouts.ismy')

@section('content')
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Search Header & Bar -->
        <div class="text-center space-y-4">
            <span class="text-xs font-semibold text-secondary uppercase tracking-widest block">Fitur Pencarian</span>
            <h1 class="text-3xl font-serif font-bold text-primary">Hasil Pencarian</h1>
            
            <form action="{{ route('pencarian') }}" method="GET" class="max-w-2xl mx-auto flex gap-2">
                <input type="text" name="q" value="{{ $query }}" placeholder="Ketik kata kunci pencarian..." class="flex-grow rounded-xl border-emerald-light px-5 py-3 text-sm focus:ring-2 focus:ring-secondary focus:outline-none bg-white card-shadow">
                <button type="submit" class="btn-primary px-6 py-3 text-sm font-bold shadow-sm">
                    Cari
                </button>
            </form>

            @if($query)
                <p class="text-sm text-on-surface-variant">
                    Menampilkan <strong class="text-primary">{{ $totalResults }}</strong> hasil untuk kata kunci "<span class="italic text-secondary font-semibold">{{ $query }}</span>"
                </p>
            @endif
        </div>

        @if($query && $totalResults === 0)
            <div class="bg-white rounded-2xl p-12 text-center card-shadow border-emerald-light space-y-3">
                <span class="material-symbols-outlined text-4xl text-gray-400">search_off</span>
                <h3 class="text-lg font-bold text-primary">Tidak Ditemukan Hasil</h3>
                <p class="text-sm text-on-surface-variant max-w-md mx-auto">
                    Coba gunakan kata kunci yang lebih umum atau periksa kembali ejaan Anda.
                </p>
            </div>
        @endif

        <!-- Berita Results -->
        @if($beritas->count() > 0)
            <div class="space-y-4">
                <h2 class="text-xl font-serif font-bold text-primary flex items-center gap-2 border-b border-emerald-light pb-2">
                    <span class="material-symbols-outlined text-sm">newspaper</span> Berita & Artikel ({{ $beritas->count() }})
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    @foreach($beritas as $b)
                        <div class="bg-white rounded-xl p-5 card-shadow border-emerald-light space-y-2">
                            <span class="text-xs text-secondary font-semibold">{{ $b->kategori->nama ?? 'Berita' }}</span>
                            <h3 class="font-serif font-bold text-primary text-base">
                                <a href="{{ route('berita.detail', $b->slug) }}" class="hover:underline">
                                    {{ $b->judul }}
                                </a>
                            </h3>
                            <p class="text-xs text-on-surface-variant line-clamp-2">{{ strip_tags($b->konten) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Kegiatan Results -->
        @if($kegiatans->count() > 0)
            <div class="space-y-4">
                <h2 class="text-xl font-serif font-bold text-primary flex items-center gap-2 border-b border-emerald-light pb-2">
                    <span class="material-symbols-outlined text-sm">event</span> Kegiatan & Agenda ({{ $kegiatans->count() }})
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    @foreach($kegiatans as $k)
                        <div class="bg-white rounded-xl p-5 card-shadow border-emerald-light space-y-2">
                            <span class="text-xs text-gray-500">📅 {{ $k->tanggal ? $k->tanggal->format('d M Y') : '' }} | 📍 {{ $k->lokasi }}</span>
                            <h3 class="font-serif font-bold text-primary text-base">{{ $k->judul }}</h3>
                            <p class="text-xs text-on-surface-variant line-clamp-2">{{ $k->deskripsi }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Dokumen Results -->
        @if($dokumens->count() > 0)
            <div class="space-y-4">
                <h2 class="text-xl font-serif font-bold text-primary flex items-center gap-2 border-b border-emerald-light pb-2">
                    <span class="material-symbols-outlined text-sm">description</span> Dokumen ({{ $dokumens->count() }})
                </h2>
                <div class="space-y-2">
                    @foreach($dokumens as $d)
                        <div class="bg-white rounded-xl p-4 card-shadow border-emerald-light flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-primary text-sm">{{ $d->judul }}</h4>
                                <p class="text-xs text-on-surface-variant">{{ $d->deskripsi }}</p>
                            </div>
                            <a href="{{ asset('storage/' . $d->file_path) }}" class="btn-secondary px-3 py-1.5 text-xs flex items-center gap-1" download>
                                <span class="material-symbols-outlined text-xs">download</span> Unduh
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Anggota Results (Public Info Only) -->
        @if($anggotas->count() > 0)
            <div class="space-y-4">
                <h2 class="text-xl font-serif font-bold text-primary flex items-center gap-2 border-b border-emerald-light pb-2">
                    <span class="material-symbols-outlined text-sm">badge</span> Direktori Anggota Publik ({{ $anggotas->count() }})
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-md">
                    @foreach($anggotas as $a)
                        <div class="bg-white rounded-xl p-4 card-shadow border-emerald-light flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold">
                                {{ substr($a->nama_lengkap, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-primary text-sm">{{ $a->nama_lengkap }}</h4>
                                <p class="text-xs text-secondary font-semibold">{{ $a->bidang_keahlian ?? 'Sarjana Melayu' }}</p>
                                <span class="text-[10px] text-gray-400">No. Anggota: {{ $a->nomor_anggota ?? 'ISMY-PROV' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
