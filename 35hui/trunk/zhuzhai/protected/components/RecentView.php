<?php

Yii::import("zii.widgets.CPortlet");

class RecentView extends CPortlet {

    public $counts = 5; //默认的返回最近浏览的房源的数量
    public $cssType = "office";//默认使用写字楼的样式。可选项{shop、office}

    const officebaseinfo = 1; //写字楼
    const business = 2; //商务中心
    const quickrelease = 3; //快速发布
    const shopbaseinfo = 4; //商铺类型
    const residencebaseinfo = 5; //住宅类型

    const rent = 1;
    const sell = 2;
    private static $recentOfficeViewCookieName = "rentOfficeView"; //记录最近浏览的写字楼房源id.cookie名称

    public function renderContent() {
        $recentOfficeViewIds = $this->getRecentViewOfficeIds(); //得到最近浏览的写字楼出租房源的id集合
        $recentViewInfo = $this->getRecentViewInfoByIds($recentOfficeViewIds); //得到最近浏览过的房源信息
        $this->render('RecentView', array(
            'recentViewInfo' => $recentViewInfo,
            'cssType'=>$this->cssType
        ));
    }

    /**
     * 返回最近浏览的写字楼id
     * @return <type>
     */
    public function getRecentViewOfficeIds() {
        $cookie_recentOfficeView = Yii::app()->request->cookies[self::$recentOfficeViewCookieName];
        if ($cookie_recentOfficeView) {
            $allViews = $cookie_recentOfficeView->value;
            $size = count($allViews);
            if ($size <= $this->counts) {//已有的比需要返回的数量要少,那么就返回所有的
                return $allViews;
            } else {//返回指定数量个
                $resultArray = array();
                for ($i = $size; $i > $size - $this->counts; $i--) {
                    array_push($resultArray, $allViews[$i]);
                }
                return $resultArray;
            }
        } else {
            return array();
        }
    }

    /**
     * 根据条件,返回详细查看的链接array
     * @param <int> $id 房源id
     * @param <int> $type 房源类型
     * @param <int> $rentorsell 出租出售类型
     * @return <array> array(id=>'','title'=>'','rsName'=>'','link'=>'','price'=>'')
     */
    private function getFormatInfoByCondition($id, $type, $rentorsell) {
        $resultArray = array();
        if ($type == self::officebaseinfo) {
            if ($rentorsell == self::rent) {
                $officebaseInfo = Officebaseinfo::model()->with('rentInfo', 'presentInfo')->findByPk($id);
                if (!empty($officebaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $officebaseInfo->presentInfo['op_officetitle'],
                        'rsName' => '出租',
                        'link' => array('officebaseinfo/rentView', 'id' => $id),
                        'price' => $officebaseInfo->rentInfo['or_rentprice'] . '元/平米·天',
                    );
                }
            } elseif ($rentorsell == self::sell) {
                $officebaseInfo = Officebaseinfo::model()->with('sellInfo', 'presentInfo')->findByPk($id);
                if (!empty($officebaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $officebaseInfo->presentInfo['op_officetitle'],
                        'rsName' => '出售',
                        'link' => array('officebaseinfo/saleView', 'id' => $id),
                        'price' => ($officebaseInfo->sellInfo['os_sumprice']) . "万元/套",
                    );
                }
            }
        } elseif ($type == self::business) {
            if ($rentorsell == self::rent) {
                $officebaseInfo = Officebaseinfo::model()->with('rentInfo', 'presentInfo')->findByPk($id);
                if (!empty($officebaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $officebaseInfo->presentInfo['op_officetitle'],
                        'rsName' => '出租',
                        'link' => array('officebaseinfo/businessSummarize', 'opid' => $id),
                        'price' => $officebaseInfo->rentInfo['or_rentprice'] . '元/间·月',
                    );
                }
            } elseif ($rentorsell == self::sell) {
                $officebaseInfo = Officebaseinfo::model()->with('sellInfo', 'presentInfo')->findByPk($id);
                if (!empty($officebaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $officebaseInfo->presentInfo['op_officetitle'],
                        'rsName' => '出售',
                        'link' => array('officebaseinfo/businessSummarize', 'opid' => $id),
                        'price' => ($officebaseInfo->sellInfo['os_sumprice'] / 10000) . "万元/套",
                    );
                }
            }
        } elseif ($type == self::quickrelease) {
            $quickreleaseInfo = Quickrelease::model()->findByPk($id);
            if (!empty($quickreleaseInfo)) {
                $resultArray = array(
                    'id' => $id,
                    'title' => $quickreleaseInfo->qrl_title,
                    'rsName' => $rentorsell == self::rent ? '出租' : '出售',
                    'link' => array('quickrelease/view', 'id' => $id),
                    'price' => '无',
                );
            }
        } elseif ($type == self::shopbaseinfo) {
            if ($rentorsell == self::rent) {
                $shopbaseInfo = Shopbaseinfo::model()->findByPk($id);
                if (!empty($shopbaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $shopbaseInfo->presentInfo->sp_shoptitle,
                        'rsName' => $rentorsell == self::rent ? '出租' : '出售',
                        'link' => array('shop/view', 'id' => $id),
                        'price' => $shopbaseInfo->rentInfo->sr_rentprice.'元/平米·天'
                    );
                }
            }elseif($rentorsell == self::sell){
                $shopbaseInfo = Shopbaseinfo::model()->findByPk($id);
                if (!empty($shopbaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $shopbaseInfo->presentInfo->sp_shoptitle,
                        'rsName' => $rentorsell == self::rent ? '出租' : '出售',
                        'link' => array('shop/view', 'id' => $id),
                        'price' => $shopbaseInfo->sellInfo->ss_avgprice.'元/平米·天'
                    );
                }
            }
        }elseif ($type == self::residencebaseinfo) {
            if ($rentorsell == self::rent) {
                $residencebaseInfo = Residencebaseinfo::model()->findByPk($id);
                if (!empty($residencebaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $residencebaseInfo->rbi_title,
                        'rsName' => $rentorsell == self::rent ? '出租' : '出售',
                        'link' => array('communitybaseinfo/viewResidence', 'id' => $id),
                        'price' => $residencebaseInfo->rentInfo->rr_rentprice.'元/月'
                    );
                }
            }elseif($rentorsell == self::sell){
                $residencebaseInfo = Residencebaseinfo::model()->findByPk($id);
                if (!empty($residencebaseInfo)) {
                    $resultArray = array(
                        'id' => $id,
                        'title' => $residencebaseInfo->rbi_title,
                        'rsName' => $rentorsell == self::rent ? '出租' : '出售',
                        'link' => array('communitybaseinfo/viewResidence', 'id' => $id),
                        'price' => @$residencebaseInfo->sellInfo->rs_price.'万元/套'
                    );
                }
            }
        }
        return $resultArray;
    }

