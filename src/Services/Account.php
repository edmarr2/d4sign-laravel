<?php

namespace Edmarr2\D4sign\Services;

class Account extends Client
{
    public function balance()
    {
        return $this->get('account/balance');
    }
}