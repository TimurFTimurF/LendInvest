<?php


namespace App\Models;


class Transaction
{

    /**
     * @var int
     */
    private $amount;

    /**
     * @var Investor
     */
    private $investor;

    /**
     * @var Tranche
     */
    private $tranche;

    /**
     * @var \DateTime
     */
    private $payDate;

    public function __construct(int $amount,\DateTime $payDate, Tranche $tranche, Investor $investor)
    {
        $this->setAmount($investor->getWallet()->getAmount($amount));
        $this->setPayDate($payDate);
        $this->setTranche($tranche);
        $this->setInvestor($investor);
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return Investor
     */
    public function getInvestor(): Investor
    {
        return $this->investor;
    }

    /**
     * @param Investor $investor
     */
    public function setInvestor(Investor $investor): void
    {
        $this->investor = $investor;
    }

    /**
     * @return Tranche
     */
    public function getTranche(): Tranche
    {
        return $this->tranche;
    }

    /**
     * @param Tranche $tranche
     */
    public function setTranche(Tranche $tranche): void
    {
        $this->tranche = $tranche;
    }

    /**
     * @return \DateTime
     */
    public function getPayDate(): \DateTime
    {
        return $this->payDate;
    }

    /**
     * @param \DateTime $payDate
     */
    public function setPayDate(\DateTime $payDate): void
    {
        $this->payDate = $payDate;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function payByTranche(): bool
    {
        $amount = $this->getAmount();

        $isPayed = false;

        if($this->tranche->getMaxAmount() > $amount || $this->tranche->getLoan()->isInPayedTime($this->payDate)) {
            if ($this->tranche->addToCurrentAmount($amount)){
                $this->investor->addTransaction($this);
                $isPayed = true;
            }
        }

        return $isPayed;
    }

}