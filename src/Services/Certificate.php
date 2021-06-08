<?php

namespace Edmarr2\D4sign\Services;

class Certificate extends Client
{
    public function find($uuid_arquivo, $key_signer)
    {
        return $this->post('certificate/' . $uuid_arquivo . '/list', ['key_signer' => $key_signer]);
    }

    public function add($uuid_arquivo, int $key_signer, $document_type, $document_number = '', $pades='')
    {
        return $this->post('certificate/' . $uuid_arquivo . '/add', [
            'key_signer' => $key_signer,
            'document_type' => $document_type,
            'pades' => $pades,
            'document_number' => $document_number
        ]);
    }
}