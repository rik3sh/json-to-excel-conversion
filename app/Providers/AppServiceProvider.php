<?php

namespace App\Providers;

use App\Events\ConversionDone;
use ReflectionProperty;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;

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
        Queue::after(function (JobProcessed $event) {
            $payload = $event->job->payload();

            $jobInstance = unserialize($payload['data']['command']);

            $property = new ReflectionProperty($jobInstance, 'filePath');
            $property->setAccessible(true);
            
            $filePath = $property->getValue($jobInstance);

            broadcast(new ConversionDone($filePath));
        });
    }
}
