<?php

namespace Exceptions;
/*
 * Abstract Class PaymentService
 * @package App\Services\PaymentServices
 */

class InvalidParametersNumberException extends \Exception{

    public function __construct($message, $code = 0, \Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return "{$this->message}";
    }
}