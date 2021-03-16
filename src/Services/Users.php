<?php

namespace Edmarr2\D4sign\Services;

class Users extends Client
{
    public function listall()
    {
        return $this->get('/users/list');
    }
    public function check($email)
    {
        return $this->post('/users/check', [
            'email_user' => $email
        ]);
    }
    public function block($email)
    {
        return $this->post('/users/block', [
            'email_user' => $email
        ]);
    }
    public function unblock($email)
    {
        return $this->post('/users/unblock',[
            'email_user' => $email
        ]);
    }
}