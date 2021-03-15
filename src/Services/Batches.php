<?php

namespace Edmarr2\D4sign\Services;

class Batches extends Client
{
    public function create(array $keys)
    {
        return $this->post('/batches/', [
            'keys' => $keys
        ]);
    }
}