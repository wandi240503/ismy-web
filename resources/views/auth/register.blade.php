<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-serif font-bold text-[#0F4C3A]">Registrasi Akun Anggota</h2>
        <p class="text-xs text-gray-500 mt-1">Buat akun untuk mengelola kartu KTA digital Anda di ISMY.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap & Gelar</label>
            <input id="name" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" 
                   type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Prof. Dr. Ahmad Fulan" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat Email</label>
            <input id="email" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" 
                   type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi</label>
            <input id="password" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white"
                   type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white"
                   type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full btn-primary py-2.5 rounded-xl text-sm font-bold shadow-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">person_add</span> Buat Akun Anggota
            </button>
        </div>

        <div class="text-center pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-600">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-[#0F4C3A] hover:text-[#C9A227] ml-1">
                    Masuk di sini →
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
