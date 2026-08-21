@extends('layouts.ismy')

@section('content')
<!-- Hero Section -->
<section class="relative pt-xl pb-xl px-gutter overflow-hidden bg-warm-cream">
    <!-- Subtle Background Motif -->
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('{{ asset('images/img_10.jpg') }}'); background-repeat: repeat;"></div>
    
    <div class="max-w-container-max mx-auto grid md:grid-cols-2 gap-lg items-center relative z-10">
        <div class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-serif font-bold text-primary-container leading-tight">
                Menyatukan Cendekiawan Melayu di Yogyakarta
            </h1>
            <p class="text-lg text-on-surface-variant max-w-lg leading-relaxed">
                Membangun sinergi, melestarikan budaya, dan memajukan intelektualitas sarjana Melayu demi kontribusi nyata bagi nusa dan bangsa.
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a class="btn-primary px-6 py-3 text-sm flex items-center gap-2 shadow-sm transition-transform duration-150 hover:scale-95" href="{{ route('keanggotaan') }}">
                    Gabung Sekarang <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
                <a class="btn-secondary px-6 py-3 text-sm transition-transform duration-150 hover:scale-95" href="{{ route('tentang-kami') }}">
                    Tentang Kami
                </a>
            </div>
        </div>

        <!-- Overlapping Image Cards -->
        <div class="relative hidden md:block h-[450px]">
            <div class="absolute right-0 top-0 w-4/5 h-4/5 rounded-2xl overflow-hidden card-shadow border-emerald-light z-20">
                <img class="w-full h-full object-cover" src="{{ asset('images/img_01.jpg') }}" alt="Cendekiawan Melayu ISMY"/>
            </div>
            <div class="absolute left-0 bottom-0 w-3/5 h-3/5 rounded-2xl overflow-hidden card-shadow border-emerald-light z-30">
                <img class="w-full h-full object-cover" src="{{ asset('images/img_09.jpg') }}" alt="Diskusi Akademis ISMY"/>
            </div>
            <!-- Decorative Gold Accent -->
            <div class="absolute -right-4 -bottom-4 w-32 h-32 border-4 border-secondary-container rounded-full opacity-40 z-10"></div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-lg px-gutter bg-white border-y border-emerald-light">
    <div class="max-w-container-max mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-md">
            <!-- Stat 1 -->
            <div class="flex flex-col items-center text-center p-sm">
                <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center mb-3 text-primary-container">
                    <span class="material-symbols-outlined text-2xl">group</span>
                </div>
                <h3 class="text-3xl font-serif font-bold text-primary-container">500+</h3>
                <p class="text-sm font-semibold text-on-surface-variant">Anggota Aktif</p>
            </div>
            <!-- Stat 2 -->
            <div class="flex flex-col items-center text-center p-sm">
                <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center mb-3 text-primary-container">
                    <span class="material-symbols-outlined text-2xl">location_on</span>
                </div>
                <h3 class="text-3xl font-serif font-bold text-primary-container">{{ $wilayahs->count() > 0 ? $wilayahs->count() : '12' }}</h3>
                <p class="text-sm font-semibold text-on-surface-variant">Cabang Daerah</p>
            </div>
            <!-- Stat 3 -->
            <div class="flex flex-col items-center text-center p-sm">
                <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center mb-3 text-primary-container">
                    <span class="material-symbols-outlined text-2xl">event</span>
                </div>
                <h3 class="text-3xl font-serif font-bold text-primary-container">50+</h3>
                <p class="text-sm font-semibold text-on-surface-variant">Kegiatan Tahunan</p>
            </div>
            <!-- Stat 4 -->
            <div class="flex flex-col items-center text-center p-sm">
                <div class="w-12 h-12 rounded-full bg-primary-container/10 flex items-center justify-center mb-3 text-primary-container">
                    <span class="material-symbols-outlined text-2xl">verified</span>
                </div>
                <h3 class="text-3xl font-serif font-bold text-primary-container">1998</h3>
                <p class="text-sm font-semibold text-on-surface-variant">Tahun Berdiri</p>
            </div>
        </div>
    </div>
