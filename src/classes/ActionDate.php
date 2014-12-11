<?php

class ActionDate
{
    public $curr_day;
    public $curr_month;
    public $curr_year;
    public $month_length;
    public $days_to_end = 0;

    public function __construct($date = null)
    {
        $curr_date = $this->getCurrentDate($date);
        $this->curr_day = date('j', $curr_date);
        $this->curr_month = date('n', $curr_date);
        $this->curr_year = date('Y', $curr_date);
        $this->month_length = date('t', $curr_date);
    }

    protected function getCurrentDate($date)
    {
        $timestamp = null;
        if ($date) {
            $timestamp = strtotime($date);
        }
        $current_date = $timestamp ? $timestamp : time();
        return $current_date;
    }

    public function setDaysToEndMonth($days)
    {
        $this->days_to_end = (int)$days;
        if ($this->days_to_end > $this->month_length) $this->days_to_end = 0;
    }

    public function getLastDayCurrMonth()
    {
        $date = mktime(0, 0, 0, $this->curr_month + 1, 0, $this->curr_year);
        $output = array(
            'day' => date('j', $date),
            'month' => date('n', $date),
            'year' => date('Y', $date)
        );
        return $output;
    }

    public function getLastDayNextMonth()
    {
        $date = mktime(0, 0, 0, $this->curr_month + 2, 0, $this->curr_year);
        $output = array(
            'day' => date('j', $date),
            'month' => date('n', $date),
            'year' => date('Y', $date)
        );
        return $output;
    }

    public function getActionDate()
    {
        $last_day_month = $this->getLastDayCurrMonth();
        if ($this->curr_day < ($last_day_month['day'] - $this->days_to_end)) {
            return $last_day_month;
        } else {
            return $this->getLastDayNextMonth();
        }
    }

}