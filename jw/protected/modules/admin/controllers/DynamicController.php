<?php
class DynamicController extends Controller
{
    public $layout = "manage";
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $searchtime = time()-(Config::model()->getValueByKey("dynamic_outtime")*86400);//动态可用时间
        $criteria->addCondition("dm_createtime<".$searchtime);
        $my = Dynamicmy::model()->count($criteria);

        $criteria=new CDbCriteria;
        $searchtime = time()-(Config::model()->getValueByKey("dynamic_outtime")*86400);//动态可用时间
        $criteria->addCondition("du_createtime<".$searchtime);
        $friend = Dynamicuser::model()->count($criteria);
        
        $this->render("index",array(
            "my"=>$my,
            "friend"=>$friend,
        ));
    }
    public function actionDel(){
        $criteria = new CDbCriteria;
        $searchtime = time()-(Config::model()->getValueByKey("dynamic_outtime")*86400);//动态可用时间
        $criteria->addCondition("dm_createtime<".$searchtime);
        Dynamicmy::model()->deleteAll($criteria);

        $criteria=new CDbCriteria;
        $searchtime = time()-(Config::model()->getValueByKey("dynamic_outtime")*86400);//动态可用时间
        $criteria->addCondition("du_createtime<".$searchtime);
        Dynamicuser::model()->deleteAll($criteria);

        Accountrecharge::model()->delOutTimeUnPayInfo();
    }
}