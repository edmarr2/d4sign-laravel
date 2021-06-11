<?php

namespace Edmarr2\D4sign\Services;

class Users extends Client
{
    /**
     * @return mixed
     */
    public function listAll()
    {
        return $this->get('users/list');
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function check($email)
    {
        return $this->post('users/check', [
            'email_user' => $email,
        ]);
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function block($email)
    {
        return $this->post('users/block', [
            'email_user' => $email,
        ]);
    }

    /**
     * @param $email
     *
     * @return mixed
     */
    public function unblock($email)
    {
        return $this->post('users/unblock', [
            'email_user' => $email,
        ]);
    }
}
