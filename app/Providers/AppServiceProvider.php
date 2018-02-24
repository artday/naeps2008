<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Migration Default String Length:: MySQL older than the 5.7.7
        Schema::defaultStringLength(191);

        /* Validate is true table column. Example: 'email:user,active' */
        Validator::extend('is_true', function ($attribute, $value, $parameters, $validator){
            $user = DB::table($parameters[0])->where($attribute, $value)->where($parameters[1], true)->first();
            return($user && $user->$attribute === $value);
        });
        /* Validate is false table column. Example: 'email:user,active' */
        Validator::extend('is_false', function ($attribute, $value, $parameters, $validator){
            $user = DB::table($parameters[0])->where($attribute, $value)->where($parameters[1], false)->first();
            return($user && $user->$attribute === $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
