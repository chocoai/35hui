<?php

class OfficecommentController extends Controller
{
	const PAGE_SIZE=10;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('addComment'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Officecomment::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	
	/*
     * 添加评论
	 * 这里以后要有个配置参数,表示匿名 用户是否能发表评论,现在假定用户都已经登陆
	 */
	public function actionAddComment()
	{
		if (!Yii::app()->request->isAjaxRequest && !Yii::app()->request->isPostRequest) {
			echo -1;
			exit;
		}
		if (Yii::app()->user->isGuest) {
			echo 0;
			exit;
		}
		
		$comment = new Officecomment;

        $post = $_POST;
        $post['oc_comdate'] = time();
		$comment->attributes = $post;
		//当该评论为第一条评论时，用户积分加5分，否则加2分
		$ismark = self::makeMark($comment->oc_officeid);
		if ($ismark) {
			$result = $comment->save();
            if(Yii::app()->request->isAjaxRequest){
                //如果是ajax，则返回添加信息
                $post['oc_comdate'] = date('Y-m-d H:i:s',$comment->oc_comdate);
                echo json_encode($post);
            }
		}
	}

       /**
         * 点评后增加分数，第一点评加5分，其他加2分
         * @param $officeId 点评商务中心的ID
         * @return boolean
         */
        private static function makeMark($officeId)
        {
            $userId = Yii::app()->user->id;
            $criteria = new CDbCriteria();
            $criteria->condition = "oc_officeid = '" . $officeId . "'";               
            $isfirst = Officecomment::model()->findAll($criteria);
            
            $user = User::model()->with('property')->findByPk($userId);
            if ($user->save()) {
                return true;
            } else {
                return false;
            }
        }
	

}
