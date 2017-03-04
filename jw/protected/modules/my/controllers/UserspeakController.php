<?php

class UserspeakController extends Controller
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
                    User::ROLE_MEMBER,
                    User::ROLE_AUDIENCE,
                ),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionIndex(){
        $userId = User::model()->getId();
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("us_userid"=>$userId));
        $criteria->order = "us_creattime desc";
        $dataProvider =  new CActiveDataProvider("Userspeak", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
                "dataProvider"=>$dataProvider,
        ));
    }
    public function actionCreate(){
        $userId = User::model()->getId();
        $content = trim($_POST["speak"]);
        $userSpeak = new Userspeak;
        $userSpeak->us_userid = $userId;
        $userSpeak->us_content = $content;
        $userSpeak->us_creattime = time();
        if($userSpeak->save()){
            //添加说说动态
            $dynamicContent  = Dynamicuser::model()->formartContentType_1($content,$userSpeak->us_id);
            Dynamicuser::model()->addDynamic("1", $dynamicContent);
            echo "success";exit;
        }
        echo "error";exit;
    }
}