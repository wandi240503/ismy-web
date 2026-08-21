@extends('layouts.ismy')

@section('content')
<!-- Header Banner -->
<section class="py-xl px-gutter bg-primary text-white text-center">
    <div class="max-w-container-max mx-auto">
        <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-2">Pusat Informasi</span>
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Berita & Artikel</h1>
        <p class="text-emerald-100 max-w-2xl mx-auto text-base">
            Ikuti perkembangan terkini, opini akademis, dan ragam kegiatan Ikatan Sarjana Melayu Yogyakarta.
        </p>
    </div>
</section>

<!-- Filter & Search Bar Section -->
<section class="py-md px-gutter bg-warm-cream border-b border-emerald-light">
    <div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        <!-- Category Filter Pills -->
        <div class="flex flex-wrap gap-2 overflow-x-auto w-full md:w-auto py-1">
            <a href="{{ route('berita') }}" class="{{ !request('kategori') ? 'bg-primary text-white font-bold' : 'bg-white text-on-surface border border-emerald-light hover:bg-primary/10' }} px-4 py-2 rounded-full text-xs transition-colors">
                Semua
            </a>
            @if(isset($kategoriList) && $kategoriList->count() > 0)
                @foreach($kategoriList as $kat)
                    <a href="{{ route('berita', ['kategori' => $kat->slug]) }}" class="{{ request('kategori') == $kat->slug ? 'bg-primary text-white font-bold' : 'bg-white text-on-surface border border-emerald-light hover:bg-primary/10' }} px-4 py-2 rounded-full text-xs transition-colors">
                        {{ $kat->nama }}
                    </a>
                @endforeach
            @else
                <a href="{{ route('berita', ['kategori' => 'kegiatan']) }}" class="{{ request('kategori') == 'kegiatan' ? 'bg-primary text-white font-bold' : 'bg-white text-on-surface border border-emerald-light hover:bg-primary/10' }} px-4 py-2 rounded-full text-xs transition-colors">
                    Kegiatan
                </a>
                <a href="{{ route('berita', ['kategori' => 'pengumuman']) }}" class="{{ request('kategori') == 'pengumuman' ? 'bg-primary text-white font-bold' : 'bg-white text-on-surface border border-emerald-light hover:bg-primary/10' }} px-4 py-2 rounded-full text-xs transition-colors">
                    Pengumuman
                </a>
                <a href="{{ route('berita', ['kategori' => 'opini']) }}" class="{{ request('kategori') == 'opini' ? 'bg-primary text-white font-bold' : 'bg-white text-on-surface border border-emerald-light hover:bg-primary/10' }} px-4 py-2 rounded-full text-xs transition-colors">
                    Opini
                </a>
            @endif
        </div>

        <!-- Search Bar -->
        <form action="{{ route('pencarian') }}" method="GET" class="w-full md:w-72">
            <div class="relative">
                <input type="text" name="q" placeholder="Cari berita..." class="w-full rounded-full border-emerald-light pl-4 pr-10 py-2 text-xs focus:ring-2 focus:ring-secondary focus:outline-none bg-white">
                <button type="submit" class="absolute right-3 top-2 text-gray-400 hover:text-primary">
                    <span class="material-symbols-outlined text-sm">search</span>
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Content Grid Section -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto space-y-lg">
        
        <!-- Featured Main Article Card -->
        @if(isset($beritaUtama) && $beritaUtama)
            <div class="bg-white rounded-2xl overflow-hidden card-shadow border-emerald-light grid md:grid-cols-12 gap-0 transition-transform duration-200 hover:-translate-y-1">
                <div class="md:col-span-7 h-72 md:h-full relative overflow-hidden bg-gray-100">
                    <img src="{{ $beritaUtama->gambar ? asset('storage/' . $beritaUtama->gambar) : asset('images/img_04.jpg') }}" alt="{{ $beritaUtama->judul }}" class="w-full h-full object-cover">
                </div>
                <div class="md:col-span-5 p-8 flex flex-col justify-center">
                    <span class="bg-secondary/20 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full w-fit mb-3">
                        {{ $beritaUtama->kategori->nama ?? 'Kebudayaan' }}
                    </span>
                    <h2 class="font-serif font-bold text-2xl text-primary mb-3 leading-snug">
                        <a href="{{ route('berita.detail', $beritaUtama->slug) }}" class="hover:text-secondary transition-colors">
                            {{ $beritaUtama->judul }}
                        </a>
                    </h2>
                    <p class="text-sm text-on-surface-variant line-clamp-3 mb-6">
                        {{ Str::limit(strip_tags($beritaUtama->konten), 160) }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-gray-500 pt-4 border-t border-gray-100">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">person</span> {{ $beritaUtama->penulis ?? 'Dr. Ahmad Zulkifli' }}
                        </span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">calendar_today</span> {{ $beritaUtama->tanggal_terbit ? $beritaUtama->tanggal_terbit->format('d M Y') : '04 Okt 2024' }}
                        </span>
                    </div>
                </div>
            </div>
        @else
            <!-- Fallback Stitch Hero Article -->
            <div class="bg-white rounded-2xl overflow-hidden card-shadow border-emerald-light grid md:grid-cols-12 gap-0">
                <div class="md:col-span-7 h-72 md:h-96 relative overflow-hidden">
                    <img src="{{ asset('images/img_04.jpg') }}" alt="Simposium Nasional" class="w-full h-full object-cover">
                </div>
                <div class="md:col-span-5 p-8 flex flex-col justify-between">
                    <div>
                        <span class="bg-secondary/20 text-gray-900 text-xs font-semibold px-3 py-1 rounded-full w-fit block mb-3">Kebudayaan</span>
                        <h2 class="font-serif font-bold text-2xl text-primary mb-3">Simposium Nasional Kebudayaan Melayu di Era Digital</h2>
                        <p class="text-sm text-on-surface-variant mb-4">ISMY sukses menyelenggarakan simposium tahunan yang mengumpulkan ratusan cendekiawan untuk membahas tantangan dan peluang kelestarian budaya.</p>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500 pt-4 border-t border-gray-100">
                        <span>👤 Dr. Ahmad Zulkifli</span>
                        <span>📅 04 Okt 2024</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- News Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-md">
            @forelse($beritas as $index => $b)
                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col transition-transform duration-200 hover:-translate-y-1">
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        <img src="{{ $b->gambar ? asset('storage/' . $b->gambar) : asset('images/img_0' . (($index % 5) + 4) . '.jpg') }}" alt="{{ $b->judul }}" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                            {{ $b->kategori->nama ?? 'Opini' }}
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2 block">{{ $b->tanggal_terbit ? $b->tanggal_terbit->format('d M Y') : '20 Okt 2024' }}</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2 line-clamp-2">
                            <a href="{{ route('berita.detail', $b->slug) }}" class="hover:text-secondary transition-colors">
                                {{ $b->judul }}
                            </a>
                        </h3>
                        <p class="text-sm text-on-surface-variant line-clamp-3 mb-4 flex-grow">
                            {{ Str::limit(strip_tags($b->konten), 120) }}
                        </p>
                        <a href="{{ route('berita.detail', $b->slug) }}" class="text-sm font-semibold text-primary hover:text-secondary flex items-center gap-1">
                            Baca Selengkapnya <span class="material-symbols-outlined text-xs">chevron_right</span>
                        </a>
                    </div>
                </div>
            @empty
                <!-- Fallback Stitch Cards -->
                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/img_05.jpg') }}" alt="Sastra Klasik" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-2.5 py-1 rounded-full">Opini</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2">20 Okt 2024</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2">Relevansi Sastra Klasik dalam Kurikulum Perguruan Tinggi</h3>
                        <p class="text-sm text-on-surface-variant mb-4">Mengkaji ulang pentingnya karya sastra lampau sebagai fondasi pemikiran kritis sarjana muda.</p>
                        <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary">Baca Selengkapnya →</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/img_06.jpg') }}" alt="Beasiswa Riset" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-secondary text-gray-900 text-xs font-semibold px-2.5 py-1 rounded-full">Pengumuman</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2">18 Okt 2024</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2">Pembukaan Pendaftaran Beasiswa Riset Budaya Melayu</h3>
                        <p class="text-sm text-on-surface-variant mb-4">ISMY kembali membuka program beasiswa penelitian untuk mahasiswa S2 dan S3 di Yogyakarta.</p>
                        <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary">Baca Selengkapnya →</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/img_13.jpg') }}" alt="Penghargaan Jurnal" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-primary-container text-white text-xs font-semibold px-2.5 py-1 rounded-full">Prestasi</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2">16 Okt 2024</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2">Penghargaan Internasional untuk Publikasi Jurnal Anggota</h3>
                        <p class="text-sm text-on-surface-variant mb-4">Tiga anggota ISMY menerima penghargaan Best Paper dalam Konferensi Kebudayaan Asia.</p>
                        <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary">Baca Selengkapnya →</a>
                    </div>
                </div>

                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/img_14.jpg') }}" alt="FGD Situs Bersejarah" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-2.5 py-1 rounded-full">Kegiatan</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2">13 Okt 2024</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2">FGD: Pemetaan Situs Bersejarah di Pesisir Jawa</h3>
                        <p class="text-sm text-on-surface-variant mb-4">Diskusi kelompok terpumpun melibatkan ahli geografi dan sejarawan untuk merekamJejak maritim.</p>
                        <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary">Baca Selengkapnya →</a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($beritas) && $beritas instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="pt-6">
                {{ $beritas->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
