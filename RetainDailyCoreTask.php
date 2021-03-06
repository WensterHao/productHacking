<?php

/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/5/4
 * Time: 下午3:27
 */
require __DIR__ . '/Bootstrap.php';
use MiddlewareSpace\RetainForDay;

class RetainDailyCoreTask extends RetainForDay
{
    const USER_CORE_TASK_RETAIN_TABLE = 'user_core_task_retain_statis';
    
    public function updateBeforeRetain($extendStamp = 0)
    {
        $this->updateRetainForDay($extendStamp, 2);
        $this->updateRetainForDay($extendStamp, 3);
        $this->updateRetainForDay($extendStamp, 7);
        $this->updateRetainForDay($extendStamp, 15);
        $this->updateRetainForDay($extendStamp, 30);
        $this->updateRetainForDay($extendStamp, 60);
        $this->updateRetainForDay($extendStamp, 90);
    }

    // 每天执行当日完成核心任务的留存数据
    public function updateRetainForDay($extendStamp = 0, $isRetain = 0)
    {
        $timestamp = empty($extendStamp) ? time() : $extendStamp;
        $currentDate = strtotime(date('Y-m-d', $timestamp));

        $isRetainUnCT = $this->baseRetainDaily($currentDate, $isRetain, -1, 5);
        if (empty($isRetainUnCT)) {
            echo "UnCatch isRetainUnCT value, Please Check! \n";
            return false;
        }
        $isRetainCT = $this->baseRetainDaily($currentDate, $isRetain, 6, 1000);
        if (empty($isRetainCT)) {
            echo "UnCatch isRetainCT value, Please Check! \n";
            return false;
        }
        $paramsKey = $this->getIsRetainParamsDailyKey($isRetain);
        if (empty($paramsKey)) {
            echo "UnCatch the paramsKey from isRetain, Please check ! \n";
            return false;
        }
        $items = array(
            $paramsKey[1] => $isRetainCT,
            $paramsKey[2] => $isRetainUnCT
        );
        $loginIn = $currentDate - $isRetain * 86400;
        $loginInString = "'" . date('Y-m-d', $loginIn) . "'";
        if ($this->checkCurrentDateData(self::USER_CORE_TASK_RETAIN_TABLE, $loginInString)) {
            $where = array('create_on' => $loginInString);
            $updateQuery = $this->connectObj->updateParamsQuery(self::USER_CORE_TASK_RETAIN_TABLE, $items, $where);
            $query = $this->connectObj->fetchCakeStatQuery($updateQuery);
            if ($query) {
                echo " === " . $loginInString . " week isRetain : " . $isRetain . " success !!! \n";
            }
        }
    }
}
$retainDaily = new RetainDailyCoreTask();
$retainDaily->updateBeforeRetain();