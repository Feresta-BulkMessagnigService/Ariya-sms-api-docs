<?php

namespace PersiaFava\Sms\Exceptions;

use Exception;

/**
 * Class SmsException
 * * A custom exception class used for handling errors specific to the SMS API.
 * It extends the base Exception class to include an HTTP status code.
 */
class SmsException extends Exception
{
    /**
     * The HTTP status code from the API response, if available.
     *
     * @var int|null
     */
    protected $statusCode;

    /**
     * SmsException constructor.
     *
     * @param string $message The exception message.
     * @param int|null $statusCode The HTTP status code from the API response.
     * @param Exception|null $previous The previous exception used for exception chaining.
     */
    public function __construct($message = "An unexpected error occurred", $statusCode = null, Exception $previous = null)
    {
        $this->statusCode = $statusCode;
        
        // Pass the message and a default code (0) to the parent Exception constructor
        parent::__construct($message, 0, $previous);
    }

    /**
     * Gets the HTTP status code associated with this exception.
     *
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
