<?php

namespace Edmarr2\D4sign\Exceptions;

class WithoutTokenException extends \Exception
{
    protected $message = 'API Token not found.';
}