<?php

class ShareController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    public $towards=array('1'=>'东','2'=>'南','3'=>'西','4'=>'北');

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
			array('allow',  // allow all users
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    /**
     * A fuck function
     */
    public function init(){
        parent::init();
        switch(User::model()->getCurrentRole()) {
            case User::personal :
                $this->layout='personal';
                break;
            case User::company :
                $this->layout='ucom';
                break;
            case User::agent :
                $this->layout='uagent';
                break;
            default:
                $this->redirect('/site/error');
                break;
        }
    }
    public function actionRelease(){
        if(!Yii::app()->request->isPostRequest || !in_array($_POST['tag'],array('gc','gp')) ) $this->redirect('/site/error');
        $_POST=array_map('trim', $_POST);
        $tag=$_POST['tag'];
        $rentsell=$_POST['rentsell'];
        $contack=$_POST['contack'];
        $sourceType=$_POST['sourceType'];
        $buidname=$_POST['buildname'];//buildname
        $region=(int)$_POST['region'];

        if($tag=='gp'){
            
            $area=(int)$_POST['area1'].'';
            if(!empty($_POST['area2'])) $area.='-'.(int)$_POST['area2'];
            $price=$_POST['price1'].'';
            if(!empty($_POST['price2'])) $price.='-'.$_POST['price2'];

            $model=new Getplace();
            $model->gp_type=$sourceType;
            $model->gp_rentsell=$rentsell;
            $model->gp_regionid=$region;
            $model->gp_buildings=$buidname;
            $model->gp_area=$area;
            $model->gp_budget=$price;
            $model->gp_userid=Yii::app()->user->id;
            $model->gp_contact=$contack;
            $model->gp_timestamp=time();
            
        }else{
            $floor=(int)$_POST['floor'];
            $area=(int)$_POST['area'];
            $price=$_POST['price'];
            $toward=(int)$_POST['toward'];

            $model=new Getcustomer();
            $model->gc_type=$sourceType;
            $model->gc_rentsell=$rentsell;
            $model->gc_regionid=$region;
            $model->gc_buildname=$buidname;
            $model->gc_floor=$floor;
            $model->gc_area=$area;
            $model->gc_toward=$toward;
            $model->gc_price=$price;
            $model->gc_userid=Yii::app()->user->id;
            $model->gc_contact=$contack;
            $model->gc_timestamp=time();
        }
        if($model->save()){
            Yii::app()->user->setFlash('contact','信息发布成功');
        }else{
            Yii::app()->user->setFlash('contact','信息发布失败');
        }
        $this->redirect(array('index','tag'=>$tag,'sourceType'=>$sourceType));
    }

    /**
     * This action for Getcustomer and Getplace model
     */
    public function actionIndex(){
        $request=array_merge($_GET,$_POST);
        $sourceType=(!empty($request['sourceType']) && in_array($request['sourceType'],array('1','2','3')) )?$request['sourceType']:'1';//1写字楼,2商铺,3住宅
        $tag=(!empty($request['tag']) && in_array($request['tag'],array('gp','gc')) )?$request['tag']:'gp';// gp)求房源|gc)求客户
        $region=isset($request['region'])?(int)$request['region']:0;
        $rentsell=(!empty($request['rentsell']) && in_array($request['rentsell'],array('1','2')) )?$request['rentsell']:'';
        $kwd=empty($request['kwd'])?'':$request['kwd'];
        $self=empty($request['self'])?'':$request['self'];
        unset($request);

        foreach(array('sourceType','tag','region','rentsell','kwd','self') as $key){
            if(!empty($$key))
                $_GET[$key]=$$key;
            elseif(isset($_GET[$key]))
                unset($_GET[$key]);
        }
        unset($key);
        $districts=array();
        foreach ( Region::model()->findAll(array(
            'select'=>'re_id,re_name','condition'=>'re_parent_id=35','order'=>'re_order'
            )) as $district ) {
            $districts[$district->re_id]=$district->re_name;
        }

        $criteria=new CDbCriteria();
        if($tag=='gp'){
            $criteria->order='gp_id DESC';
            if($self)
                $criteria->addColumnCondition(array('gp_userid'=>Yii::app()->user->id));
            if($sourceType)
                $criteria->addColumnCondition(array('gp_type'=>$sourceType));
            if($rentsell)
                $criteria->addColumnCondition(array('gp_rentsell'=>$rentsell));
            if($region)
                $criteria->addColumnCondition(array('gp_regionid'=>$region));
            if($kwd)
                $criteria->addSearchCondition('gp_buildings',$kwd);
        }else{
            $criteria->order='gc_id DESC';
            if($self)
                $criteria->addColumnCondition(array('gc_userid'=>Yii::app()->user->id));
            if($sourceType)
                $criteria->addColumnCondition(array('gc_type'=>$sourceType));
            if($rentsell)
                $criteria->addColumnCondition(array('gc_rentsell'=>$rentsell));
            if($region)
                $criteria->addColumnCondition(array('gc_regionid'=>$region));
            if($kwd)
                $criteria->addSearchCondition('gc_buildname',$kwd);
        }
        //print_r($criteria);
        $dataProvider=new CActiveDataProvider($tag=='gp'?'Getplace':'Getcustomer', array(
			'pagination'=>array(
				'pageSize'=>10,
			),
			'criteria'=>$criteria,
		));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'districts'=>$districts,
            'sourceType'=>$sourceType,
            'tag'=>$tag,
            'region'=>$region,
            'rentsell'=>$rentsell,
            'kwd'=>$kwd,
            'self'=>$self
        ));
    }

    public function actionDelete(){
        $id=isset($_GET['id'])?(int)$_GET['id']:0;
        $tag=isset($_GET['tag'])?$_GET['tag']:'gp';
        if($tag=='gp'){
            $model=Getplace::model()->findByPk($id);
        }else{
            $tag='gc';
            $model=Getcustomer::model()->findByPk($id);
        }
        if($model && 
                $model->{$tag.'_userid'}==Yii::app()->user->id &&
                $model->delete())
        {
            Yii::app()->user->setFlash('contact','信息已成功删除');
                
        }else{
            Yii::app()->user->setFlash('contact','操作失败！');
        }
        $sourceType=(!empty($_GET['sourceType']) && in_array($_GET['sourceType'],array('1','2','3')) )?$_GET['sourceType']:'1';
        $this->redirect(array('share/index','tag'=>$tag,'sourceType'=>$sourceType,'self'=>'on'));
    }

}
