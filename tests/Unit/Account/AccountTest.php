<?php

namespace Edmarr2\D4sign\Tests\Unit\Account;

use Edmarr2\D4sign\Services\D4sign;
use Edmarr2\D4sign\Tests\TestCase;

class AccountTest extends TestCase
{
    private $d4sign;

    /**
     *
     * @test
     */
    public function verifyGetBalance()
    {
        $this->d4sign = new D4sign();
        $this->assertJson($this->d4sign->account->balance()->getBody()->getContents());
    }
}