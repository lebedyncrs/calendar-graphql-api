<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('userExists', function ($attribute, $value, $parameters, $validator) {
            return User::where('id', $value)->exists();
        });

        Validator::extend('eventExists', function ($attribute, $value, $parameters, $validator) {
            return Event::where('id', $value)->exists();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
