<?php

class DynamicmyController extends Controller {
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
                                User::ROLE_AUDIENCE,
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex() {
        $this->render('index');
    }
    public function actionGetInfo() {
        $begin = 0;
        if(isset($_POST["currentnum"])&&$_POST["currentnum"]) {
            $begin = $_POST["currentnum"];
        }
        $userId = User::model()->getId();

        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("dm_userid"=>$userId));
        $criteria->order = "dm_createtime desc";
        $criteria->limit = 10;
        $criteria->offset = $begin;

        $searchtime = time()-(Config::model()->getValueByKey("dynamic_outtime")*86400);//动态可用时间
        $criteria->addCondition("dm_createtime>".$searchtime);
        $allDynamic = Dynamicmy::model()->findAll($criteria);
        if($allDynamic) {
            $this->renderPartial("_info",array(
                    "allDynamic"=>$allDynamic,
            ));
        }else {
            echo "zero";
        }
        exit;
    }
}