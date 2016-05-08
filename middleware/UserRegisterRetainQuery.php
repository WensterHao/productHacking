<?php

/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/5/8
 * Time: 下午3:06
 */
include __DIR__.'/../common/Common.php';
class UserRegisterRetainQuery
{
    public $connectObj;

    public function __construct(Common $common)
    {
        $this->connectObj = $common;
    }

    public function getCurrentRankMonthRegisterRetainCnt(\DateTime $pointDate, \DateTime $visitDate)
    {
        $pointMonthDays = intval(date('t', $pointDate->getTimestamp()));
        $visitMonthDays = intval(date('t', $visitDate->getTimestamp()));
        $loginEndStamp = $pointDate->getTimestamp() + ($pointMonthDays - 1) * 86400;
        $loginStartString = "TO_DAYS('" . $pointDate->format('Y-m-d') . "')";
        $loginEndString = "TO_DAYS('" . date('Y-m-d', $loginEndStamp) . "')";
        echo $loginStartString . "\n";
        echo $loginEndString . "\n";
        $visitEnd = $visitDate->getTimestamp() + ($visitMonthDays -1) * 86400;
        $visitStartString = "TO_DAYS('" . $visitDate->format('Y-m-d') . "')";
        $visitEndString = "TO_DAYS('" . date('Y-m-d', $visitEnd) . "')";
        echo $visitStartString . "\n";
        echo $visitEndString . "\n";
        $sql = sprintf("
        SELECT 
	COUNT(*) AS cnt 
FROM 
	oibirthday.users AS u 
WHERE 
	TO_DAYS(u.create_on) >= %s 
	AND TO_DAYS(u.create_on) <= %s 
	AND TO_DAYS(u.visit_on) >= %s 
	AND TO_DAYS(u.visit_on) <= %s
	",
            $loginStartString,
            $loginEndString,
            $visitStartString,
            $visitEndString);
        $query = $this->connectObj->fetchCnt($sql);
        return $query['cnt'];
    }

    public function getCurrentRankRegisterRetainCnt($currentStamp = 0, $isRetain = 0, $minCycle = 0)
    {
        $currentDate = date('Y-m-d', $currentStamp);
        $endRank = $isRetain + 1;
        $loginEndDate = $this->connectObj->calculateLoginIn($currentStamp, $endRank);
        $loginEndString = "TO_DAYS(" . $loginEndDate . ")";
        $startRank = $isRetain + $minCycle;
        $loginStartDate = $this->connectObj->calculateLoginIn($currentStamp, $startRank);
        $loginStartString = "TO_DAYS(" . $loginStartDate . ")";
        $visitDate = new \DateTime($currentDate);
        $visitDate->modify('-1 days');
        $visitStartDate = $this->connectObj->calculateLoginIn($currentStamp, $minCycle);
        $visitStartString = "TO_DAYS(" . $visitStartDate . ")";
        $visitEndString = "TO_DAYS('" . $visitDate->format('Y-m-d') . "')";
        $sql = sprintf("
        SELECT 
	COUNT(*) AS cnt 
FROM 
	oibirthday.users AS u 
WHERE 
	TO_DAYS(u.create_on) >= %s 
	AND TO_DAYS(u.create_on) <= %s 
	AND TO_DAYS(u.visit_on) >= %s 
	AND TO_DAYS(u.visit_on) <= %s
	",
            $loginStartString,
            $loginEndString,
            $visitStartString,
            $visitEndString);
        $query = $this->connectObj->fetchCnt($sql);
        return $query['cnt'];
    }

    public function checkCurrentDateData($tableName, $dayString)
    {
        $sql = sprintf("
        SELECT COUNT(*) AS cnt
        FROM %s AS ups
        WHERE ups.`create_on` = %s",
            $tableName,
            $dayString
        );
        $query = $this->connectObj->fetchCnt($sql);
        if ($query['cnt']) {
            return true;
        }
        return false;
    }

    public function getIsRetainWeekParamsKey($isRetain)
    {
        $paramsKeys = array(
            7 => 'first_week_user_cnt',
            14 => 'second_week_user_cnt',
            21 => 'third_week_user_cnt',
            28 => 'fourth_week_user_cnt',
            35 => 'fifth_week_user_cnt',
            42 => 'sixth_week_user_cnt',
            49 => 'seventh_week_user_cnt',
            56 => 'eighth_week_user_cnt',
            63 => 'ninth_week_user_cnt',
        );
        return $paramsKeys[$isRetain];
    }

    public function getIsRetainMonthParamsKey($isRetain)
    {
        $paramsKeys = array(
            1 => 'first_month_user_cnt',
            2 => 'second_month_user_cnt',
            3 => 'third_month_user_cnt',
            4 => 'fourth_month_user_cnt',
            5 => 'fifth_month_user_cnt',
            6 => 'sixth_month_user_cnt',
            7 => 'seventh_month_user_cnt',
            8 => 'eighth_month_user_cnt',
            9 => 'ninth_month_user_cnt',
        );
        return $paramsKeys[$isRetain];
    }

    public function getIsRetainDailyParamsKey($isRetain = 0)
    {
        $paramsKey = array(
            2 => 'second_day_cnt',
            3 => 'third_day_cnt',
            4 => 'fourth_day_cnt',
            5 => 'fifth_day_cnt',
            6 => 'sixth_day_cnt',
            7 => 'seventh_day_cnt',
            15 => 'fifteen_day_cnt',
            30 => 'thirty_day_cnt',
        );
        return $paramsKey[$isRetain];
    }
}