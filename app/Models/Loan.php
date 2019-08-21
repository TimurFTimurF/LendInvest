<?php declare(strict_types=1);


namespace App\Models;

/**
 * Class Loan
 * @package App\Models
 */
class Loan
{

    /**
     * @var array
     */
    private $tranches = [];

    /**
     * @var int
     */
    private $startDate;

    /**
     * @var int
     */
    private $endDate;

    /**
     * @var int
     */
    private $status;

    /**
     * Loan constructor.
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getTranches(): array
    {
        return $this->tranches;
    }

    /**
     * @param int $id
     * @return Tranche
     */
    public function getTranche(int $id): Tranche
    {
        return $this->tranches[$id];
    }

    /**
     * @param Tranche $tranche
     */
    public function addTranches(Tranche $tranche): void
    {
        $this->tranches[] = $tranche;
    }

    public function removeTranche(int $id): void
    {
        unset($this->tranches[$id]);
    }

    public function isInPayedTime(\DateTime $payDate): bool
    {
        if (($payDate >= $this->startDate) && ($payDate <= $this->endDate)) {
            return true;
        } else {
            throw new \Exception('Loan pay is out of date.' . PHP_EOL);
        }
    }
}