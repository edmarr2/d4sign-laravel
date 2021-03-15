<?php

namespace Edmarr2\D4sign\Exceptions;


class WithoutCryptKeyException extends \Exception
{
    protected $message = 'CryptKey not found.';
}