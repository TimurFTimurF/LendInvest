<?php declare(strict_types=1);

namespace App\Models;

/**
 * Class VirtualWallet
 * @package App\Models
 */
class VirtualWallet
{
    /**
     * @var float
     */
    private $amount = 0;

    /**
     * VirtualWallet constructor.
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        $this->addAmount($amount);
    }

    public function showAmount(): float
    {

    }

    /**
     * @param int $amount
     * @return float
     * @throws \Exception
     */
    public function getAmount(int $amount): float
    {
        if(($this->amount - $amount) < 0) {
            throw new \Exception('Not enough money in wallet' . PHP_EOL);
        }

        $this->amount = $this->amount - $amount;

        return $amount;
    }

    /**
     * @param float $amount
     */
    public function addAmount(float $amount): void
    {
        $this->amount += $amount;
    }

}