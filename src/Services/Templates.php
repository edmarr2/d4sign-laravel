<?php

namespace Edmarr2\D4sign\Services;

class Templates extends Client
{
    /**
     * @param  string  $templateKey
     *
     * @return mixed
     */
    public function find($templateKey = '')
    {
        return $this->post('templates', [
            'id_template'=> $templateKey
        ]);
    }
}
