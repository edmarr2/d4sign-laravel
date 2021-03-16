<?php

namespace Edmarr2\D4sign\Services;

class Safes extends Client
{
    public function find($safeKey = '')
    {
        return $this->get('/safes/' . $safeKey);
    }
}