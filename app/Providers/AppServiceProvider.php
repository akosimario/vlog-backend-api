<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }
    public function boot(): void
    {
        Ratelimiter::for('login', function (Request $request) {
            return Limit::perHour(5)->by($request->ip())->response(function () {
                return response()->json(['status'  => false,'message' => 'too many attempts, please try again after a minute.'], 429);
            });
        });
        Ratelimiter::for('register', function (Request $request) {
            return Limit::perHour(4)->by($request->ip())->response(function () {
                return response()->json(['status'  => false,'message' => 'too many attempts, please try again after a minute.'], 429);
            });
        });
        Ratelimiter::for('post', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip() ?? $request->user()->id)->response(function () {
                return response()->json(['status'  => false,'message' => 'too many attempts, please try again after a minute.'], 429);
            });
        });
        Ratelimiter::for('comment', function (Request $request) {
            return Limit::perHour(10)->by($request->ip() ?? $request->user()->id)->response(function () {
                return response()->json(['status'  => false,'message' => 'too many attempts, please try again later'], 429);
            });
        });
    }
}
