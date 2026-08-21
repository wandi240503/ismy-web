<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-serif font-bold text-[#0F4C3A]">Masuk ke Portal Anggota</h2>
        <p class="text-xs text-gray-500 mt-1">Gunakan akun terdaftar Anda untuk mengakses kartu KTA digital.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat Email</label>
            <input id="email" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" 
                   type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi</label>
            <input id="password" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white"
                   type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs pt-1">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#0F4C3A] shadow-sm focus:ring-[#C9A227]" name="remember">
                <span class="ms-2 text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-[#0F4C3A] font-semibold hover:text-[#C9A227] transition-colors" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-2.5 rounded-xl text-sm font-bold shadow-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">login</span> Masuk ke Portal
            </button>
        </div>

        <div class="text-center pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-600">
                Belum terdaftar sebagai anggota? 
                <a href="{{ route('keanggotaan') }}" class="font-bold text-[#0F4C3A] hover:text-[#C9A227] ml-1">
                    Daftar Sekarang →
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
