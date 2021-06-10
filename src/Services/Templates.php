<?php

namespace Edmarr2\D4sign\Services;

class Templates extends Client
{
    public function find($templateKey = '')
    {
        return $this->post('templates', [
            'id_template'=> json_encode($templateKey)
        ]);
    }
}
