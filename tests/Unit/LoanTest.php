<?php

namespace Test;

use App\Models\Loan;
use DateTime;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{

    public function testIsInPayedTime()
    {
        $loan = new Loan(new DateTime('01.10.2015'), new DateTime('15.11.2015'));

        $this->assertEquals(true, $loan->isInPayedTime(new DateTime('04.10.2015')));

        $this->expectException(\Exception::class);

        $loan->isInPayedTime(new DateTime('01.09.2015'));
    }
}