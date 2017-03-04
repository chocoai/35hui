<?php
class PropcenterController extends Controller {
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
        $allProp = Propcenter::model()->findAll();
        $this->render('index',array(
                "allProp"=>$allProp,
        ));
    }
    /**
     * 我的道具
     */
    public function actionMy() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        if(isset($_GET["type"])&&$_GET["type"]=="un") {
            $criteria->addColumnCondition(array("pbl_state"=>0));//所有未使用的
        }
        $criteria->addColumnCondition(array("pbl_consumeuser"=>$userId));
        $criteria->order = "pbl_buytime desc";
        $dataProvider =  new CActiveDataProvider("Propbuylog", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>9,
                        ),

        ));
        //统计所有
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("pbl_consumeuser"=>$userId));
        $countAll = Propbuylog::model()->count($criteria);
        //统计未使用的
        $criteria->addColumnCondition(array("pbl_state"=>0));
        $countUnUse = Propbuylog::model()->count($criteria);
        $this->render("my",array(
                "dataProvider"=>$dataProvider,
                "countAll"=>$countAll,
                "countUnUse"=>$countUnUse
        ));
    }

    /**
     * 送出的道具
     */
    public function actionSend() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("pbl_userid"=>$userId));
        $criteria->addCondition("pbl_consumeuser!=".$userId);
        $criteria->order = "pbl_buytime desc";
        $dataProvider =  new CActiveDataProvider("Propbuylog", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>9,
                        ),

        ));
        $countAll = Propbuylog::model()->count($criteria);
        $this->render("send",array(
                "dataProvider"=>$dataProvider,
                "countAll"=>$countAll
        ));
    }
    /**
     * 使用道具
     */
    public function actionUse() {
        $pblId = $_POST["pblId"];
        $model = Propbuylog::model()->findByPk($pblId);
        $userId = User::model()->getId();
        if($model&&$model->pbl_consumeuser==$userId&&$model->pbl_state==0) {//当前用户才可以使用，并且还是未使用状态
            switch ($model->pbl_propcenterid) {
                default:break;
                case Propcenter::horn :
                    Propcenter::model()->useHorn(Propcenter::horn,$_POST["title"],$_POST["content"]);
                    break;
                case Propcenter::reduceblackboard :
                    Propcenter::model()->useReduceblackboard(Propcenter::reduceblackboard);
                    break;
            }
            $model->pbl_state = 1;
            $model->update();
            echo "success";
            exit;
        }
        echo "传入信息错误";
        exit;
    }
    /**
     * 我能送礼物的人。只有我关注的才行
     */
    public function actionFrameProp() {
        $this->layout = "frame";
        $userId = User::model()->getId();
        $criteria=new CDbCriteria;
        $criteria->select = "u_nickname,u_id";
        $criteria->addColumnCondition(array("at_userid"=>$userId));
        $criteria->join = "right join {{attention}} on {{attention}}.at_attentionuserid = u_id";
        $all = User::model()->findAll($criteria);
        $return = array();
        foreach($all as $value) {
            $return[] =  '"'.$value['u_nickname']."(".$value['u_id'].")\"";
        }
        $attentionUser = implode(",",$return);

        $this->render('frameprop',array(
                "attentionUser"=>$attentionUser,
        ));
    }
    /**
     * 赠送
     */
    public function actionSendProp() {
        $receiveUserIdStr = @$_POST["receiveUserStr"];//接收者
        $sendType = @$_POST["sendType"];//发送类型
        $propId = @$_POST["propId"];//道具id
        if(!$receiveUserIdStr) {
            exit;
        }
        if(!$sendType&&!array_key_exists($sendType,Propbuylog::$pbl_sendtype)) {
            exit;
        }
        if(!$propId&&!array_key_exists($propId,Propcenter::$pc_key)) {
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
        $propCenter = Propcenter::model()->findByPk($propId);
        $price = $propCenter->pc_price;
        $needPrice = count($newReceiveUserIdArr)*$price;
        if(!User::model()->checkCanReduceGold($userId, $needPrice)) {
            echo "需要消耗".$needPrice."个金币，您的余额不足！";
            exit;
        }
        //开始赠送
        $time = time();
        foreach($newReceiveUserIdArr as $value) {
            //扣除金币
            User::model()->reduceGoldNum($userId, $price, "赠送道具");
            //保存信息
            $model = new Propbuylog();
            $model->pbl_userid = $userId;
            $model->pbl_consumeuser = $value;
            $model->pbl_propcenterid = $propId;
            $model->pbl_sendtype = $sendType;
            $model->pbl_state = 0;
            $model->pbl_buytime = $time;
            $model->save();
            //保存成功，添加动态
            Dynamicmy::model()->addDynamicmy(array($value), 4, $model->pbl_propcenterid, $model->pbl_id);
        }
        echo "success";
        exit;
    }
    public function actionBuyProp() {
        $propId = @$_POST["propId"];//道具id
        if(!$propId&&!array_key_exists($propId,Propcenter::$pc_key)) {
            exit;
        }
        $userId = User::model()->getId();
        //验证金币是否足够
        $propCenter = Propcenter::model()->findByPk($propId);
        $price = $propCenter->pc_price;
        if(!User::model()->checkCanReduceGold($userId, $price)) {
            echo "需要消耗".$price."个金币，您的余额不足！";
            exit;
        }
        //购买
        $time = time();
        //扣除金币
        User::model()->reduceGoldNum($userId, $price, "赠送道具");
        $model = new Propbuylog();
        $model->pbl_userid = $userId;
        $model->pbl_consumeuser = $userId;
        $model->pbl_propcenterid = $propId;
        $model->pbl_sendtype = 0;
        $model->pbl_state = 0;
        $model->pbl_buytime = $time;
        $model->save();
        echo "success";
        exit;
    }
}