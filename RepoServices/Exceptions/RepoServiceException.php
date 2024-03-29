<?php

namespace RepoServices\Exceptions;
/*
 * Class RepoServiceException
 * @package RepoServices\Exceptions
 */

class RepoServiceException extends \Exception{

    public function __construct($message, $code = 0, \Exception $previous = null) {

        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return "{$this->message}";
    }
}