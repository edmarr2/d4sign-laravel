<?php

namespace Edmarr2\D4sign\Services;

class Groups extends Client
{
    public function find($uuid_cofre)
    {
        return $this->get('groups/' . $uuid_cofre);
    }
}
