<?php

namespace Edmarr2\D4sign\Exceptions;


class InvalidCryptKeyException extends \Exception
{
    protected $message = 'CryptKey not found.';
}