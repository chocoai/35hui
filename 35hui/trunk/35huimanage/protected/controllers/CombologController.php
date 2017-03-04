<?php

class CombologController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    public  $defaultAction='showall';
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
//	public function actionIndex()
//	{
//		$dataProvider=new CActiveDataProvider('Combolog');
//		$this->render('index',array(
//			'dataProvider'=>$dataProvider,
//		));
//	}
    /*
     * 显示所有用户套餐信息
     */
    public function actionShowAll()
	{
        $criteria=new CDbCriteria;
        $order=isset($_GET['order'])?$_GET['order']:"";
        $criteria->order='cbl_endtime '.$order;
        if(isset($_GET["cbl_uid"])&&$_GET["cbl_uid"]){
            $criteria->compare('cbl_uid',$_GET["cbl_uid"]);
        }
        if(isset($_GET["cbl_content"])&&$_GET["cbl_content"]){
            $criteria->compare('cbl_content',Combo::model()->findByPk($_GET["cbl_content"])->cb_name);
        }
        if(isset($_GET["cbl_muid"])&&$_GET["cbl_muid"]){
            $criteria->compare('cbl_muid',$_GET["cbl_muid"]);
        }
        if(isset($_GET["grade"])&&$_GET["grade"]){
            $criteria2=new CDbCriteria;
            $criteria1->select="user_id";
            $user=User::model()->findAllByAttributes(array('user_grade'=>$_GET["grade"]),$criteria2);
            if($user){
                foreach ($user as $val){
                   $criteria->addCondition('cbl_uid='.$val['user_id'],'or');
                }
            }else{
                    $criteria->compare('cbl_uid',"null");
            }
        }
        if(isset($_GET["user_name"])&&$_GET["user_name"]){
            $criteria1=new CDbCriteria;
            $criteria1->select="ua_uid";
            $user=Uagent::model()->findAllByAttributes(array('ua_realname'=>$_GET["user_name"]),$criteria1);
            if($user){
                foreach ($user as $val){
                   $criteria->addCondition('cbl_uid='.$val['ua_uid'],'or');
                }
            }else{
                    $criteria->compare('cbl_uid',"null");
            }
        }
        $criteria->group='cbl_uid';
        $allMangeuser=Manageuser::model()->findAllByAttributes(array("mag_role"=>"2"));
        $mangeuser=array();
        foreach($allMangeuser as $value){
            $mangeuser[$value->mag_userid] = $value->mag_realname;
        }
        $allcombo=Combo::model()->findAll();
        $combo=array();
        foreach($allcombo as $value){
            $combo[$value->cb_id] = $value->cb_name;
        }
        $dataProvider=new CActiveDataProvider('Combolog', array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                ),
          ));
		$this->render('show',array(
			'dataProvider'=>$dataProvider,
            'url'=>'combolog/showall',
            'mangeuser'=>$mangeuser,
            "combo"=>$combo
		));
	}
    /*
     * 显示使用中的用户套餐信息
     */
    public function actionShowUsed()
	{
        $time=time();
		$criteria=new CDbCriteria;
        $order=isset($_GET['order'])?$_GET['order']:"";
        $criteria->order='cbl_endtime '.$order;
        if(isset($_GET["cbl_uid"])&&$_GET["cbl_uid"]){
            $criteria->compare('cbl_uid',$_GET["cbl_uid"]);
        }
        if(isset($_GET["cbl_content"])&&$_GET["cbl_content"]){
            $criteria->compare('cbl_content',$_GET["cbl_content"]);
        }
        if(isset($_GET["cbl_muid"])&&$_GET["cbl_muid"]){
            $criteria->compare('cbl_muid',$_GET["cbl_muid"]);
        }
        if(isset($_GET["grade"])&&$_GET["grade"]){
            $criteria2=new CDbCriteria;
            $criteria1->select="user_id";
            $user=User::model()->findAllByAttributes(array('user_grade'=>$_GET["grade"]),$criteria2);
            if($user){
                foreach ($user as $val){
                   $criteria->addCondition('cbl_uid='.$val['user_id'],'or');
                }
            }else{
                    $criteria->compare('cbl_uid',"null");
            }
        }
        if(isset($_GET["user_name"])&&$_GET["user_name"]){
            $criteria1=new CDbCriteria;
            $criteria1->select="ua_uid";
            $user=Uagent::model()->findAllByAttributes(array('ua_realname'=>$_GET["user_name"]),$criteria1);
            if($user){
                foreach ($user as $val){
                   $criteria->addCondition('cbl_uid='.$val['ua_uid'],'or');
                }
            }else{
                    $criteria->compare('cbl_uid',"null");
            }
        }
        $criteria->group='cbl_uid';
        $criteria->compare('cbl_endtime>',$time);
        $allMangeuser=Manageuser::model()->findAllByAttributes(array("mag_role"=>"2"));
        $mangeuser=array();
        foreach($allMangeuser as $value){
            $mangeuser[$value->mag_userid] = $value->mag_realname;
        }
        $allcombo=Combo::model()->findAll();
        $combo=array();
        foreach($allcombo as $value){
            $combo[$value->cb_id] = $value->cb_name;
        }
        $dataProvider=new CActiveDataProvider('Combolog', array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                ),
          ));
		$this->render('show',array(
			'dataProvider'=>$dataProvider,
            'url'=>'combolog/showused',
            'mangeuser'=>$mangeuser,
            "combo"=>$combo
		));
	}
    /*
     * 显示用户套餐信息
     */
    public function actionshowUser()
	{
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }else{
            exit;
        }
        $dataProvider=new CActiveDataProvider('Combolog', array(
                'criteria'=>array(
                    'condition'=>'cbl_uid='.$id,
                    "order"=>'cbl_endtime desc',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
          ));
		$this->render('showuser',array(
			'dataProvider'=>$dataProvider,
            'url'=>'combolog/showuser',
            'id'=>$id,
		));
	}
    /**
     * 显示过期的用户套餐信息
     */
    public function actionShowOverdue()
	{
        $time=time();
		$criteria=new CDbCriteria;
        $order=isset($_GET['order'])?$_GET['order']:"";
        $criteria->order='cbl_endtime '.$order;
        if(isset($_GET["cbl_uid"])&&$_GET["cbl_uid"]){
            $criteria->compare('cbl_uid',$_GET["cbl_uid"]);
        }
        if(isset($_GET["cbl_content"])&&$_GET["cbl_content"]){
            $criteria->compare('cbl_content',$_GET["cbl_content"]);
        }
        
        if(isset($_GET["cbl_muid"])&&$_GET["cbl_muid"]){
            $criteria->compare('cbl_muid',$_GET["cbl_muid"]);
        }
        if(isset($_GET["grade"])&&$_GET["grade"]){
            $criteria2=new CDbCriteria;
            $criteria1->select="user_id";
            $user=User::model()->findAllByAttributes(array('user_grade'=>$_GET["grade"]),$criteria2);
            if($user){
                foreach ($user as $val){
                   $criteria->addCondition('cbl_uid='.$val['user_id'],'or');
                }
            }else{
                    $criteria->compare('cbl_uid',"null");
            }
        }
        if(isset($_GET["user_name"])&&$_GET["user_name"]){
            $criteria1=new CDbCriteria;
            $criteria1->select="ua_uid";
            $user=Uagent::model()->findAllByAttributes(array('ua_realname'=>$_GET["user_name"]),$criteria1);
            if($user){
                foreach ($user as $val){
                   $criteria->addCondition('cbl_uid='.$val['ua_uid'],'or');
                }
            }else{
                    $criteria->compare('cbl_uid',"null");
            }
        }
        $criteria->group='cbl_uid';
        $criteria->compare('cbl_endtime<',$time);
        $allMangeuser=Manageuser::model()->findAllByAttributes(array("mag_role"=>"2"));
        $mangeuser=array();
        foreach($allMangeuser as $value){
            $mangeuser[$value->mag_userid] = $value->mag_realname;
        }
        $allcombo=Combo::model()->findAll();
        $combo=array();
        foreach($allcombo as $value){
            $combo[$value->cb_id] = $value->cb_name;
        }
        $dataProvider=new CActiveDataProvider('Combolog', array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>10,
                ),
          ));
        
		$this->render('show',array(
			'dataProvider'=>$dataProvider,
            'url'=>'combolog/showoverdue',
            'mangeuser'=>$mangeuser,
            "combo"=>$combo
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Combolog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Combolog'])){
			$model->attributes=$_GET['Combolog'];
            }
           
		$this->render('admin',array(
			'model'=>$model,
		));
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
				$this->_model=Combolog::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='combolog-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    //通过ID更新套餐客服ID
    public function actionUpdateMuid()
	{
        if(isset($_POST['id'])&&$_POST['id']){
            $model = Combolog::model()->findByAttributes(array("cbl_id"=>$_POST['id']));
            $user=Uagent::model()->findByAttributes(array("ua_uid"=>$model->cbl_uid));
            if(isset($_POST['muid']))
            {
                $user->ua_muid=$_POST['muid'];
                $model->cbl_muid=$_POST['muid'];
                if($model->save()&&$user->update()){
                    echo "修改成功";
                }
            }
        }
	}
}
