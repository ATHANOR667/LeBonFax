<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withCommands([
        \App\Console\Commands\CleanExpiredTokens::class,
        \App\Console\Commands\DeleteUnusedImages::class,
        \App\Console\Commands\verifyPayment::class
    ])->withSchedule(function ( Schedule $schedule){
        $schedule->command(\App\Console\Commands\CleanExpiredTokens::class)->hourly();
        $schedule->command(\App\Console\Commands\DeleteUnusedImages::class)->hourly();
        $schedule->command(\App\Console\Commands\verifyPayment::class)->everyMinute();
    })->create();
