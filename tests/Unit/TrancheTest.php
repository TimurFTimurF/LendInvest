<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Tranche;

class TrancheTest extends TestCase
{

    public function testAddToCurrentAmount()
    {
        $tranche_1 = new Tranche(3, 1000);
        $this->assertEquals(true, $tranche_1->addToCurrentAmount(1000));
        $this->expectException(\Exception::class);
        $this->assertEquals(true, $tranche_1->addToCurrentAmount(1000));
    }
}