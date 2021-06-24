<?php

namespace App\Exceptions;

use Exception;

class GatewayErrorException extends Exception
{
    public $raw;

    public function __construct($message = "", $code = 0, $raw = null)
    {
        $this->raw = $raw;
        parent::__construct($message, $code);
    }
}
