<?php

namespace Edmarr2\D4sign\Services;

class Tags extends Client
{
    /**
     * @param $uuid_arquivo
     *
     * @return mixed
     */
    public function find($uuid_arquivo)
    {
        return $this->get('tags/'.$uuid_arquivo);
    }

    /**
     * @param $uuid_arquivo
     * @param $tag
     *
     * @return mixed
     */
    public function add($uuid_arquivo, $tag)
    {
        return $this->post('tags/'.$uuid_arquivo.'/add', [
            'tag' => $tag
        ]);
    }

    /**
     * @param $uuid_arquivo
     * @param $tag
     *
     * @return mixed
     */
    public function remove($uuid_arquivo, $tag)
    {
        return $this->post('tags/'.$uuid_arquivo.'/remove', [
            'tag' => $tag
        ]);
    }

    /**
     * @param $uuid_arquivo
     * @param $tag
     *
     * @return mixed
     */
    public function erase($uuid_arquivo, $tag)
    {
        return $this->post('tags/'.$uuid_arquivo.'/erase', [
            'tag' => $tag
        ]);
    }

}
