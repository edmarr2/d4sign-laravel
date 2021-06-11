<?php

namespace Edmarr2\D4sign\Services;

class Groups extends Client
{
    /**
     * @param $uuidSafe
     *
     * @return mixed
     */
    public function find($uuidSafe)
    {
        return $this->get('groups/' . $uuidSafe);
    }
}
