<?php

namespace Edmarr2\D4sign\Services;

class Watcher extends Client
{
    /**
     * @param $uuid_arquivo
     *
     * @return mixed
     */
    public function find($uuid_arquivo)
    {
        return $this->get('watcher/'.$uuid_arquivo);
    }

    /**
     * @param $uuid_arquivo
     * @param $email
     * @param  int  $perfil
     *
     * @return mixed
     */
    public function add($uuid_arquivo, $email, $perfil = 0)
    {
        return $this->post('watcher/'.$uuid_arquivo.'/add', [
            "email"      => $email,
            "permission" => $perfil
        ]);
    }

    /**
     * @param $uuid_arquivo
     * @param $email
     *
     * @return mixed
     */
    public function remove($uuid_arquivo, $email)
    {
        return $this->post('watcher/'.$uuid_arquivo.'/remove', [
            'email' => $email
        ]);
    }

    /**
     * @param $uuid_arquivo
     *
     * @return mixed
     */
    public function erase($uuid_arquivo)
    {
        return $this->post('watcher/'.$uuid_arquivo.'/erase');
    }
}
