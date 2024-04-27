<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * Define your route model bindings, pattern filters, and other route configuration.
   */
  public function boot(): void
  {
    RateLimiter::for('api', fn (Request $request) => Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()));

    $this->routes(function (): void {
      Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));

      Route::middleware('web')->group(base_path('routes/web.php'));
    });
  }
}
