<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || str_contains(request()->getHost(), 'vercel.app') || request()->isSecure() || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }

        // Paksa Livewire menggunakan file statis di public/vendor/livewire/ agar tidak
        // melewati route PHP dinamis yang bermasalah di serverless Vercel
        if (class_exists(\Livewire\Livewire::class)) {
            \Livewire\Livewire::setScriptRoute(function ($handle) {
                return \Illuminate\Support\Facades\Route::get('/vendor/livewire/livewire.js', $handle);
            });

            \Livewire\Livewire::setUpdateRoute(function ($handle) {
                return \Illuminate\Support\Facades\Route::post('/livewire/update', $handle);
            });
        }

        // Pastikan akun default admin dan member selalu sinkron dan terverifikasi
        try {
            if (Schema::hasTable('users')) {
                $wandi = User::where('email', 'wandimuhammad@gmail.com')->first();
                if (!$wandi) {
                    $wandi = User::create([
                        'name' => 'Wandi Muhammad, S.Kom',
                        'email' => 'wandimuhammad@gmail.com',
                        'password' => Hash::make('password123'),
                    ]);
                } elseif (!Hash::check('password123', $wandi->password)) {
                    $wandi->password = Hash::make('password123');
                    $wandi->save();
                }

                $admin = User::where('email', 'admin@ismy.or.id')->first();
                if (!$admin) {
                    $admin = User::create([
                        'name' => 'Administrator ISMY',
                        'email' => 'admin@ismy.or.id',
                        'password' => Hash::make('password'),
                    ]);
                } elseif (!Hash::check('password', $admin->password)) {
                    $admin->password = Hash::make('password');
                    $admin->save();
                }
            }
        } catch (\Throwable $e) {
            // Abaikan saat migrasi awal
        }
    }
}
