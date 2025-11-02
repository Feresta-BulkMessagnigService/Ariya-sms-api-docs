<?php

namespace PersiaFava\Sms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sms
 *
 * This is the public-facing Facade for the SMS Service.
 * It provides a static-like interface (e.g., Sms::send()) to the
 * main SmsService class bound in the service container.
 *
 * @see \PersiaFava\Sms\SmsService
 */
class Sms extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * This is the "magic key" that connects this Facade to the
     * concrete implementation (SmsService) within Laravel's
     * service container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        // This string MUST match the key we bind in the SmsServiceProvider
        return 'PersiaFava\Sms\SmsService';
    }
}
