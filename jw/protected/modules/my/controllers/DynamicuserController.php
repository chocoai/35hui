<?php

class DynamicuserController extends Controller
{
    /**
     * 获取好友动态信息
     */
	public function actionGetInfo()
	{
        $begin = 0;
        if(isset($_POST["currentnum"])&&$_POST["currentnum"]){
            $begin = $_POST["currentnum"];
        }
        $userId = User::model()->getId();
		$searchIdArr = array();
        $searchIdArr[] = $userId;
        //获取所有关注的用户
        $allAttention = Attention::model()->findAllByAttributes(array("at_userid"=>$userId));
        foreach($allAttention as $value){
            $searchIdArr[] = $value->at_attentionuserid;
        }
        $criteria=new CDbCriteria;
        $criteria->addInCondition("du_fromid", $searchIdArr);
        $criteria->order = "du_createtime desc";
        $criteria->limit = 10;
        $criteria->offset = $begin;

        $searchtime = time()-(Config::model()->getValueByKey("dynamic_outtime")*86400);//动态可用时间
        $criteria->addCondition("du_createtime>".$searchtime);
        $allDynamic = Dynamicuser::model()->findAll($criteria);

        if($allDynamic) {
            echo $this->renderPartial("_info",array(
                    "allDynamic"=>$allDynamic,
            ));
        }else {
            echo "zero";
        }
        exit;
	}
}