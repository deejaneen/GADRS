<?php

namespace App\Providers;

use App\Models\Dorm;
use App\Observers\DormObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\SidebarComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        // Register the view composer for receiving
        View::composer('ras.receiving.receiving-side-bar', SidebarComposer::class);
        // Register the view composer for supply
        View::composer('ras.supply.supply-sidebar', SidebarComposer::class);
        // Register the view composer for cashier
        View::composer('cashier.cashier-sidebar', SidebarComposer::class);

        Dorm::observe(DormObserver::class);
    }
}
