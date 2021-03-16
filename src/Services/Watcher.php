<?php

namespace Edmarr2\D4sign\Services;

class Watcher extends Client
{
    public function find($uuid_arquivo)
    {
        return $this->get('watcher/' . $uuid_arquivo);
    }
    public function add($uuid_arquivo, $email, $perfil = 0)
    {
        return $this->post('watcher/' . $uuid_arquivo . '/add', [
            "email" => json_encode($email),
            "permission" => json_encode($perfil)
        ]);
    }
    public function remove($uuid_arquivo, $email)
    {
        return $this->post('watcher/' . $uuid_arquivo . '/remove', [
            'email' => json_encode($email)
        ]);
    }
    public function erase($uuid_arquivo)
    {
        return $this->post('watcher/' . $uuid_arquivo . '/erase');
    }
}