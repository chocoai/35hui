<?php

class GoldhomeController extends Controller {
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
        $userId = User::model()->getId();
        $allGoldHomeGroup = Goldhomegroup::model()->getAllGroupsById(User::model()->getId());
        $criteria=new CDbCriteria;
        $filter = "";
        if(isset($_GET["f"])) {
            $f = trim($_GET["f"]);
            if($f=="no") {
                $criteria->addCondition("gh_group=0");
                $filter = $f;
            }
            $filterArr = array();
            foreach($allGoldHomeGroup as $value) {
                $filterArr[$value->ghg_id] = "";
            }
            if(array_key_exists($f,$filterArr)) {//如果是自己的类型
                $criteria->addCondition("gh_group=".$f);
                $filter = $f;
            }
        }
        $criteria->addColumnCondition(array("gh_userid"=>$userId));
        $criteria->order = "gh_createtime desc";
        $dataProvider =  new CActiveDataProvider("Goldhome", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));

        $this->render("index",array(
                "dataProvider"=>$dataProvider,
                "allGoldHomeGroup"=>$allGoldHomeGroup,
                "filter"=>$filter
        ));
    }
    public function actionGoldHomeMe() {
        $userId = User::model()->getId();
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("gh_golehomeuserid"=>$userId));
        $criteria->order = "gh_createtime desc";
        $dataProvider =  new CActiveDataProvider("Goldhome", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("goldhomeme",array(
                "dataProvider"=>$dataProvider,
        ));
    }
    public function actionChangeGoldGroup() {
        $groupId = @$_POST["group"];
        $ghId = @$_POST["goldhome"];
        $userId = User::model()->getId();
        $model = Goldhome::model()->find("gh_id = ".$ghId." and gh_userid=".$userId);
        if(!$model) {
            exit;
        }
        $groupModel = Goldhomegroup::model()->find("ghg_id = ".$groupId." and ghg_userid=".$userId);
        if(!$groupModel) {
            exit;
        }
        $model->gh_group = $groupId;
        $model->update();
        exit;
    }
    public function actionDelGoldHome() {
        $ghId = $_POST["ghid"];
        $userId = User::model()->getId();
        $model = Goldhome::model()->find("gh_id = ".$ghId." and gh_userid=".$userId);
        if($model) {
            $model->delete();
        }
        exit;
    }
    public function actionAddNote() {
        $ghId = $_POST["ghid"];
        $note = $_POST["note"];
        $userId = User::model()->getId();
        $model = Goldhome::model()->find("gh_id = ".$ghId." and gh_userid=".$userId);
        if($model) {
            $model->gh_note = $note;
            if($model->validate()) {
                $model->update();
                echo "success";
                exit;
            }
        }
        echo "error";
        exit;
    }
}