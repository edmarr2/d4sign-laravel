<?php

namespace Edmarr2\D4sign\Tests\Unit\Batches;

use Edmarr2\D4sign\Services\Batches;
use Edmarr2\D4sign\Tests\TestCase;

class BatchTest extends TestCase
{
    public function testBatchesCreateTest()
    {
        $batchesService = new Batches();
        self::assertEquals('{"message":"Invalid Keys"}', $batchesService->create(["2b2ec469-6b49-42bb-809f-d977279baeeb"]));
    }
}