<?php

namespace Edmarr2\D4sign\Services;

class Users extends Client
{
    public function listAll()
    {
        return $this->get('users/list');
    }
    public function check($email)
    {
        return $this->post('users/check', [
            'email_user' => json_encode($email)
        ]);
    }
    public function block($email)
    {
        return $this->post('users/block', [
            'email_user' => json_encode($email)
        ]);
    }
    public function unblock($email)
    {
        return $this->post('users/unblock',[
            'email_user' => json_encode($email)
        ]);
    }
}