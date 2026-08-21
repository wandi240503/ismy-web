@extends('layouts.ismy')

@section('content')
<!-- Header Banner -->
<section class="relative py-xl px-gutter bg-primary text-white text-center overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('{{ asset('images/img_03.jpg') }}'); background-size: cover; background-position: center;"></div>
    <div class="max-w-container-max mx-auto relative z-10">
        <span class="text-xs font-semibold text-secondary uppercase tracking-widest block mb-2">Profil Organisasi</span>
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">Tentang ISMY</h1>
        <p class="text-emerald-100 max-w-2xl mx-auto text-base">
            Mengenal lebih dekat perjalanan, nilai, dan arah langkah Ikatan Sarjana Melayu Yogyakarta dalam menjalin silaturahmi intelektual.
        </p>
    </div>
</section>

<!-- Sejarah & Milestones -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto grid md:grid-cols-12 gap-lg items-start">
        <div class="md:col-span-7 space-y-6">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Sejarah & Perjalanan</h2>
            <p class="text-on-surface-variant leading-relaxed">
                Ikatan Sarjana Melayu Yogyakarta (ISMY) didirikan sebagai wadah silaturahmi, pertukaran gagasan, dan kolaborasi bagi para cendekiawan, mahasiswa, dan profesional serumpun Melayu yang bermukim, belajar, atau berkarya di Kota Pelajar, Yogyakarta.
            </p>
            <p class="text-on-surface-variant leading-relaxed">
                Sejak awal berdirinya, ISMY memegang teguh prinsip <em>"Adat Bersendi Syarak, Syarak Bersendi Kitabullah"</em> yang dipadukan dengan semangat akademis modern. Kami berkomitmen untuk tidak hanya melestarikan nilai-nilai luhur kebudayaan Melayu, tetapi juga memberikan kontribusi pemikiran yang konstruktif bagi pembangunan bangsa, khususnya dalam lanskap pendidikan dan sosial di Yogyakarta.
            </p>
            <div class="rounded-xl overflow-hidden card-shadow border-emerald-light">
                <img src="{{ asset('images/img_03.jpg') }}" alt="Pertemuan Intelektual ISMY" class="w-full h-72 object-cover">
            </div>
        </div>

        <div class="md:col-span-5 bg-white rounded-2xl p-6 card-shadow border-emerald-light space-y-6">
            <h3 class="text-xl font-serif font-bold text-primary border-b border-gray-100 pb-3">Milestone Utama</h3>
            
            <div class="space-y-4">
                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-secondary-container/30 text-secondary font-bold flex items-center justify-center flex-shrink-0 text-sm">
                        '98
                    </div>
                    <div>
                        <h4 class="font-bold text-primary text-sm">Gagasan Awal</h4>
                        <p class="text-xs text-on-surface-variant">Pertemuan pertama para mahasiswa pascasarjana dan tokoh intelektual Melayu di Yogyakarta merumuskan visi bersama.</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-secondary-container/30 text-secondary font-bold flex items-center justify-center flex-shrink-0 text-sm">
                        '05
                    </div>
                    <div>
                        <h4 class="font-bold text-primary text-sm">Deklarasi Resmi</h4>
                        <p class="text-xs text-on-surface-variant">Pembentukan struktur organisasi formal dan pengesahan nama ISMY dalam musyawarah besar pertama.</p>
                    </div>
                </div>

                <div class="flex gap-4 items-start">
                    <div class="w-10 h-10 rounded-full bg-secondary-container/30 text-secondary font-bold flex items-center justify-center flex-shrink-0 text-sm">
                        '24
                    </div>
                    <div>
                        <h4 class="font-bold text-primary text-sm">Pengembangan & Riset</h4>
                        <p class="text-xs text-on-surface-variant">Peluncuran program beasiswa riset kebudayaan dan konsolidasi portal digital keanggotaan profesional serumpun.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="py-xl px-gutter bg-white border-y border-emerald-light">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-lg">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Visi & Misi</h2>
            <div class="w-16 h-1 bg-secondary mx-auto mt-2 rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-lg">
            <!-- Visi -->
            <div class="bg-warm-cream rounded-2xl p-8 border-emerald-light card-shadow">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-2xl">visibility</span>
                </div>
                <h3 class="text-2xl font-serif font-bold text-primary mb-4">Visi</h3>
                <p class="text-on-surface-variant leading-relaxed italic">
                    "Menjadi pusat simpul intelektual sarjana Melayu di Yogyakarta yang unggul, berbudaya, dan berwawasan global dalam merespons tantangan zaman berlandaskan nilai-nilai keislaman dan kearifan lokal."
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-warm-cream rounded-2xl p-8 border-emerald-light card-shadow">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-2xl">flag</span>
                </div>
                <h3 class="text-2xl font-serif font-bold text-primary mb-4">Misi</h3>
                <ul class="space-y-3 text-on-surface-variant text-sm">
                    <li class="flex gap-2 items-start">
                        <span class="material-symbols-outlined text-secondary text-base mt-0.5">check_circle</span>
                        <span>Membangun jaringan komunikasi dan silaturahmi yang kokoh antar cendekiawan dan mahasiswa.</span>
                    </li>
                    <li class="flex gap-2 items-start">
                        <span class="material-symbols-outlined text-secondary text-base mt-0.5">check_circle</span>
                        <span>Menyelenggarakan kajian akademis dan kebudayaan secara komprehensif dan berkala.</span>
                    </li>
                    <li class="flex gap-2 items-start">
                        <span class="material-symbols-outlined text-secondary text-base mt-0.5">check_circle</span>
                        <span>Mendorong lahirnya karya-karya pemikiran yang relevan bagi kemajuan bangsa.</span>
                    </li>
                    <li class="flex gap-2 items-start">
                        <span class="material-symbols-outlined text-secondary text-base mt-0.5">check_circle</span>
                        <span>Berperan aktif dalam peningkatan kapasitas sumber daya manusia (SDM).</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Nilai Inti -->
