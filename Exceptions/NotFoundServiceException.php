<?php

namespace Exceptions;
/*
 * Class NotFoundServiceException
 * @package Exceptions
 */

class NotFoundServiceException extends \Exception{

    public function __construct($message, $code = 0, \Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return "{$this->message}";
    }
}