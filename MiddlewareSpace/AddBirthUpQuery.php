<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/7/5
 * Time: 下午5:05
 */

namespace MiddlewareSpace;

use BaseSpace\baseController;
use UtilSpace\UtilSqlTool;
use UtilSpace\UtilTool;

class AddBirthUpQuery extends baseController
{
    const BIRTHDAY_TABLE_PREFIX = 'oibirthday.br_birthdays_';

    public function getUserAddBirthCnt(\DateTime $addOn)
    {
        $srcSummationValue = $this->getSrcParamsKeyInit();
        $maxBirthTableNum = $this->get_number_birthday_number($this->getMaxUserId());
        $userCnt = 0;
        $defaultTable = 0;
        while ($defaultTable <= $maxBirthTableNum) {
            $srcValue = $this->getCurrentTableAddBirthCnt($defaultTable, $addOn->getTimestamp());
            $srcSummationValue = $this->summationDeviceSrcItemsCnt($srcSummationValue, $srcValue);
            $userCnt += $this->getCurrentTableAddBirthUserCnt($defaultTable, $addOn->getTimestamp());
            $defaultTable += 1;
        }
        echo "== ab: " . $srcSummationValue['ab'] . " == add: " . $srcSummationValue['add'] . " == yab: " . 
            $srcSummationValue['yab'] . " == of: " . $srcSummationValue['of'] . " == oi: " . $srcSummationValue['oi'] .
            " == qq: " . $srcSummationValue['qq'] . " == rr: " . $srcSummationValue['rr'] . " == wx: " . 
            $srcSummationValue['wx'] . " == pyq: " . $srcSummationValue['pyq'] .  " == birthGroup: " . $srcSummationValue['birthgroup'] . " \n";
        return array(
            'srcValue' => $srcSummationValue,
            'userCnt' => $userCnt,
        );
    }

    public function getSrcFromBirthGroup(\DateTime $addOn)
    {
        $maxBirthTableNum = $this->get_number_birthday_number($this->getMaxUserId());
        $defaultTable = 0;
        while ($defaultTable <= $maxBirthTableNum) {
            $this->getTableAddBirthDetail($defaultTable, $addOn->getTimestamp());
        }
    }

    public function getTableAddBirthDetail($table = 0, $addOnStamp = 0)
    {
        $tableName = self::BIRTHDAY_TABLE_PREFIX . $table;
        $keyQuery = $this->getQueryAddBirthDaySrcCnt($tableName, $addOnStamp, 'birthgroup');
        $result = $this->connectObj->fetchAssoc($keyQuery);
        foreach ($result as $item) {
            echo "{$item['userid']};{$item['name']};{$item['src']};{$item['add_on']} \n";
        }
    }
    
    public function getCurrentTableAddBirthCnt($table = 0, $addOnStamp = 0)
    {
        $tableName = self::BIRTHDAY_TABLE_PREFIX . $table;
        $srcValue = $this->getSrcParamsKeyInit();
        foreach ($srcValue as $key => &$value) {
            $keyQuery = $this->getQueryAddBirthDaySrcCnt($tableName, $addOnStamp, $key);
            $result = $this->connectObj->fetchCnt($keyQuery);
            $value += $result['cnt'];
        }
        return $srcValue;
    }
    
    public function getCurrentTableAddBirthUserCnt($table = 0, $addOnStamp = 0)
    {
        $tableName = self::BIRTHDAY_TABLE_PREFIX . $table;
        $userCntQuery = $this->getQueryAddBirthUniqueUserCnt($tableName, $addOnStamp);
        $result = $this->connectObj->fetchAssoc($userCntQuery);
        return count($result);
    }
}