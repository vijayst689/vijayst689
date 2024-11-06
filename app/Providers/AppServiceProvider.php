<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
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
        Schema::defaultStringLength(191);
        $this->services = DB::table('services')->where('status', '=', 'Active' )->where('parent_id',0 )->orderBy( 'id' , 'Asc' )->get();
         view()->composer('layouts.sidebar', function($view) {
            $view->with(['services' => $this->services]);
        });
    }
}
