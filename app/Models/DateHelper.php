<?php

namespace App\Models;

/**
 * Class DateHelper
 * @package App\Models
 */
class DateHelper
{

    /**
     * @param int $month
     * @param int $year
     * @return int
     */
    public function getAllDaysForMonth(int $month, int $year): int
    {
       return cal_days_in_month(CAL_GREGORIAN, $month, $year);
    }
}