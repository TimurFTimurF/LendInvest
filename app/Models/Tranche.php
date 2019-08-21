<?php declare(strict_types=1);

namespace App\Models;

/**
 * Class Tranche
 * @package App\Models
 */
class Tranche
{

    /**
     * @var float
     */
    private $maxAmount;

    /**
     * @var float
     */
    private $percentage;

    /**
     * @var float
     */
    private $currentAmount;

    /**
     * @var Loan
     */
    private $loan;

    public function __construct(float $percentage, int $maxAmount)
    {
        $this->setPercentage($percentage);
        $this->setMaxAmount($maxAmount);
    }

    /**
     * @return float
     */
    public function getMaxAmount(): float
    {
        return $this->maxAmount;
    }

    /**
     * @param float $maxAmount
     */
    public function setMaxAmount(float $maxAmount): void
    {
        $this->maxAmount = $maxAmount;
    }

    /**
     * @return float
     */
    public function getPercentage(): float
    {
        return $this->percentage;
    }

    /**
     * @param float $percentage
     */
    public function setPercentage(float $percentage): void
    {
        $this->percentage = $percentage;
    }

    /**
     * @return float
     */
    public function getCurrentAmount(): float
    {
        return $this->currentAmount;
    }

    /**
     * @param float $amount
     * @return bool
     * @throws \Exception
     */
    public function addToCurrentAmount(float $amount): bool
    {
        $isPayed = false;
        if (($this->currentAmount + $amount) <= $this->maxAmount) {
            $this->currentAmount = $this->currentAmount + $amount;
            $isPayed = true;
        } else {
            throw new \Exception('Tranche money limit is exceeded.' . PHP_EOL);
        }

        return $isPayed;
    }

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }

    /**
     * @param Loan $loan
     */
    public function setLoan(Loan $loan): void
    {
        $this->loan = $loan;
    }

}