    /**
     * 根据符合规范的条件,返回需要的数据信息集合
     * @param <array> $ids 二维数组
     * @return <array> 二维数组
     */
    public function getRecentViewInfoByIds($ids) {
        $recentViewInfo = array();
        if ($ids) {
            foreach ($ids as $idInfo) {
                $sourceInfo = json_decode($idInfo, true); //把json转换成array
                if (isset($sourceInfo['id']) && isset($sourceInfo['type']) && isset($sourceInfo['rs'])) {//符合规范
                    $recentViewInfo[] = $this->getFormatInfoByCondition($sourceInfo['id'], $sourceInfo['type'], $sourceInfo['rs']);
                }
            }
        }
        return $recentViewInfo;
    }

    /**
     * 添加访问痕迹
     * @param <type> $id 房源Id
     * @param <type> $type 房源类型
     */
    public static function addViewTrace($id, $type, $rentorsell) {
        $cookArray = array(
            'id' => $id,
            'type' => $type,
            'rs' => $rentorsell
        );
        $cookString = json_encode($cookArray); //把数组转换成json
        $cookie_recentOfficeView = Yii::app()->request->cookies[self::$recentOfficeViewCookieName];
        if ($cookie_recentOfficeView) {//如果存在
            $size = count($cookie_recentOfficeView->value);
            if (!self::checkHasTraced($cookString, $cookie_recentOfficeView->value)) {
                $nextKey = strval($size + 1);
                $cookie = new CHttpCookie(self::$recentOfficeViewCookieName . '[' . $nextKey . ']', $cookString);
                Yii::app()->request->cookies[self::$recentOfficeViewCookieName . '[' . $nextKey . ']'] = $cookie;
            }
        } else {//不存在
            $cookie = new CHttpCookie(self::$recentOfficeViewCookieName . '[1]', $cookString);
            Yii::app()->request->cookies[self::$recentOfficeViewCookieName . '[1]'] = $cookie;
        }
    }

    /**
     * 检验cookie中是否已经保存了该类型的房源信息
     * @param <type> $sourceInfo
     * @param <type> $cookie
     * @return <type>
     */
    public static function checkHasTraced($sourceInfo, $cookie) {
        $sourceIds = array();
        foreach ($cookie as $cook) {
            if ($sourceInfo == $cook) {
                return true;
            }
        }
        return false;
    }

}
