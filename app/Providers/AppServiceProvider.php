<?php

namespace App\Providers;

use App\Models\SmsLog;
use App\Observers\SmsLogObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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

        // Ensure pagination renders Bootstrap markup (Laravel 10 defaults to Tailwind).
        // This makes existing frontend pagination CSS selectors work as expected.
        Paginator::useBootstrapFour();

        SmsLog::observe(SmsLogObserver::class);

        View::composer('user.layouts.header', function ($view) {
            $userSmsLogFailedCount = 0;
            $recentUserSmsLogs = collect();

            if (Schema::hasTable('sms_logs') && auth()->check()) {
                $userId = auth()->id();

                $userSmsLogFailedCount = SmsLog::where('status', 'failed')
                    ->whereHas('order', function ($q) use ($userId) {
                        $q->where('user_id', $userId);
                    })
                    ->count();

                $recentUserSmsLogs = SmsLog::whereHas('order', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                })
                    ->latest()
                    ->take(5)
                    ->get();
            }

            $view->with([
                'userSmsLogFailedCount' => $userSmsLogFailedCount,
                'recentUserSmsLogs' => $recentUserSmsLogs,
            ]);
        });
    }
}
