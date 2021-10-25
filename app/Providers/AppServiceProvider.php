<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
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
        Blade::if('employer', function () {
            $condition = auth()->user()->type == User::TYPE_EMPLOYER;
            return $condition;
        });

        Blade::if('jobseeker', function () {
            $condition = auth()->user()->type == User::TYPE_JOB_SEEKER;
            return $condition;
        });

        Paginator::useBootstrap();
    }
}
