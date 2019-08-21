<?php

namespace Feature;

use PHPUnit\Framework\TestCase;
use App\Models\VirtualWallet;
use App\Models\Investor;
use App\Models\Loan;
use App\Models\Tranche;
use App\Models\Transaction;

class InvestorTest extends TestCase
{

    public function testCalculatePercentageForInvestor()
    {
        $wallet = new VirtualWallet(1000);
        $investor = new Investor($wallet);

        $loan = new Loan(new \DateTime('01.10.2015'), new \DateTime('15.11.2015'));
        $tranche = new Tranche(3, 1000);
        $tranche->setLoan($loan);
        $loan->addTranches($tranche);
        $transaction_1 = new Transaction(600, new \DateTime('03.10.2015'), $tranche, $investor);
        $transaction_1->payByTranche();

        $this->assertEquals(16.84, $investor->calculateMonthPercentage(10));

        $tranche_2 = new Tranche(6, 400);
        $tranche_2->setLoan($loan);
        $loan->addTranches($tranche_2);
        $transaction_2 = new Transaction(400, new \DateTime('07.10.2015'), $tranche_2, $investor);
        $transaction_2->payByTranche();

        $this->assertEquals(36.19, $investor->calculateMonthPercentage(10));
    }
}