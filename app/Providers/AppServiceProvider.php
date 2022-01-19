<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //mendefinisikan sebuah gate yang namanya admin, dimana gate hanya bisa diakse oleh user yang usernamenya nisrina.aulia
        Gate::define('admin', function(User $user) { //untuk user yang sudah login
            return $user->username === 'nisrina.aulia';
        });
    }
}
