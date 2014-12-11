<?php

class ActionDateTest extends PHPUnit_Framework_TestCase
{

    public $dates;

    public function setUp()
    {
        $this->dates = new ActionDate();
    }

    public function testDaysToEndIsInteger()
    {
        $this->dates->setDaysToEndMonth(5);
        $this->assertTrue(is_int($this->dates->days_to_end));
    }

    public function testDaysToEndIsNotInteger1()
    {
        $this->dates->setDaysToEndMonth('sdf');
        $this->assertTrue(is_int($this->dates->days_to_end));
    }

    public function testDaysToEndIsNotInteger2()
    {
        $this->dates->setDaysToEndMonth(true);
        $this->assertTrue(is_int($this->dates->days_to_end));

    }

    public function testDaysToEndIsNotInteger3()
    {
        $this->dates->setDaysToEndMonth(123.12);
        $this->assertTrue(is_int($this->dates->days_to_end));

    }

    public function testDaysToEndIsNotInteger4()
    {
        $this->dates->setDaysToEndMonth('123.12');
        $this->assertTrue(is_int($this->dates->days_to_end));

    }

    public function testDaysToEndIsNotInteger5()
    {
        $this->dates->setDaysToEndMonth('123,12');
        $this->assertTrue(is_int($this->dates->days_to_end));
    }

    public function testDaysToEndIsLesserThenMonthLength1()
    {
        $this->dates->setDaysToEndMonth(15);
        $this->assertEquals(15, $this->dates->days_to_end);
    }

    public function testDaysToEndIsLesserThenMonthLength2()
    {
        $dates = new ActionDate('05-02-2015');
        $dates->setDaysToEndMonth(28);
        $this->assertEquals(28, $dates->days_to_end);
    }

    public function testDaysToEndIsBiggerThenMonthLength1()
    {
        $this->dates->setDaysToEndMonth(32);
        $this->assertEquals(0, $this->dates->days_to_end);
    }

    public function testDaysToEndIsBiggerThenMonthLength2()
    {
        $dates = new ActionDate('05-02-2015');
        $dates->setDaysToEndMonth(29);
        $this->assertEquals(0, $dates->days_to_end);
    }

    public function testDaysToEndIsBiggerThenMonthLength3()
    {
        $dates = new ActionDate('05-02-2016');
        $dates->setDaysToEndMonth(30);
        $this->assertEquals(0, $dates->days_to_end);
    }

    public function testLastDayOfCurrentMonth1()
    {
        $dates = new ActionDate('05-02-2015');
        $this->assertEquals(array('day' => '28', 'month' => '2', 'year' => '2015'), $dates->getLastDayCurrMonth());

    }

    public function testLastDayOfCurrentMonth2()
    {
        $dates = new ActionDate('30-11-2014');
        $this->assertEquals(array('day' => '30', 'month' => '11', 'year' => '2014'), $dates->getLastDayCurrMonth());
    }

    public function testLastDayOfCurrentMonth3()
    {
        $dates = new ActionDate('05-02-2016');
        $this->assertEquals(array('day' => '29', 'month' => '2', 'year' => '2016'), $dates->getLastDayCurrMonth());
    }

    public function testLastDayOfNextMonth1()
    {
        $dates = new ActionDate('05-01-2015');
        $this->assertEquals(array('day' => '28', 'month' => '2', 'year' => '2015'), $dates->getLastDayNextMonth());
    }

    public function testLastDayOfNextMonth2()
    {
        $dates = new ActionDate('31-10-2015');
        $this->assertEquals(array('day' => '30', 'month' => '11', 'year' => '2015'), $dates->getLastDayNextMonth());
    }

    public function testLastDayOfNextMonth3()
    {
        $dates = new ActionDate('31-1-2016');
        $this->assertEquals(array('day' => '29', 'month' => '2', 'year' => '2016'), $dates->getLastDayNextMonth());
    }

    public function testLastDayOfNextMonth4()
    {
        $dates = new ActionDate('31-12-2014');
        $this->assertEquals(array('day' => '31', 'month' => '1', 'year' => '2015'), $dates->getLastDayNextMonth());
    }

    public function testActionDate1()
    {
        $dates = new ActionDate('11-12-2014');
        $dates->setDaysToEndMonth(5);
        $this->assertEquals(array('day' => '31', 'month' => '12', 'year' => '2014'), $dates->getActionDate());
    }

    public function testActionDate2()
    {
        $dates = new ActionDate('11-02-2015');
        $dates->setDaysToEndMonth(5);
        $this->assertEquals(array('day' => '28', 'month' => '2', 'year' => '2015'), $dates->getActionDate());
    }

    public function testActionDate3()
    {
        $dates = new ActionDate('11-02-2016');
        $dates->setDaysToEndMonth(5);
        $this->assertEquals(array('day' => '29', 'month' => '2', 'year' => '2016'), $dates->getActionDate());
    }

    public function testActionDate4()
    {
        $dates = new ActionDate('28-12-2014');
        $dates->setDaysToEndMonth(5);
        $this->assertEquals(array('day' => '31', 'month' => '1', 'year' => '2015'), $dates->getActionDate());
    }

    public function testActionDate5()
    {
        $dates = new ActionDate('28-02-2015');
        $dates->setDaysToEndMonth(5);
        $this->assertEquals(array('day' => '31', 'month' => '3', 'year' => '2015'), $dates->getActionDate());
    }

    public function testActionDate6()
    {
        $dates = new ActionDate('28-02-2016');
        $dates->setDaysToEndMonth(5);
        $this->assertEquals(array('day' => '31', 'month' => '3', 'year' => '2016'), $dates->getActionDate());
    }

}