<?php

/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/5/8
 * Time: 下午10:55
 */
require __DIR__ . '/Bootstrap.php';

use MiddlewareSpace\CoreTaskQuery;

class TmpUpdate extends CoreTaskQuery
{
    public function updatel()
    {
        $sql = "UPDATE oicakestat.user_core_task_retain_weekly_statis SET first_week_core_task_cnt = 3620 WHERE create_on = '2016-05-01'";
        $query0 = $this->connectObj->fetchCakeStatQuery($sql);
        if ($query0) {
            echo "==== tmp Insert 2016-05-06 Success !!! \n";
        }
    }

    public function update()
    {
        $query = "UPDATE oicakestat.user_retain_daily_statis SET second_day_cnt = 1243 WHERE create_on = '2016-05-06'";
        $query0 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query0) {
            echo "==== tmp Insert 2016-05-06 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET third_day_cnt = 959 WHERE create_on = '2016-05-05'";
        $query1 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query1) {
            echo "==== tmp Insert 2016-05-05 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET fourth_day_cnt = 676 WHERE create_on = '2016-05-04'";
        $query2 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query2) {
            echo "==== tmp Insert 2016-05-04 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET fifth_day_cnt = 619 WHERE create_on = '2016-05-03'";
        $query3 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query3) {
            echo "==== tmp Insert 2016-05-03 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET sixth_day_cnt = 512 WHERE create_on = '2016-05-02'";
        $query4 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query4) {
            echo "==== tmp Insert 2016-05-02 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET seventh_day_cnt = 485 WHERE create_on = '2016-05-01'";
        $query5 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query5) {
            echo "==== tmp Insert 2016-05-01 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET fifteen_day_cnt = 376 WHERE create_on = '2016-04-23'";
        $query6 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query6) {
            echo "==== tmp Insert 2016-04-23 Success !!! \n";
        }
        $query = "UPDATE oicakestat.user_retain_daily_statis SET thirty_day_cnt = 283 WHERE create_on = '2016-04-08'";
        $query7 = $this->connectObj->fetchCakeStatQuery($query);
        if ($query7) {
            echo "==== tmp Insert 2016-04-08 Success !!! \n";
        }
    }

}
$tmp = new TmpUpdate();
$tmp->updatel();