<?php
namespace App\Services\MobileCause\Exceptions;

use Exception;

class TokenNotFoundException extends Exception
{
    /**
     * Create a new authentication exception.
     *
     * @param string  $message
     */
    public function __construct($message = 'API Token is required.')
    {
        parent::__construct($message);
    }
}
