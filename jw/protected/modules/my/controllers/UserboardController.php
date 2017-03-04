<?php

class UserboardController extends Controller
{
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function accessRules()
	{
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
    public function actionIndex(){
        $userId = User::model()->getId();
        $search = $_GET;
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("ub_userid"=>$userId));
        if(isset($search["nickname"])&&$search["nickname"]){
            $nameSearch = array();
            $userCriteria = new CDbCriteria();
            $userCriteria->select = "u_id";
            $userCriteria->addSearchCondition("u_nickname", $search["nickname"]);
            $userModelInfo = User::model()->findAll($userCriteria);
            if($userModelInfo){
                foreach($userModelInfo as $value){
                    $nameSearch[] = $value->u_id;
                }
            }
            $criteria->addInCondition("ub_userid", $nameSearch);
        }
        $criteria->order = "ub_createtime desc";
        $dataProvider =  new CActiveDataProvider("Userboard", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
                "dataProvider"=>$dataProvider,
                "search"=>$search,
                "baseurl"=>DOMAIN."/my/userboard/index",
        ));
    }
}