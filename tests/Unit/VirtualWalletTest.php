<?php


namespace Unit;


use App\Models\VirtualWallet;
use PHPUnit\Framework\TestCase;

class VirtualWalletTest extends TestCase
{
    public function testGetAmount()
    {
        $wallet = new VirtualWallet(1000);

        $this->assertEquals(100, $wallet->getAmount(100));

        $this->expectException(\Exception::class);
        $wallet->getAmount(1000);
    }
}