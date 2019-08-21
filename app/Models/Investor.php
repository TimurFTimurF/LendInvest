<?php declare(strict_types=1);

namespace App\Models;

/**
 * Class Investor
 * @package App\Models
 */
class Investor
{
    /**
     * @var VirtualWallet
     */
    private $virtualWallet;

    /**
     * @var array
     */
    private $transactions = [];

    /**
     * @var DateHelper
     */
    private $dateHelper;

    /**
     * Investor constructor.
     * @param VirtualWallet $virtualWallet
     */
    public function __construct(VirtualWallet $virtualWallet)
    {
        $this->dateHelper = new DateHelper();
        $this->virtualWallet = $virtualWallet;
    }

    /**
     * @return VirtualWallet
     */
    public function getWallet(): VirtualWallet
    {
        return $this->virtualWallet;
    }

    /**
     * @param VirtualWallet $virtualWallet
     */
    public function setWallet($virtualWallet): void
    {
        $this->virtualWallet = $virtualWallet;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @param $id
     * @return Transaction
     */
    public function getTransaction($id): Transaction
    {
        return $this->transactions[$id];
    }

    /**
     * @param Transaction $transaction
     */
    public function addTransaction(Transaction $transaction): void
    {
        $this->transactions[] = $transaction;
    }

    /**
     * @param $id
     */
    public function removeTransactions($id): void
    {
        unset($this->transactions[$id]);
    }

    /**
     * @param $month
     * @return float
     */
    public function calculateMonthPercentage($month): float {
        $extraMoney = 0;
        foreach ($this->transactions as $transaction) {
            $date = explode('.', $transaction->getPayDate()->format('d.m.Y') );
            if (isset($date[1]) && isset($date[2]) && $date[1] == $month) {
                $allDays =  $this->dateHelper->getAllDaysForMonth( $month, (int)$date[2]);
                $trancheDays = intval($allDays) - intval($date[0]) + 1;
                $percentage = $transaction->getTranche()->getPercentage();
                $monthPercentage = ($trancheDays * $percentage) / $allDays;
                $money = ($transaction->getAmount()/100) * $monthPercentage;
                $extraMoney += number_format($money, 2);
            }
        }
        return $extraMoney;
    }
}