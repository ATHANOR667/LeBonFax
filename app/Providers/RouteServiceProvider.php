<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->configureLoginLimiter();
        $this->configureAdminLimiter();
    }

    protected function configureLoginLimiter(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                // Limite par IP
                Limit::perMinute(3)->by($request->ip())->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite de 3 tentatives par minutes  atteinte . Réessayez dans '.$headers['Retry-After'].'s',
                        'retry_after' => $headers['Retry-After'] ?? 60
                    ], 429);
                }),

                // Limite par email
                Limit::perMinute(3)->by($request->input('email'))->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite de 3 tentatives par minutes  atteinte . Patientez '.$headers['Retry-After'].'s',
                        'retry_after' => $headers['Retry-After'] ?? 60
                    ], 429);
                }),

                // 5 tentatives toutes les 5 minutes (par IP)
                Limit::perMinutes(5, 5)->by($request->ip())->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite de  5 tentatives toutes les 5 minutes  atteinte. Temps restant: '.$headers['Retry-After'].'s',
                        'retry_after' => $headers['Retry-After'] ?? 300
                    ], 429);
                }),

                // 5 tentatives toutes les 5 minutes (par Email)
                Limit::perMinutes(5, 5)->by($request->input('email'))->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite de  5 tentatives toutes les 5 minutes  atteinte. Temps restant: '.$headers['Retry-After'].'s',
                        'retry_after' => $headers['Retry-After'] ?? 300
                    ], 429);
                }),

                // 20 tentatives par heure (par IP)
                Limit::perHour(20)->by($request->ip())->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'QUOTA HORAIRE  DÉPASSÉ (20 tentatives par heures . Attendez '.$headers['Retry-After'].'s',
                        'retry_after' => $headers['Retry-After'] ?? 3600
                    ], 429);
                }),

                 Limit::perHour(20)->by($request->input('email'))->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'QUOTA HORAIRE  DÉPASSÉ (20 tentatives par heures . Attendez '.$headers['Retry-After'].'s',
                        'retry_after' => $headers['Retry-After'] ?? 3600
                    ], 429);
                })


            ];
        });
    }

    protected function configureAdminLimiter(): void
    {
        RateLimiter::for('super-admin-login', function (Request $request) {
            return [
                // 3/min par IP
                Limit::perMinute(3)->by($request->ip())->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite de 3 tentatives par minute atteinte attendez '.$headers['Retry-After'].' secondes.',
                        'retry_after' => $headers['Retry-After'] ?? 60
                    ], 429);
                }),

                // 5/5min par IP
                Limit::perMinutes(5, 5)->by($request->ip())->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite de tentatives toutes les 5 minutes  atteinte , attendez '.$headers['Retry-After'].' secondes.',
                        'retry_after' => $headers['Retry-After'] ?? 300
                    ], 429);
                }),

                // 20/h par IP
                Limit::perHour(20)->by($request->ip())->response(function (Request $request, array $headers) {
                    return response()->json([
                        'status' => 429,
                        'message' => 'Limite atteinte , vous pouvez faire maximum 20 tentatives par heure . Réésayez dans '.$headers['Retry-After'].'secondes',
                        'retry_after' => $headers['Retry-After'] ?? 3600
                    ], 429);
                })
            ];
        });
    }
}
