@extends('layouts.ismy')

@section('content')
<section class="py-12 px-gutter bg-warm-cream min-h-screen">
    <div class="max-w-4xl mx-auto space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-emerald-900/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <a href="{{ route('dashboard') }}" class="text-xs font-bold text-[#0F4C3A] hover:text-[#C9A227] flex items-center gap-1 mb-2 transition-colors">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Dashboard Anggota
                </a>
                <h1 class="text-2xl md:text-3xl font-serif font-bold text-primary">
                    Pengaturan Profil & Keamanan Akun
                </h1>
                <p class="text-sm text-on-surface-variant mt-1">Perbarui data login, alamat email, dan kata sandi akun Anda.</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="btn-secondary px-4 py-2.5 text-xs font-bold flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-sm">badge</span> Lihat Kartu KTA
                </a>
            </div>
        </div>

        <!-- Section 1: Update Profile Information -->
        <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-emerald-900/10 space-y-6">
            <div class="border-b border-gray-100 pb-4">
                <h2 class="text-lg font-serif font-bold text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">person</span> Informasi Akun & Email
                </h2>
                <p class="text-xs text-gray-500 mt-1">Perbarui nama pengguna dan alamat email yang terhubung dengan akun Anda.</p>
            </div>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf
                @method('patch')

                <div>
                    <label for="name" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Nama Lengkap Akun</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" />
                    <x-input-error class="mt-1.5 text-xs text-red-600" :messages="$errors->get('name')" />
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Alamat Email Login</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" />
                    <x-input-error class="mt-1.5 text-xs text-red-600" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-3 p-3 bg-amber-50 rounded-xl border border-amber-200">
                            <p class="text-xs text-amber-800">
                                Alamat email Anda belum diverifikasi.
                                <button form="send-verification" class="font-bold underline text-amber-900 hover:text-amber-700 ml-1">
                                    Kirim ulang email verifikasi.
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-xs font-bold text-emerald-700">
                                    Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="btn-primary px-6 py-2.5 text-xs font-bold shadow-md flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">save</span> Simpan Perubahan
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                              class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Data profil berhasil disimpan!
                        </span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Section 2: Update Password -->
        <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-emerald-900/10 space-y-6">
            <div class="border-b border-gray-100 pb-4">
                <h2 class="text-lg font-serif font-bold text-primary flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">lock_reset</span> Perbarui Kata Sandi (Password)
                </h2>
                <p class="text-xs text-gray-500 mt-1">Pastikan akun Anda menggunakan kata sandi yang kuat dan aman untuk menjaga data keanggotaan.</p>
            </div>

            <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                @csrf
                @method('put')

                <div>
                    <label for="update_password_current_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Kata Sandi Saat Ini</label>
                    <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5 text-xs text-red-600" />
                </div>

                <div>
                    <label for="update_password_password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Kata Sandi Baru</label>
                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5 text-xs text-red-600" />
                </div>

                <div>
                    <label for="update_password_password_confirmation" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Konfirmasi Kata Sandi Baru</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-primary transition-all bg-white" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5 text-xs text-red-600" />
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="btn-primary px-6 py-2.5 text-xs font-bold shadow-md flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">key</span> Perbarui Kata Sandi
                    </button>

                    @if (session('status') === 'password-updated')
                        <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                              class="text-xs font-bold text-emerald-700 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">check_circle</span> Kata sandi berhasil diperbarui!
                        </span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Section 3: Delete Account -->
        <div class="bg-white rounded-2xl p-6 md:p-8 card-shadow border border-red-200 space-y-6">
            <div class="border-b border-red-100 pb-4">
                <h2 class="text-lg font-serif font-bold text-red-800 flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-600">warning</span> Hapus Akun Pengguna
                </h2>
                <p class="text-xs text-gray-500 mt-1">Setelah akun Anda dihapus, semua data profil dan hak akses keanggotaan akan terhapus permanen.</p>
            </div>

            <div x-data="{ openModal: false }">
                <button type="button" @click="openModal = true"
                        class="bg-red-50 text-red-700 hover:bg-red-600 hover:text-white px-5 py-2.5 rounded-xl text-xs font-bold border border-red-300 transition-colors flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">delete_forever</span> Hapus Akun Ini
                </button>

                <!-- Modal Confirmation -->
                <div x-show="openModal" x-transition x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                    <div @click.outside="openModal = false" class="bg-white rounded-2xl p-6 md:p-8 max-w-lg w-full shadow-2xl border border-red-200 space-y-5">
                        <div class="flex items-center gap-3 text-red-700">
                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined">warning</span>
                            </div>
                            <h3 class="text-lg font-serif font-bold">Apakah Anda yakin ingin menghapus akun?</h3>
                        </div>

                        <p class="text-xs text-gray-600 leading-relaxed">
                            Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi Anda saat ini untuk mengonfirmasi penghapusan akun secara permanen.
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                            @csrf
                            @method('delete')

                            <div>
                                <label for="delete_password" class="sr-only">Kata Sandi</label>
                                <input id="delete_password" name="password" type="password" placeholder="Masukkan Kata Sandi Anda"
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" />
                                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1 text-xs text-red-600" />
                            </div>

                            <div class="flex justify-end gap-3 pt-2">
                                <button type="button" @click="openModal = false" class="btn-secondary px-4 py-2 text-xs font-bold">
                                    Batal
                                </button>
                                <button type="submit" class="bg-red-600 text-white hover:bg-red-700 px-5 py-2 rounded-xl text-xs font-bold shadow-md transition-colors">
                                    Hapus Akun Permanen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
