<?php

namespace PersiaFava\Sms;

use Illuminate\Support\ServiceProvider;

/**
 * Class SmsServiceProvider
 *
 * This class is the bridge between our SMS SDK and a Laravel application.
 * It registers the SmsService into Laravel's service container and
 * makes the configuration file publishable.
 */
class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method binds our SmsService class into the Laravel service container
     * as a singleton, ensuring it's only instantiated once per request.
     *
     * @return void
     */
    public function register()
    {
        // Merge the default package config with the user's published config
        $this->mergeConfigFrom(
            __DIR__.'/../config/sms.php', 'sms'
        );

        // Register the SmsService as a singleton
        $this->app->singleton(SmsService::class, function ($app) {
            // Get the merged configuration
            $config = $app['config']['sms'];

            // Ensure the auth_string is set
            if (empty($config['auth_string'])) {
                throw new \InvalidArgumentException('SMS_ESB_AUTH_STRING is not set in your .env file or config/sms.php.');
            }
            
            // Create a new instance of our service with the config
            return new SmsService($config);
        });

        // Bind the string 'PersiaFava\Sms\SmsService' to the class,
        // which is used by our Facade.
        $this->app->alias(SmsService::class, 'PersiaFava\Sms\SmsService');
    }

    /**
     * Bootstrap any application services.
     *
     * This method is called after all other services are registered.
     * We use it to make our configuration file "publishable".
     *
     * @return void
     */
    public function boot()
    {
        // Make the config file publishable
        // This allows users to run: php artisan vendor:publish
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sms.php' => config_path('sms.php'),
            ], 'config');
        }
    }
}

