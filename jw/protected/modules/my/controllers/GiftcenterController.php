<?php
class GiftcenterController extends Controller {
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules() {
        return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'roles'=>array(
                                User::ROLE_MEMBER,
                                User::ROLE_AUDIENCE
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex() {
        $allGift = Giftcenter::model()->findAll();
        $this->render('index',array(
                "allGift"=>$allGift
        ));
    }
    /**
     * 我的礼物
     */
    public function actionMy() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("gbl_receiveuserid"=>$userId));
        $criteria->order = "gbl_sendtime desc";
        $dataProvider =  new CActiveDataProvider("Giftbuylog", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>9,
                        ),

        ));
        $countAll = Giftbuylog::model()->count($criteria);
        $this->render("my",array(
                "dataProvider"=>$dataProvider,
                "countAll"=>$countAll
        ));
    }

    /**
     * 送出的道具
     */
    public function actionSend() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("gbl_userid"=>$userId));
        $criteria->order = "gbl_sendtime desc";
        $dataProvider =  new CActiveDataProvider("Giftbuylog", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>9,
                        ),

        ));
        $countAll = Giftbuylog::model()->count($criteria);
        $this->render("send",array(
                "dataProvider"=>$dataProvider,
                "countAll"=>$countAll
        ));
    }
    /**
     * 赠送
     */
    public function actionSendGift() {
        $receiveUserIdStr = @$_POST["receiveUserStr"];//接收者
        $sendType = @$_POST["sendType"];//发送类型
        $giftId = @$_POST["giftId"];//道具id
        if(!$receiveUserIdStr) {
            exit;
        }
        if(!$sendType&&!array_key_exists($sendType,Giftbuylog::$gbl_sendtype)) {
            exit;
        }
        //验证输入用户
        $userId = User::model()->getId();
        $receiveUserIdArr = explode(",",$receiveUserIdStr);
        $newReceiveUserIdArr = array();
        foreach($receiveUserIdArr as $value) {
            if(Propcenter::model()->checkCanSendProp($value)) {
                $newReceiveUserIdArr[] = $value;
            }
        }
        if(count($newReceiveUserIdArr)!=count($receiveUserIdArr)) {
            echo "您输入的用户中包含您不能赠送的用户。您必须先关注此用户才能赠送礼物";
            exit;
        }
        //验证金币是否足够
        $giftCenter = Giftcenter::model()->findByPk($giftId);
        $price = $giftCenter->gc_price;
        $needPrice = count($newReceiveUserIdArr)*$price;
        if(!User::model()->checkCanReduceGold($userId, $needPrice)) {
            echo "需要消耗".$needPrice."个金币，您的余额不足！";
            exit;
        }
        //开始赠送
        $time = time();
        foreach($newReceiveUserIdArr as $value) {
            //扣除金币
            User::model()->reduceGoldNum($userId, $price, "赠送礼物");
            //保存信息
            $model = new Giftbuylog();
            $model->gbl_userid = $userId;
            $model->gbl_receiveuserid = $value;
            $model->gbl_giftcenterid = $giftId;
            $model->gbl_sendtype = $sendType;
            $model->gbl_sendtime = $time;
            $model->save();
            //保存成功，添加动态
            Dynamicmy::model()->addDynamicmy(array($value), 5, $model->gbl_giftcenterid, $model->gbl_id);
        }
        echo "success";
        exit;
    }
}