<?php

namespace Edmarr2\D4sign\Services;

class Tags extends Client
{
    public function find($uuid_arquivo)
    {
        return $this->get('/tags/' . $uuid_arquivo);
    }
    public function add($uuid_arquivo, $tag)
    {
        return $this->post('/tags/' . $uuid_arquivo . '/add', [
            'tag' => $tag
        ]);
    }
    public function remove($uuid_arquivo, $tag)
    {
        return $this->post('/tags/' . $uuid_arquivo . '/remove',[
            'tag' => $tag
        ]);
    }
    public function erase($uuid_arquivo, $tag)
    {
        return $this->post("/tags/$uuid_arquivo/erase", [
            'tag' => $tag
        ]);
    }
}