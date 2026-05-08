<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
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