<section class="py-xl px-gutter bg-warm-cream">
    <div class="max-w-container-max mx-auto">
        <div class="text-center mb-lg">
            <h2 class="text-3xl font-serif font-bold text-primary-container">Nilai Inti Kami</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-md">
            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <span class="material-symbols-outlined text-3xl text-primary mb-2">shield</span>
                <h4 class="font-bold text-primary mb-1">Integritas</h4>
                <p class="text-xs text-on-surface-variant">Menjunjung tinggi nilai moral, etika akademis, dan kejujuran dalam berkarya.</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <span class="material-symbols-outlined text-3xl text-primary mb-2">handshake</span>
                <h4 class="font-bold text-primary mb-1">Kolaborasi</h4>
                <p class="text-xs text-on-surface-variant">Mengutamakan semangat gotong royong dan kemitraan lintas disiplin ilmu.</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <span class="material-symbols-outlined text-3xl text-primary mb-2">menu_book</span>
                <h4 class="font-bold text-primary mb-1">Keilmuan</h4>
                <p class="text-xs text-on-surface-variant">Berkomitmen pada penalaran, kebebasan akademis, dan pencarian pengetahuan.</p>
            </div>
            <div class="bg-white rounded-xl p-6 text-center card-shadow border-emerald-light">
                <span class="material-symbols-outlined text-3xl text-primary mb-2">account_balance</span>
                <h4 class="font-bold text-primary mb-1">Kebudayaan</h4>
                <p class="text-xs text-on-surface-variant">Melestarikan nilai-nilai luhur kearifan Melayu di tengah arus modernitas.</p>
            </div>
        </div>
    </div>
</section>

<!-- Dokumen Legalitas & FAQ -->
<section class="py-xl px-gutter bg-white border-t border-emerald-light" x-data="{ openFaq: null }">
    <div class="max-w-container-max mx-auto space-y-xl">
        <!-- Legalitas Banner -->
        <div class="bg-surface-container-low rounded-2xl p-8 border-emerald-light flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex gap-4 items-center">
                <div class="w-12 h-12 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-2xl">description</span>
                </div>
                <div>
                    <h3 class="font-serif font-bold text-lg text-primary">Dokumen Legalitas & AD-ART</h3>
                    <p class="text-sm text-on-surface-variant">Unduh dokumen resmi dasar penyusunan kepengurusan dan aturan dasar organisasi.</p>
                </div>
            </div>
            @if($dokumenAdArt)
                <a href="{{ asset('storage/' . $dokumenAdArt->file_path) }}" target="_blank" download class="btn-secondary px-6 py-2.5 text-sm flex items-center gap-2 flex-shrink-0">
                    <span class="material-symbols-outlined text-sm">download</span> Unduh Berkas
                </a>
            @else
                <a href="#faq" class="btn-secondary px-6 py-2.5 text-sm flex items-center gap-2 flex-shrink-0 opacity-80 cursor-not-allowed" title="Dokumen belum diunggah">
                    <span class="material-symbols-outlined text-sm">info</span> Segera Hadir
                </a>
            @endif
        </div>

        <!-- FAQ Section -->
        <div>
            <h2 class="text-2xl font-serif font-bold text-primary-container mb-6 text-center">Pertanyaan Umum (FAQ)</h2>
            <div class="max-w-3xl mx-auto space-y-3">
                @forelse($faqs as $index => $faq)
                    <div class="border border-emerald-light rounded-xl overflow-hidden bg-warm-cream">
                        <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}" class="w-full p-4 text-left font-bold text-primary flex justify-between items-center">
                            <span>{{ $faq->pertanyaan }}</span>
                            <span class="material-symbols-outlined text-sm" x-text="openFaq === {{ $index }} ? 'expand_less' : 'expand_more'">expand_more</span>
                        </button>
                        <div x-show="openFaq === {{ $index }}" x-cloak class="p-4 pt-0 text-sm text-on-surface-variant border-t border-gray-100">
                            {{ $faq->jawaban }}
                        </div>
                    </div>
                @empty
                    <div class="border border-emerald-light rounded-xl overflow-hidden bg-warm-cream">
                        <button @click="openFaq = openFaq === 0 ? null : 0" class="w-full p-4 text-left font-bold text-primary flex justify-between items-center">
                            <span>Siapa saja yang dapat bergabung menjadi anggota ISMY?</span>
                            <span class="material-symbols-outlined text-sm" x-text="openFaq === 0 ? 'expand_less' : 'expand_more'">expand_more</span>
                        </button>
                        <div x-show="openFaq === 0" x-cloak class="p-4 pt-0 text-sm text-on-surface-variant border-t border-gray-100">
                            Seluruh sarjana, cendekiawan, profesional, dan mahasiswa pascasarjana rumpun Melayu yang bertempat tinggal, studi, atau bekerja di wilayah Yogyakarta.
                        </div>
                    </div>
                    <div class="border border-emerald-light rounded-xl overflow-hidden bg-warm-cream">
                        <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full p-4 text-left font-bold text-primary flex justify-between items-center">
                            <span>Bagaimana cara mendaftar keanggotaan?</span>
                            <span class="material-symbols-outlined text-sm" x-text="openFaq === 1 ? 'expand_less' : 'expand_more'">expand_more</span>
                        </button>
                        <div x-show="openFaq === 1" x-cloak class="p-4 pt-0 text-sm text-on-surface-variant border-t border-gray-100">
                            Pendaftaran dilakukan secara online melalui halaman Keanggotaan dengan mengisi formulir dan melampirkan berkas yang dibutuhkan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
