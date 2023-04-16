<?php

namespace App\PersonModule\Exception;

class ValidationException extends \Exception
{

    /**
     * @param $msg
     * @param $prevException
     */
    public function __construct($msg, $prevException = null)
    {
        parent::__construct($msg, 400, $prevException);
    }


}