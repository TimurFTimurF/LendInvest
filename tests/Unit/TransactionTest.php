<?php


namespace Unit;


use App\Models\Investor;
use App\Models\Loan;
use App\Models\Tranche;
use App\Models\Transaction;
use App\Models\VirtualWallet;
use DateTime;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    public function testPayByTranche()
    {
        $wallet = new VirtualWallet(1000);
        $investor = new Investor($wallet);
        $loan = new Loan(new DateTime('01.10.2015'), new DateTime('15.11.2015'));
        $tranche = new Tranche(3, 1000);

        $tranche->setLoan($loan);

        $transaction = new Transaction(1000, new DateTime('03.10.2015'), $tranche, $investor);
        $this->assertEquals(true, $transaction->payByTranche());

        $this->expectException(\Exception::class);
        new Transaction(1001, new DateTime('03.10.2015'), $tranche, $investor);


        $loan = new Loan(new DateTime('01.10.2015'), new DateTime('15.11.2015'));
        $tranche = new Tranche(3, 1);

        $tranche->setLoan($loan);

        $this->expectException(\Exception::class);
        new Transaction(1000, new DateTime('03.10.2015'), $tranche, $investor);
    }
}