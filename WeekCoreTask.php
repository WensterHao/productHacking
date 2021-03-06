<?php

/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/5/4
 * Time: 下午5:23
 */
require __DIR__ . '/Bootstrap.php';

use MiddlewareSpace\CoreTaskQuery;

class WeekCoreTask extends CoreTaskQuery
{
    const USER_WEEK_BASE_TASK_TABLE = 'user_core_task_retain_weekly_statis';

    // 用户在当周完成核心任务的数据, 每周周一定时执行
    public function insertWeekBaseTaskCnt($extendTimeStamp = 0)
    {
        $timeStamp = empty($extendTimeStamp) ? time() : $extendTimeStamp;
        $dateTime = new \DateTime(date('Y-m-d', $timeStamp));
        $dateTime->modify('-1 day');
        $params = $this->fetchBirthLevelUsers($dateTime->getTimestamp(), 6, 7);
        $paramsList = array(
            'create_on' => "'". $dateTime->format('Y-m-d') ."'",
            'week_core_task_cnt' => $params['birth_cnt_rank_0610'] + $params['birth_cnt_rank_1000'],
            'week_uncore_task_cnt' => $params['birth_cnt_rank_0000'] + $params['birth_cnt_rank_0001'] + $params['birth_cnt_rank_0205']
        );
        $insertSql = $this->connectObj->insertParamsQuery(self::USER_WEEK_BASE_TASK_TABLE, $paramsList);
        $query = $this->connectObj->fetchCakeStatQuery($insertSql);
        if ($query) {
            echo "==== " . $paramsList['create_on'] . " week Insert " . self::USER_WEEK_BASE_TASK_TABLE . " Success !!! \n";
        }
    }
}
$weekRetain = new WeekCoreTask();
$weekRetain->insertWeekBaseTaskCnt();