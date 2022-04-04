<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        
        /**
         * Ifs customizados
         */
        
        Blade::if('ifAdmin', function(){

            if(!Auth::check()) return false;
            $usuario = auth()->user();
            return in_array($usuario->email, config('acl.admins'));
        });


    }
}
