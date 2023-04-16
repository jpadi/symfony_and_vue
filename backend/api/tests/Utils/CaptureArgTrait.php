<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\Constraint\Callback;

trait CaptureArgTrait
{
    /**
     * @param $arg
     * @return Callback
     */
    protected function captureArg(&$arg): Callback
    {
        return $this->callback(function ($argToMock) use (&$arg) {
            $arg = $argToMock;
            return true;
        });
    }
}