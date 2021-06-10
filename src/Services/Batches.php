<?php

namespace Edmarr2\D4sign\Services;

class Batches extends Client
{
    public function create($keys)
    {
        return $this->post('batches', ['keys' => json_encode($keys)]);
    }
}
