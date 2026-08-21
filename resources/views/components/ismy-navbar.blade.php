<header x-data="{ mobileMenuOpen: false, searchOpen: false, userDropdownOpen: false }" class="bg-surface/95 dark:bg-surface-container-lowest/95 backdrop-blur-md top-0 sticky z-50 border-b border-primary/10 shadow-sm">
    <div class="max-w-container-max mx-auto px-gutter flex justify-between items-center h-20">
        <!-- Brand Logo -->
        <a class="flex items-center gap-3 text-primary dark:text-primary-fixed-dim" href="{{ route('beranda') }}">
            <x-application-logo class="h-12 w-auto" />
            <div class="flex flex-col">
                <span class="text-xl font-serif font-extrabold leading-none tracking-tight">ISMY</span>
                <span class="text-[9px] font-sans font-bold text-secondary uppercase tracking-widest leading-tight">Yogyakarta</span>
            </div>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex gap-md items-center">
            <a class="{{ request()->routeIs('beranda') ? 'text-secondary border-b-2 border-secondary font-bold' : 'text-on-surface hover:text-primary' }} pb-1 text-sm font-semibold transition-all duration-200" href="{{ route('beranda') }}">
                Beranda
            </a>
            <a class="{{ request()->routeIs('tentang-kami') ? 'text-secondary border-b-2 border-secondary font-bold' : 'text-on-surface hover:text-primary' }} pb-1 text-sm font-semibold transition-all duration-200" href="{{ route('tentang-kami') }}">
                Tentang Kami
            </a>
            <a class="{{ request()->routeIs('struktur-organisasi') ? 'text-secondary border-b-2 border-secondary font-bold' : 'text-on-surface hover:text-primary' }} pb-1 text-sm font-semibold transition-all duration-200" href="{{ route('struktur-organisasi') }}">
                Struktur Organisasi
            </a>
            <a class="{{ request()->routeIs('berita*') ? 'text-secondary border-b-2 border-secondary font-bold' : 'text-on-surface hover:text-primary' }} pb-1 text-sm font-semibold transition-all duration-200" href="{{ route('berita') }}">
                Berita
            </a>
            <a class="{{ request()->routeIs('keanggotaan') ? 'text-secondary border-b-2 border-secondary font-bold' : 'text-on-surface hover:text-primary' }} pb-1 text-sm font-semibold transition-all duration-200" href="{{ route('keanggotaan') }}">
                Keanggotaan
            </a>
        </nav>

        <!-- Trailing Actions -->
        <div class="hidden md:flex items-center gap-3">
            <!-- Global Search Button -->
            <button @click="searchOpen = !searchOpen" class="text-primary hover:bg-secondary-container/20 p-2 rounded-full transition-all flex items-center justify-center" title="Pencarian">
                <span class="material-symbols-outlined">search</span>
            </button>

            @auth
                <!-- Button to Admin Panel if User is Admin -->
                @if(Auth::user()->email === 'admin@ismy.or.id' || str_ends_with(Auth::user()->email, '@ismy.or.id'))
                    <a href="{{ url('/admin') }}" class="bg-emerald-900 text-[#D4AF37] hover:bg-emerald-950 font-bold px-3.5 py-2 rounded-xl text-xs flex items-center gap-1.5 border border-[#D4AF37]/40 shadow-sm transition-transform hover:scale-95">
                        <span class="material-symbols-outlined text-sm text-[#D4AF37]">admin_panel_settings</span> Panel Admin
                    </a>
                @endif

                <!-- Member Dashboard & Profile Link -->
                <a href="{{ route('dashboard') }}" class="btn-primary px-4 py-2 text-xs font-bold flex items-center gap-1.5 shadow-sm transition-transform hover:scale-95">
                    <span class="material-symbols-outlined text-sm">badge</span> Kartu & Profil
                </a>

                <!-- User Dropdown Menu -->
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open" class="flex items-center gap-2 p-1.5 rounded-full hover:bg-gray-100 transition-colors border border-primary/20">
                        <div class="w-8 h-8 rounded-full bg-primary text-secondary flex items-center justify-center font-bold text-xs uppercase">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <span class="material-symbols-outlined text-sm text-gray-500">expand_more</span>
                    </button>

                    <div x-show="open" x-transition x-cloak class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <span class="text-xs font-bold text-primary block truncate">{{ Auth::user()->name }}</span>
                            <span class="text-[11px] text-gray-500 block truncate">{{ Auth::user()->email }}</span>
                        </div>

                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 text-xs text-gray-700 hover:bg-emerald-50 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-sm">badge</span> Kartu Anggota Digital
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-xs text-gray-700 hover:bg-emerald-50 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-sm">manage_accounts</span> Pengaturan Akun
                        </a>

                        @if(Auth::user()->email === 'admin@ismy.or.id' || str_ends_with(Auth::user()->email, '@ismy.or.id'))
                            <a href="{{ url('/admin') }}" class="flex items-center gap-2 px-4 py-2 text-xs text-[#0F4C3A] font-bold bg-amber-50/60 hover:bg-amber-100 transition-colors border-t border-b border-amber-100">
                                <span class="material-symbols-outlined text-sm text-[#C9A227]">admin_panel_settings</span> Buka Panel Admin
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="pt-1">
                            @csrf
                            <button type="submit" class="w-full text-left flex items-center gap-2 px-4 py-2 text-xs text-red-600 hover:bg-red-50 transition-colors">
                                <span class="material-symbols-outlined text-sm">logout</span> Keluar (Log out)
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a class="btn-primary px-4 py-2 text-sm transition-transform duration-150 hover:scale-95 shadow-sm" href="{{ route('keanggotaan') }}">
                    Daftar Anggota
                </a>
                <a href="{{ route('login') }}" class="text-primary hover:text-secondary text-sm font-semibold px-2">
                    Masuk
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-primary p-2 focus:outline-none">
            <span class="material-symbols-outlined text-2xl" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
        </button>
    </div>

    <!-- Search Modal / Bar -->
    <div x-show="searchOpen" x-transition x-cloak class="bg-white border-b border-primary/10 p-4 shadow-md">
        <form action="{{ route('pencarian') }}" method="GET" class="max-w-container-max mx-auto flex gap-2">
            <input type="text" name="q" placeholder="Cari berita, kegiatan, dokumen, atau pengurus..." class="flex-grow rounded-lg border-emerald-light px-4 py-2 text-sm focus:ring-2 focus:ring-secondary focus:outline-none">
            <button type="submit" class="btn-primary px-6 py-2 text-sm flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">search</span> Cari
            </button>
            <button type="button" @click="searchOpen = false" class="text-gray-500 hover:text-gray-700 px-3">
                <span class="material-symbols-outlined">close</span>
            </button>
        </form>
    </div>

    <!-- Mobile Nav Menu -->
    <div x-show="mobileMenuOpen" x-transition x-cloak class="md:hidden bg-surface border-b border-primary/10 px-gutter py-4 flex flex-col gap-3 shadow-lg">
        <a class="text-on-surface hover:text-primary font-semibold py-1" href="{{ route('beranda') }}">Beranda</a>
        <a class="text-on-surface hover:text-primary font-semibold py-1" href="{{ route('tentang-kami') }}">Tentang Kami</a>
        <a class="text-on-surface hover:text-primary font-semibold py-1" href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a>
        <a class="text-on-surface hover:text-primary font-semibold py-1" href="{{ route('berita') }}">Berita</a>
        <a class="text-on-surface hover:text-primary font-semibold py-1" href="{{ route('keanggotaan') }}">Keanggotaan</a>
        
        <div class="pt-2 border-t border-primary/10 flex flex-col gap-2">
            @auth
                @if(Auth::user()->email === 'admin@ismy.or.id' || str_ends_with(Auth::user()->email, '@ismy.or.id'))
                    <a href="{{ url('/admin') }}" class="bg-emerald-900 text-[#D4AF37] px-4 py-2 rounded-xl text-center text-sm font-bold flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">admin_panel_settings</span> Panel Admin
                    </a>
                @endif
                <a href="{{ route('dashboard') }}" class="btn-primary px-4 py-2 text-center text-sm">Kartu & Profil Saya</a>
                <a href="{{ route('profile.edit') }}" class="btn-secondary px-4 py-2 text-center text-sm">Pengaturan Akun</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-center text-red-600 font-semibold py-1 text-sm">Keluar (Log out)</button>
                </form>
            @else
                <a class="btn-primary px-4 py-2 text-center text-sm font-semibold" href="{{ route('keanggotaan') }}">Daftar Anggota</a>
                <a href="{{ route('login') }}" class="text-center text-primary font-semibold py-1">Login Anggota</a>
            @endauth
        </div>
    </div>
</header>
