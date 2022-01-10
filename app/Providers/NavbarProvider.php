<?php

namespace App\Providers;

use App\Models\Notifications;
use App\Models\Season;
use App\Models\Statuses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavbarProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $modelStatuses = new Statuses();
            $notifications = Notifications::where('user_id', Auth::user()->id)
                ->where('status_id', $modelStatuses->getStatus('active'))->get();
            $view->with('navbarNotifications', count($notifications));
        });
    }
}
