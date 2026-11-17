<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Login admin memakai tabel `admins`, terpisah dari tabel `users`.
        config([
            'auth.guards.admin'     => ['driver' => 'session', 'provider' => 'admins'],
            'auth.providers.admins' => ['driver' => 'eloquent', 'model' => Admin::class],
        ]);
    }

    public function boot(): void
    {
        //
    }
}
