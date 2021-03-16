<?php

namespace Edmarr2\D4sign\Services;

class Templates extends Client
{
    public function find($templateKey = '')
    {
        return $this->client->request("/templates", [
            'id_template'=> $templateKey
        ]);
    }
}