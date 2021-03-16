<?php

namespace Edmarr2\D4sign\Tests\Unit\Account;

use Edmarr2\D4sign\Services\Account;
use Edmarr2\D4sign\Tests\TestCase;

class AccountTest extends TestCase
{
    public function testBalanceTest()
    {
        $accountService = new Account();
        $accountService->balance()->getStatusCode();
    }
}