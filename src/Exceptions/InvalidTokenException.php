<?php

namespace Edmarr2\D4sign\Exceptions;

class InvalidTokenException extends \Exception
{
    protected $message = 'API Token not found.';
}