<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon; // Tambahkan import Carbon

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Set bahasa Indonesia untuk semua format tanggal (Carbon)
        Carbon::setLocale('id');

        RedirectIfAuthenticated::redirectUsing(function (Request $request) {

            if (Auth::check()) {
                $user = Auth::user();

                if (method_exists($user, 'isAdmin') && $user->isAdmin()) {
                    return route('admin.dashboard');
                }

                return route('siswa.dashboard');
            }

            return '/';
        });
    }
}