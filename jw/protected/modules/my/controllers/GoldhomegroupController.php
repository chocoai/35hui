<?php

class GoldhomegroupController extends Controller {
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules() {
        return array(
            array('allow',
                    'roles'=>array(
                            User::ROLE_MEMBER,
                            User::ROLE_AUDIENCE
                    ),
            ),
        );
    }
    /**
     * 创建分组
     */
    public function actionCreate() {
        if($_POST){
            $maxGroupNum = Config::model()->getValueByKey("golehome_type_num");
            $userId = User::model()->getId();
            if(!Goldhomegroup::model()->checkCanCreate($userId, $maxGroupNum)){
                echo json_encode(array("error","您已经创建了$maxGroupNum"."个分组，已经达到最大值"));exit;
            }
            $model = new Goldhomegroup();
            $model->ghg_userid = $userId;
            $model->ghg_groupname = $_POST["name"];
            $model->ghg_createtime = time();
            if($model->save()){
                echo json_encode(array("success",$model->ghg_id));exit;
            }
            echo json_encode(array("error","输入内容不符规格"));
        }
    }
    /**
     * 删除分组
     */
    public function actionDel(){
        $id = $_POST["id"];
        $userId = User::model()->getId();
        $model = Goldhomegroup::model()->findByPk($id);
        if($model&&$model->ghg_userid==$userId){
            Goldhome::model()->updateAll(array("gh_group"=>0),"gh_group=".$model->ghg_id);
            $model->delete();
        }
        exit;
    }
    public function actionEdit(){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $userId = User::model()->getId();
        $model = Goldhomegroup::model()->findByPk($id);
        if($model&&$model->ghg_userid==$userId){
            $model->ghg_groupname = $name;
            if($model->validate()){
                $model->update();
                echo "success";exit;
            }
        }
        echo "error";exit ;
    }
}