</section>

<!-- Berita Terkini Section -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto">
        <div class="flex justify-between items-end mb-lg">
            <div>
                <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-1">Informasi & Artikel</span>
                <h2 class="text-3xl font-serif font-bold text-primary-container">Kabar ISMY Terbaru</h2>
            </div>
            <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary flex items-center gap-1">
                Lihat Semua Berita <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-md">
            @forelse($beritas as $index => $b)
                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col transition-transform duration-200 hover:-translate-y-1">
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        <img src="{{ $b->gambar ? asset('storage/' . $b->gambar) : asset('images/img_0' . (($index % 5) + 4) . '.jpg') }}" alt="{{ $b->judul }}" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-primary text-white text-xs font-semibold px-2.5 py-1 rounded-full">
                            {{ $b->kategori->nama ?? 'Kegiatan' }}
                        </span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2 block">{{ $b->tanggal_terbit ? $b->tanggal_terbit->format('d M Y') : '04 Okt 2024' }}</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2 line-clamp-2">
                            <a href="{{ route('berita.detail', $b->slug ?? 'slug') }}" class="hover:text-secondary transition-colors">
                                {{ $b->judul }}
                            </a>
                        </h3>
                        <p class="text-sm text-on-surface-variant line-clamp-3 mb-4 flex-grow">
                            {{ Str::limit(strip_tags($b->konten), 120) }}
                        </p>
                        <a href="{{ route('berita.detail', $b->slug ?? 'slug') }}" class="text-sm font-semibold text-primary hover:text-secondary flex items-center gap-1">
                            Baca Selengkapnya <span class="material-symbols-outlined text-xs">chevron_right</span>
                        </a>
                    </div>
                </div>
            @empty
                <!-- Fallback static cards matching Stitch design -->
                <div class="bg-white rounded-xl overflow-hidden card-shadow border-emerald-light flex flex-col">
                    <div class="h-48 overflow-hidden relative">
                        <img src="{{ asset('images/img_04.jpg') }}" alt="Simposium Kebudayaan" class="w-full h-full object-cover">
                        <span class="absolute top-3 left-3 bg-secondary text-gray-900 text-xs font-semibold px-2.5 py-1 rounded-full">Kebudayaan</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2">04 Okt 2024</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2">Simposium Nasional Kebudayaan Melayu di Era Digital</h3>
                        <p class="text-sm text-on-surface-variant mb-4">ISMY sukses menyelenggarakan simposium tahunan mengumpulkan cendekiawan membicarakan tantangan era digital.</p>
                        <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary">Baca Selengkapnya →</a>
                    </div>
                </div>
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
                        <span class="absolute top-3 left-3 bg-primary-container text-white text-xs font-semibold px-2.5 py-1 rounded-full">Pengumuman</span>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs text-gray-500 mb-2">18 Okt 2024</span>
                        <h3 class="font-serif font-bold text-lg text-primary mb-2">Pembukaan Pendaftaran Beasiswa Riset Budaya Melayu</h3>
                        <p class="text-sm text-on-surface-variant mb-4">ISMY kembali membuka program beasiswa penelitian untuk mahasiswa S2 dan S3 di Yogyakarta.</p>
                        <a href="{{ route('berita') }}" class="text-sm font-semibold text-primary hover:text-secondary">Baca Selengkapnya →</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-xl px-gutter bg-primary text-white text-center relative overflow-hidden">
    <div class="max-w-container-max mx-auto relative z-10">
        <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4">Siap Bergabung dengan Komunitas Sarjana Melayu?</h2>
        <p class="text-emerald-100 max-w-2xl mx-auto mb-8 text-base">
            Daftarkan diri Anda untuk memperluas jaringan intelektual, mengikuti kegiatan kebudayaan, dan berkontribusi nyata.
        </p>
        <a href="{{ route('keanggotaan') }}" class="btn-primary px-8 py-3 text-base inline-flex items-center gap-2 shadow-lg transition-transform hover:scale-105">
            Daftar Sekarang <span class="material-symbols-outlined">arrow_forward</span>
        </a>
    </div>
</section>
@endsection
