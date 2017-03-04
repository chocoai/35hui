<?php

class AttentionController extends Controller {
    public function filters() {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }
    public function accessRules() {
        return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'roles'=>array(
                                User::ROLE_MEMBER
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex() {
        $type = User::ROLE_AUDIENCE;
        isset($_GET["type"])&&$_GET["type"]==User::ROLE_MEMBER?$type=User::ROLE_MEMBER:"";//会员类型

        $userId = User::model()->getId();
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("at_userid"=>$userId));
        $criteria->addColumnCondition(array("u_role"=>$type));
        $criteria->join = "left join {{user}} on at_userid=u_id";
        $criteria->order = "at_createtime desc";
        $dataProvider =  new CActiveDataProvider("Attention", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $count = Attention::model()->count("at_userid=".$userId);
        $this->render("index",array(
                "dataProvider"=>$dataProvider,
                "type"=>$type,
                "count"=>$count
        ));
    }
    public function actionAttentionMe() {
        $type = User::ROLE_AUDIENCE;
        isset($_GET["type"])&&$_GET["type"]==User::ROLE_MEMBER?$type=User::ROLE_MEMBER:"";//会员类型

        $userId = User::model()->getId();
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("at_attentionuserid"=>$userId));
        $criteria->addColumnCondition(array("u_role"=>$type));
        $criteria->join = "left join {{user}} on at_userid=u_id";
        $criteria->order = "at_createtime desc";
        $dataProvider =  new CActiveDataProvider("Attention", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $count = Attention::model()->count("at_attentionuserid=".$userId);
        $this->render("attentionme",array(
                "dataProvider"=>$dataProvider,
                "type"=>$type,
                "count"=>$count
        ));
    }
}