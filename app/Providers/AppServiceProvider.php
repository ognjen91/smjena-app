<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\StartingDay;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('durationOfShiftInDays', function ($app) {
          return StartingDay::first()->durationOfShiftInDays;
      });

      $this->app->singleton('locales', function ($app) {
          return ['sr' => 'Srpski', 'en'=>'English'];
      });

      $this->app->singleton('locale', function ($app) {
          if(session('locale') == null) return 'sr';
          return session('locale');
      });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Carbon::setWeekStartsAt(Carbon::MONDAY);
        // Carbon::setWeekEndsAt(Carbon::SUNDAY);
    }
}
