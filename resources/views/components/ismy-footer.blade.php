<footer class="bg-[#0b241d] text-white border-t border-[#c9a227]/30">
    <div class="max-w-container-max mx-auto px-gutter py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Brand Info -->
        <div class="col-span-1 md:col-span-1">
            <a href="{{ route('beranda') }}" class="flex items-center gap-3 mb-4 group">
                <x-application-logo class="h-12 w-auto drop-shadow-sm" />
                <div>
                    <span class="text-xl font-serif font-black text-white block leading-tight tracking-wide group-hover:text-[#D4AF37] transition-colors">ISMY</span>
                    <span class="text-[10px] font-sans font-bold text-[#D4AF37] uppercase tracking-widest block">Yogyakarta</span>
                </div>
            </a>
            <p class="text-sm text-emerald-100/80 leading-relaxed">
                Ikatan Sarjana Melayu Yogyakarta. Wadah silaturahmi, keilmuan, dan pelestarian peradaban intelektual Melayu di D.I. Yogyakarta.
            </p>
        </div>

        <!-- Quick Links -->
        <div class="col-span-1 md:col-span-2">
            <h4 class="text-xs font-bold text-[#D4AF37] mb-4 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                Tautan Cepat
            </h4>
            <div class="grid grid-cols-2 gap-y-2.5 gap-x-4 text-sm">
                <a class="text-emerald-100/85 hover:text-[#D4AF37] hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-1.5" href="{{ route('tentang-kami') }}">
                    <span class="text-[#D4AF37]/60 text-xs">›</span> Tentang Kami
                </a>
                <a class="text-emerald-100/85 hover:text-[#D4AF37] hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-1.5" href="{{ route('struktur-organisasi') }}">
                    <span class="text-[#D4AF37]/60 text-xs">›</span> Struktur Organisasi
                </a>
                <a class="text-emerald-100/85 hover:text-[#D4AF37] hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-1.5" href="{{ route('berita') }}">
                    <span class="text-[#D4AF37]/60 text-xs">›</span> Berita & Artikel
                </a>
                <a class="text-emerald-100/85 hover:text-[#D4AF37] hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-1.5" href="{{ route('keanggotaan') }}">
                    <span class="text-[#D4AF37]/60 text-xs">›</span> Keanggotaan
                </a>
                <a class="text-emerald-100/85 hover:text-[#D4AF37] hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-1.5" href="{{ route('login') }}">
                    <span class="text-[#D4AF37]/60 text-xs">›</span> Portal Anggota
                </a>
                <a class="text-emerald-100/85 hover:text-[#D4AF37] hover:translate-x-1 transition-all duration-200 inline-flex items-center gap-1.5" href="{{ route('pencarian') }}">
                    <span class="text-[#D4AF37]/60 text-xs">›</span> Pencarian Data
                </a>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="col-span-1 md:col-span-1">
            <h4 class="text-xs font-bold text-[#D4AF37] mb-4 uppercase tracking-widest flex items-center gap-1.5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#D4AF37]"></span>
                Hubungi Kami
            </h4>
            <p class="text-sm text-emerald-100/90 flex items-center gap-2.5 mb-3">
                <span class="material-symbols-outlined text-base text-[#D4AF37]">mail</span>
                <a href="mailto:info@ismy.or.id" class="hover:text-[#D4AF37] transition-colors">info@ismy.or.id</a>
            </p>
            <p class="text-sm text-emerald-100/90 flex items-center gap-2.5">
                <span class="material-symbols-outlined text-base text-[#D4AF37]">location_on</span>
                <span>Yogyakarta, D.I. Yogyakarta, Indonesia</span>
            </p>
        </div>
    </div>

    <!-- Copyright -->
    <div class="max-w-container-max mx-auto px-gutter py-4 border-t border-emerald-900/60 text-center">
        <p class="text-xs text-emerald-200/70">
            © {{ date('Y') }} Ikatan Sarjana Melayu Yogyakarta (ISMY). Seluruh Hak Cipta Dilindungi.
        </p>
    </div>
</footer>
