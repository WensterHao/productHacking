<?php

/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/5/16
 * Time: 下午4:59
 */
require __DIR__ . '/Bootstrap.php';
use MiddlewareSpace\RegisterWechatAuthorize;

class WeChatAuthorize extends RegisterWechatAuthorize
{
    const DAILY_PLATFORM_STAT = 'daily_platform_register_wechat_stat';

    const DAILY_BRANDS_STAT = 'daily_brand_register_wechat_stat';

    public function updatePlatformRelateRatio()
    {
        $paramsId = array('id');
        $current = new \DateTime();
        $where = array('create_on' => "'" . $current->modify('-1 day')->format('Y-m-d') ."'");
        $selectQuery = $this->connectObj->selectParamsQuery(self::DAILY_PLATFORM_STAT, $paramsId, $where);
        $result = $this->connectObj->fetchAssoc($selectQuery);
        if (empty($result)) {
            echo "UnCatch the result where create_on :" . $where['create_on'] . "In " . self::DAILY_PLATFORM_STAT . " \n";
            return ;
        }
        $paramsIphone = $this->fetchProductListCnt(1001);
        $paramsAndroid = $this->fetchProductListCnt(1002);
        $params = $paramsIphone + $paramsAndroid;
        $updateQuery = $this->connectObj->updateParamsQuery(self::DAILY_PLATFORM_STAT, $params, $where);
        $query = $this->connectObj->fetchCakeStatQuery($updateQuery);
        if ($query) {
            echo " ===" . $where['create_on'] ." Update " . self::DAILY_PLATFORM_STAT . " success !!! \n";
        }
    }

    public function updateBrandRelateRatio()
    {
        $paramsId = array('id');
        $current = new \DateTime();
        $where = array('create_on' => "'" . $current->modify('-1 day')->format('Y-m-d') ."'");
        $selectQuery = $this->connectObj->selectParamsQuery(self::DAILY_BRANDS_STAT, $paramsId, $where);
        $result = $this->connectObj->fetchAssoc($selectQuery);
        if (empty($result)) {
            echo "UnCatch the result where create_on :" . $where['create_on'] . "In " . self::DAILY_BRANDS_STAT . " \n";
            return ;
        }
        // 先注解调,看数据
        $brandItems = $this->getRegisterMappingBrandInit();
        $brandBindItems = $this->fetchBrandsBindRelateRatio();
        $brandItems['xiaomi_bind_mp_cnt'] = $brandBindItems['xiaomi_cnt'];
        $brandItems['meizu_bind_mp_cnt'] = $brandBindItems['meizu_cnt'];
        $brandItems['oppo_bind_mp_cnt'] = $brandBindItems['oppo_cnt'];
        $brandItems['huawei_bind_mp_cnt'] = $brandBindItems['huawei_cnt'];
        $brandItems['vivo_bind_mp_cnt'] = $brandBindItems['vivo_cnt'];
        $brandItems['samsung_bind_mp_cnt'] = $brandBindItems['samsung_cnt'];
        $brandItems['zte_bind_mp_cnt'] = $brandBindItems['zte_cnt'];

        $brandBindFocusItems = $this->fetchBrandsBindRelateRatio(true);
        $brandItems['xiaomi_bind_focus_mp_cnt'] = $brandBindFocusItems['xiaomi_cnt'];
        $brandItems['meizu_bind_focus_mp_cnt'] = $brandBindFocusItems['meizu_cnt'];
        $brandItems['oppo_bind_focus_mp_cnt'] = $brandBindFocusItems['oppo_cnt'];
        $brandItems['huawei_bind_focus_mp_cnt'] = $brandBindFocusItems['huawei_cnt'];
        $brandItems['vivo_bind_focus_mp_cnt'] = $brandBindFocusItems['vivo_cnt'];
        $brandItems['samsung_bind_focus_mp_cnt'] = $brandBindFocusItems['samsung_cnt'];
        $brandItems['zte_bind_focus_mp_cnt'] = $brandBindFocusItems['zte_cnt'];
//        echo " ==== xiaomi_bind_mp_cnt: " . $brandItems['xiaomi_bind_mp_cnt'] . " \n";
//        echo " ==== meizu_bind_mp_cnt: " . $brandItems['meizu_bind_mp_cnt'] . " \n";
//        echo " ==== oppo_bind_mp_cnt: " . $brandItems['oppo_bind_mp_cnt'] . " \n";
//        echo " ==== huawei_bind_mp_cnt: " . $brandItems['huawei_bind_mp_cnt'] . " \n";
//        echo " ==== vivo_bind_mp_cnt: " . $brandItems['vivo_bind_mp_cnt'] . " \n";
//        echo " ==== samsumg_bind_mp_cnt: " . $brandItems['samsung_bind_mp_cnt'] . " \n";
//        echo " ==== zte_bind_mp_cnt: " . $brandItems['zte_bind_mp_cnt'] . " \n";
//        echo " ==== xiaomi_f_bind_mp_cnt: " . $brandItems['xiaomi_bind_focus_mp_cnt'] . " \n";
//        echo " ==== meizu_f_bind_mp_cnt: " . $brandItems['meizu_bind_focus_mp_cnt'] . " \n";
//        echo " ==== oppp_f_bind_mp_cnt: " . $brandItems['oppo_bind_focus_mp_cnt'] . " \n";
//        echo " ==== huawei_f_bind_mp_cnt: " . $brandItems['huawei_bind_focus_mp_cnt'] . " \n";
//        echo " ==== vivo_f_bind_mp_cnt: " . $brandItems['vivo_bind_focus_mp_cnt'] . " \n";
//        echo " ==== samsung_f_bind_mp_cnt: " . $brandItems['samsung_bind_focus_mp_cnt'] . " \n";
//        echo " ==== zte_f_bind_mp_cnt: " . $brandItems['zte_bind_focus_mp_cnt'] . " \n";

        // 先注解调,看数据
        $updateQuery = $this->connectObj->updateParamsQuery(self::DAILY_BRANDS_STAT, $brandItems, $where);
        $query = $this->connectObj->fetchCakeStatQuery($updateQuery);
        if ($query) {
            echo " ===" . $where['create_on'] ." Update " . self::DAILY_BRANDS_STAT . " success !!! \n";
        }

    }
}
$weChatAuth = new WeChatAuthorize();
$weChatAuth->updateBrandRelateRatio();
$weChatAuth->updatePlatformRelateRatio();