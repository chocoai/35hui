<?php

class TwittersuggestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
        $va = va();
        $va->check(array(
            'buildingId'=>array('not_blank','uint'),
            'type'=>array('not_blank','uint')
        ));
        if($va->success){
            $model = array();
            $twitter = Twitter::model()->getTwitterByBuildingId($va->valid['buildingId'],$va->valid['type']);
            if($va->valid['type']==1){
                $model = Systembuildinginfo::model()->findByPk($twitter->t_sourceid);
            }else{
                $model = Communitybaseinfo::model()->findByPk($twitter->t_sourceid);
            }
            $this->render('view',array(
                'twitter'=>$twitter,
                'model'=>$model,
                'type'=>$va->valid['type'],
            ));
        }else if ($type == 1){
            $this->redirect(array('twittersuggest/buildIndex'));
        } else {
             $this->redirect(array('twittersuggest/communityIndex'));
        }
	}
    public function actionBindTwitter(){
        $model = $this->loadModel();
        $type = $model->ts_type;
        $t_sourcetype = '';
        if($type==1){
            $t_sourcetype = Twitter::building;
        }else{
            $t_sourcetype = Twitter::community;
        }
        $twitter = new Twitter;
        $dba = dba();
        $twitter->t_id = $dba->id('35_twitter');
        $twitter->t_sourceid = $model->ts_buildingid;
        $twitter->t_sourcetype = $t_sourcetype;
        $twitter->t_userid = $model->ts_userid;
        $twitter->t_message = $model->ts_content;
        $twitter->t_recordtime = time();
        $twitter->t_type = $type;
        if($twitter->save()){//录用播报成功
            $buildingName = '';
            if($type == 1){
                $buildingName = Systembuildinginfo::model()->getBuildingName($model->ts_buildingid);
            }else{
                $buildingName = Communitybaseinfo::model()->getComyName($model->ts_buildingid);
            }
            //送4积分和4商务币
            $description = "楼盘 ".$buildingName."采用了您播报的微博,奖励{:money}商务币";
            Userproperty::model()->addMoney($model->ts_userid,Oprationconfig::model()->getConfigByName('bindTwitter','0'), $description);

            $description = "楼盘 ".$buildingName."采用了您播报的微博,奖励{:point}积分";
            Userproperty::model()->addPoint($model->ts_userid,Oprationconfig::model()->getConfigByName('bindTwitter','1'), $description);

            $MsgsubscribeType = $type==1?$type:3;
            $Msgsubscribe=Msgsubscribe::model()->findAllByAttributes(array("ms_typeid"=>$model->ts_buildingid,"ms_type"=>$MsgsubscribeType));
            //邮件发送
            if($Msgsubscribe){
                $emailTitle = $MsgsubscribeType==1?'您订阅的楼盘'.$buildingName.'新动向':'您订阅的小区'.$buildingName.'新动向';
                foreach($Msgsubscribe as $key=>$value){
                    common::sendMail($value->ms_email, $emailTitle, $model->ts_content);
                }
            }
            //删除旧记录
            Twittersuggest::model()->deleteSuggestByBuildingId($model->ts_buildingid,$type);
            //返回结果
            Yii::app()->user->setFlash('bindMessage','录用微博成功');
            $this->redirect(array('twittersuggest/view','buildingId'=>$model->ts_buildingid,'type'=>$type));
        }else{
            Yii::app()->user->setFlash('bindMessage','录用微博失败!');
            $this->redirect(array('twittersuggest/suggestIndex','buildingId'=>$_GET['id'],'type'=>$type));
        }
    }
    public function actionSuggestIndex(){
        $va = va();
        $va->check(array(
            'buildingId'=>array('not_blank','uint'),
            'type'=>array('not_blank','uint')
        ));
        $buildingId = $va->valid['buildingId'];
        $type = $va->valid['type'];
        if($va->success){
            $model = array();
            if($type == 1){
                $model = Systembuildinginfo::model()->findByPk($buildingId);
            }else{
                $model = Communitybaseinfo::model()->findByPk($buildingId);
            }
            $criteria=new CDbCriteria(array(
                'condition'=>'ts_buildingid=:buildingId',
                'params'=>array(":buildingId"=>$buildingId)
            ));
            $criteria->addCondition("ts_type =".$type);
            $dataProvider=new CActiveDataProvider('Twittersuggest',array(
                'criteria'=>$criteria,
                'pagination'=>array(
                        'pageSize'=>20,
                    ),
                ));
            $this->render('suggestIndex',array(
                'model'=>$model,
                'dataProvider'=>$dataProvider,
                'type'=>$type,
            ));
        }else if ($type == 1){
            $this->redirect(array('twittersuggest/buildIndex'));
        } else {
             $this->redirect(array('twittersuggest/communityIndex'));
        }
    }
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionDiyCreate()
	{
        $va = va();
        $va->check(array(
            'buildingId'=>array('not_blank','uint'),
            'type'=>array('not_blank','uint')
        ));
        $type = $va->valid['type'];
        $buildingId = $va->valid['buildingId'];
        if($va->success){
            $pmodel = array();
            if($type==1){
                $pmodel = Systembuildinginfo::model()->findByPk($buildingId);
            }else{
                $pmodel = Communitybaseinfo::model()->findByPk($buildingId);
            }
            $model=new Twitter;
            if(isset($_POST['Twitter']))
            {
                $t_sourceid = "";
                $t_sourcetype = "";
                if($type==1){
                    $t_sourceid = $pmodel->sbi_buildingid;
                    $t_sourcetype = Twitter::building;
                }else{
                    $t_sourceid = $pmodel->comy_id;
                    $t_sourcetype = Twitter::community;
                }
                $dba = dba();
                $model->attributes=$_POST['Twitter'];
                $model->t_id = $dba->id('35_twitter');
                $model->t_sourceid = $t_sourceid;
                $model->t_sourcetype = $t_sourcetype;
                $model->t_userid = 0;//0代表是系统客服录入的
                $model->t_recordtime = time();
                $model->t_type = $type;
                if($model->save()){
                    $MsgsubscribeType = $type==1?$type:3;
                    $Msgsubscribe=Msgsubscribe::model()->findAllByAttributes(array("ms_typeid"=>$t_sourceid,"ms_type"=>$MsgsubscribeType));
                    if($Msgsubscribe){
                        $emailTitle = $type==1?'您订阅的楼盘'.$pmodel->sbi_buildingname.'新动向':'您订阅的小区'.$pmodel->comy_name.'新动向';
                        $emailMessage = $_POST['Twitter']['t_message'];
                        foreach($Msgsubscribe as $key=>$value){
                            common::sendMail($value->ms_email, $emailTitle, $emailMessage);
                        }
                    }
                    Yii::app()->user->setFlash('bindMessage','自行发布微博成功');
                    $this->redirect(array('twittersuggest/view','buildingId'=>$t_sourceid,'type'=>$type));
                }else{
                    Yii::app()->user->setFlash('bindMessage','自行发布微博失败!');
                    $this->redirect(array('twittersuggest/suggestIndex','buildingId'=>$t_sourceid,'type'=>$type));
                }
            }
            $this->render('diyCreate',array(
                'pmodel'=>$pmodel,
                'model'=>$model,
                'type'=>$type,
            ));
        }else if($type==1){
            $this->redirect(array('twittersuggest/buildIndex'));
        }else{
            $this->redirect(array('twittersuggest/communityIndex'));
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Twittersuggest']))
		{
			$model->attributes=$_POST['Twittersuggest'];
			if($model->save())
				$this->redirect(array('admin','id'=>$model->ts_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(isset($_GET['id']))
		{
			// we only allow deletion via POST request
			$model=$this->loadModel();
            $type=$model->ts_type;
            $model->delete();

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
    public function actionBuildIndex(){
      self::index(1);
    }
    public function actionCommunityIndex(){
        self::index(2);
    }
	private function index($type)
	{
        $dataProvider=array();
        if($type==1){
            $criteria=new CDbCriteria(array(
                'condition'=>"ts_type =1",
                'join'=>'RIGHT JOIN 35_twittersuggest ON 35_twittersuggest.ts_buildingid=sbi_buildingid',
                'group'=>'35_twittersuggest.ts_buildingid'
            ));
            $dataProvider=new CActiveDataProvider('Systembuildinginfo',array('criteria'=>$criteria));
        }else{
            $criteria=new CDbCriteria(array(
                'condition'=>"ts_type =2",
                'join'=>'RIGHT JOIN 35_twittersuggest ON 35_twittersuggest.ts_buildingid=comy_id',
                'group'=>'35_twittersuggest.ts_buildingid'
            ));
            $dataProvider=new CActiveDataProvider('Communitybaseinfo',array('criteria'=>$criteria));
        }
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'type'=>$type,
		));
	}

    public function actionTwitterIndexBuild(){
      self::twitterIndex(1);
    }
    public function actionTwitterIndexCommunity(){
        self::twitterIndex(2);
    }
	private function twitterIndex($type)
	{
        if($type == 1){
             $criteria=new CDbCriteria(array(
               'condition'=>isset($_GET['Systembuildinginfo']['sbi_buildingname']) && $_GET['Systembuildinginfo']['sbi_buildingname']?'sbi_buildingname like "%'.$_GET['Systembuildinginfo']['sbi_buildingname'].'%"':''
            ));
            $dataProvider=new CActiveDataProvider('Systembuildinginfo',array('criteria'=>$criteria));
            $model=new Systembuildinginfo('search');
        }else{
            $criteria=new CDbCriteria(array(
               'condition'=>isset($_GET['Communitybaseinfo']['comy_name']) && $_GET['Communitybaseinfo']['comy_name']?'comy_name like "%'.$_GET['Communitybaseinfo']['comy_name'].'%"':''
            ));
            $dataProvider=new CActiveDataProvider('Communitybaseinfo',array('criteria'=>$criteria));
            $model=new Communitybaseinfo('search');
        }
		$this->render('twitterIndex',array(
			'dataProvider'=>$dataProvider,
            'model' => $model,
            'type' => $type
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Twittersuggest('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Twittersuggest']))
			$model->attributes=$_GET['Twittersuggest'];
        
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
				$this->_model=Twittersuggest::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='twittersuggest-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
