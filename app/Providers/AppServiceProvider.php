<?php

namespace App\Providers;

use App\Models\Channel;
use App\Models\Company;
use App\Models\User;
use App\Observers\ChannelObserver;
use App\Observers\CompanyObserver;
use App\Observers\UserObserver;
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
        Company::observe(CompanyObserver::class);
        User::observe(UserObserver::class);
    }
}
