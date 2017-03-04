<?php
Yii::import('application.common.*');
require_once('image.php');
class PictureController extends Controller
{

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

    /**
     *此控制器中用到的资源类型，分写字楼资源和商铺资源
     * @var <type> 
     */
    private $sourceType = array(
        "1"=>"office",//写字楼
        '2'=>"shop",//商铺
        '3'=>'residence',//住宅
        '4'=>'cypark',//创意园区
    );
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
				'actions'=>array('gridshow','photolist','settitle','upload'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('delphoto','uploadphoto','photomanage','updatetitle','showBasePic'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    //图片管理
    public function actionPhotoManage(){
        $userId = Yii::app()->user->id;
        $sourceId = $_GET['id'];
        //设置资源类型。写字楼和商铺共用同一个controller
        $sourceType = "office";
        if(isset($_GET['sourcetype'])&&in_array($_GET['sourcetype'], $this->sourceType)){
            $sourceType = $_GET['sourcetype'];
        }else{
            $this->redirect(array('main/error'));//错误的类型跳出
        }

        if($sourceType=="office"){
            //判断此房源是否是当前用户所有。
            $source = Officebaseinfo::model()->findByAttributes(array("ob_officeid"=>$sourceId,"ob_uid"=>$userId));
            if($source){
                $headPic = $source->ob_titlepicurl;
                $photolist = Picture::model()->getAllPictures($sourceId,Picture::$sourceType['officebaseinfo'],3);
                $this->render('photomanage',array(
                    'photolist'=>$photolist,
                    'sourceId'=>$sourceId,
                    'sourceType'=>$sourceType,
                    'headpic'=>$headPic,
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));//如果id不对则跳出错误页面
            }
        }elseif($sourceType=="shop"){
            //判断此房源是否是当前用户所有。
            $source = Shopbaseinfo::model()->findByAttributes(array("sb_shopid"=>$sourceId,"sb_uid"=>$userId));
            if($source){
                $headPic = $source->presentInfo->sp_titlepicurl;
                $photolist = Picture::model()->getAllPictures($sourceId,Picture::$sourceType['shopbaseinfo'],3);
                $this->render('photomanage',array(
                    'photolist'=>$photolist,
                    'sourceId'=>$sourceId,
                    'sourceType'=>$sourceType,
                    'headpic'=>$headPic,
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        } elseif($sourceType=="residence") {//住宅图片
            //判断此房源是否是当前用户所有。
            $source = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$sourceId,"rbi_uid"=>$userId));
            if($source){
                $headPic = $source->rbi_titlepicurl;
                $photolist = Picture::model()->getAllPictures($sourceId,Picture::$sourceType['residencebaseinfo'],3);
                $this->render('photomanage',array(
                    'photolist'=>$photolist,
                    'sourceId'=>$sourceId,
                    'sourceType'=>$sourceType,
                    'headpic'=>$headPic,
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        }elseif($sourceType=="cypark"){//创意园区
            $source = Creativesource::model()->findByAttributes(array("cr_id"=>$sourceId,"cr_userid"=>$userId));
            if($source){
                $headPic = $source->cr_titlepicurl;
                $photolist = Picture::model()->getAllPictures($sourceId,Picture::$sourceType['cyparksource'],3);
                $this->render('photomanage',array(
                    'photolist'=>$photolist,
                    'sourceId'=>$sourceId,
                    'sourceType'=>$sourceType,
                    'headpic'=>$headPic,
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        }
    }
	public function actionPhotolist()
	{
		if(isset($_POST['id'])&&isset($_POST['stype'])&&isset($_POST['type']))
		{
			$photolist = Picture::model()->findAllByAttributes(array(
				'p_sourceid'=>$_POST['id'],
				'p_sourcetype'=>$_POST['stype'],
				'p_type'=>$_POST['type'],
			));
			$photo=array();
			foreach($photolist as $p)
			{
				array_push($photo,array('pid'=>$p->p_id,'tinyimg'=>$p->p_tinyimg));
			}
			echo json_encode($photo);
		}
	}
    /*
     * 后台上传房源图片
     */
	public function actionUploadPhoto(){
        $type = $_GET['type'];//图片类型
        if($type>3||$type<1){
            $this->redirect(array('main/error'));
        }
        
        $userId = Yii::app()->user->id;

        $sourceId = $_GET['id'];//房源id
        $sourceType = "office";
        if(isset($_GET['sourcetype'])&&in_array($_GET['sourcetype'], $this->sourceType)){
            $sourceType = $_GET['sourcetype'];
        }
        if($sourceType=="office"){
            //判断此房源是否是当前用户所有。
            $source = Officebaseinfo::model()->findByAttributes(array("ob_officeid"=>$sourceId,"ob_uid"=>$userId));
            if($source){
                $headPic = $source->ob_titlepicurl;
                $photolist=Picture::model()->findAllByAttributes(array(
					'p_sourceid'=>$sourceId,
					'p_sourcetype'=>Picture::$sourceType['officebaseinfo'],
					'p_type'=>$type,
                ));
                $this->render('uploadphoto',array(
                    'type'=>$type,//图片类型
                    'photolist'=>$photolist,//所有图片
                    'sourceId'=>$sourceId,//房源ID
                    'sourceType'=>$sourceType,//资源类型
                    'headpic'=>$headPic,//标题图片
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        }elseif($sourceType=="shop"){
            //判断此房源是否是当前用户所有。
            $source = Shopbaseinfo::model()->findByAttributes(array("sb_shopid"=>$sourceId,"sb_uid"=>$userId));
            if($source){
                $headPic = $source->presentInfo->sp_titlepicurl;
                $photolist=Picture::model()->findAllByAttributes(array(
					'p_sourceid'=>$sourceId,
					'p_sourcetype'=>Picture::$sourceType['shopbaseinfo'],
					'p_type'=>$type,
                ));
                $this->render('uploadphoto',array(
                    'type'=>$type,//图片类型
                    'photolist'=>$photolist,//所有图片
                    'sourceId'=>$sourceId,//房源ID
                    'sourceType'=>$sourceType,//资源类型
                    'headpic'=>$headPic,//标题图片
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        }elseif($sourceType=="residence"){//住宅
            //判断此房源是否是当前用户所有。
            $source = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$sourceId,"rbi_uid"=>$userId));
            if($source){
                $headPic = $source->rbi_titlepicurl;
                $photolist=Picture::model()->findAllByAttributes(array(
					'p_sourceid'=>$sourceId,
					'p_sourcetype'=>Picture::$sourceType['residencebaseinfo'],
					'p_type'=>$type,
                ));
                $this->render('uploadphoto',array(
                    'type'=>$type,//图片类型
                    'photolist'=>$photolist,//所有图片
                    'sourceId'=>$sourceId,//房源ID
                    'sourceType'=>$sourceType,//资源类型
                    'headpic'=>$headPic,//标题图片
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        }elseif($sourceType=="cypark"){//创意园区
            //判断此房源是否是当前用户所有。
            $source = Creativesource::model()->findByAttributes(array("cr_id"=>$sourceId,"cr_userid"=>$userId));
            if($source){
                $headPic = $source->cr_titlepicurl;
                $photolist=Picture::model()->findAllByAttributes(array(
					'p_sourceid'=>$sourceId,
					'p_sourcetype'=>Picture::$sourceType['cyparksource'],
					'p_type'=>$type,
                ));
                $this->render('uploadphoto',array(
                    'type'=>$type,//图片类型
                    'photolist'=>$photolist,//所有图片
                    'sourceId'=>$sourceId,//房源ID
                    'sourceType'=>$sourceType,//资源类型
                    'headpic'=>$headPic,//标题图片
                    'menu'=>@$_GET['menu'],
                ));
            }else{
                $this->redirect(array('main/error'));
            }
        }
    }
    /**
     * 后台上传房源图片
     */
    public function actionUpload(){
        $va = va();
        $va->check(array(
            'type'=>array('not_blank','uint'),
            'id'=>array('not_blank','uint'),
            'sourceType'=>array(array('eq', 'office', 'shop','residence',"cypark")),
        ));
        if($va->success){
            if($_FILES){
                $path = Picture::model()->picTypePath($va->valid['type']);//得到图片类型路径
                $originfilename = strtolower($_FILES['picfile']['name']); //文件名
                $fileSize = $_FILES['picfile']['size'];//文件尺寸
                $fileext = strtolower(substr($originfilename,strrpos($originfilename,'.'))); //后缀名
                $interpic = false;
                while(!empty($_FILES['picfile']['size'])){
                    $_imgsize = getimagesize($_FILES['picfile']['tmp_name']);
                    if(is_array($_imgsize) && count($_imgsize)>3){
                        if($_imgsize[0]<200 || $_imgsize[1]<200)//图片小于200*200
                            break;
                        if(max($_imgsize[0],$_imgsize[1])/min($_imgsize[0],$_imgsize[1])>2)//长短边比值超过2:1
                            break;
                    }else
                        break;
                    if($_FILES['picfile']['size']>3145728 || $_FILES['picfile']['size']<20480 )//图片大小限定 20KB~3MB
                        break;
                    $interpic=true;

                    break;
                }
                //验证文件格式是否正确
                $patn = "/jpg$|jpeg$|gif$|png$/i";
                if($interpic&&preg_match($patn,$fileext)){//文件小于4M
                    $fileName = Picture::model()->imageName($originfilename,$path);//包含了路径的新的文件名称
                    $targetFile =  PIC_PATH.$fileName;
                    $tempFile = $_FILES['picfile']['tmp_name'];
                    $boolUploadFile = move_uploaded_file($tempFile,$targetFile);
                    if($boolUploadFile){
                        //处理缩略图
                        $imageDeal = new Image();
                        $result = $imageDeal->formatWithPicture($targetFile,Officebaseinfo::$officePicNorm,true);//处理缩略图
                    }
                    //保存记录
                    $pic= new picture;
                    $dba = dba();
                    $pic->p_id = $dba->id('35_picture');
                    $pic->p_sourceid=$va->valid['id'];
                    $pic->p_type=$va->valid['type'];
                    $pic->p_img=$fileName;
                    $pic->p_tinyimg=$fileName;
                    $pic->p_uploadtime=time();
                    if($va->valid['sourceType']=="office"){//写字楼
                        $pic->p_sourcetype=Picture::$sourceType['officebaseinfo'];
                        $pic->save();
                    }elseif($va->valid['sourceType']=="shop"){//商铺
                        $pic->p_sourcetype=Picture::$sourceType['shopbaseinfo'];
                        $pic->save();
                    }elseif($va->valid['sourceType']=="residence"){
                        $pic->p_sourcetype=Picture::$sourceType['residencebaseinfo'];
                        $pic->save();
                    }elseif($va->valid['sourceType']=="cypark"){
                        $pic->p_sourcetype=Picture::$sourceType['cyparksource'];
                        $pic->save();
                    }
                }else{
                    Yii::app()->user->setFlash('uploadFile','图片上传成功');
                }
            }
        }
        header('Location:'.$_SERVER['HTTP_REFERER']);
	}
    public function actionUpdatetitle(){
        if(Yii::app()->request->isAjaxRequest)
		{
			// we only allow deletion via POST request
			if(($pic = Picture::model()->findByPk($_POST['id']))){
                $pic->p_title = $_POST['title'];
                $pic->save();
            }
		}
    }
	
	public function actionDelphoto()
	{
		if(isset($_GET['id']))
		{
            //判断图片是否是当前用户当前房源的
            $pictureModel = Picture::model()->findByPK($_GET['id']);
            $userId = Yii::app()->user->id;
            $sid=$pictureModel->p_sourceid;
			$stype=$pictureModel->p_sourcetype;
            $format = array();
			switch ($stype)
			{
				case Picture::$sourceType['officebaseinfo']:
					$sourceModel = Officebaseinfo::model()->findByAttributes(array("ob_officeid"=>$sid,"ob_uid"=>$userId));
                    $format = Officebaseinfo::$officePicNorm;
					break;
				case Picture::$sourceType['shopbaseinfo']:
					$sourceModel = Shopbaseinfo::model()->findByAttributes(array("sb_shopid"=>$sid,"sb_uid"=>$userId));
                    $format = Officebaseinfo::$officePicNorm;
					break;
				case Picture::$sourceType['residencebaseinfo']:
					$sourceModel = Residencebaseinfo::model()->findByAttributes(array("rbi_id"=>$sid,"rbi_uid"=>$userId));
                    $format = Officebaseinfo::$officePicNorm;
					break;
				case Picture::$sourceType['cyparksource']:
                    $sourceModel = Creativesource::model()->findByAttributes(array("cr_id"=>$sid,"cr_userid"=>$userId));
                    $format = Creativesource::$cyParkPicNorm;
                    break;
			}
            if($sourceModel){
                //上面判断结束，要删除的照片属于当前用户。可以删除。
                $imgpath = PIC_PATH.$pictureModel->p_img;
                if($pictureModel->delete() && $pictureModel->p_quote != '1'){//删除图片。
                    Picture::model()->deleteFile($imgpath,$format);
                }
            }
			echo 1;
		}
	}
	/**
     * 显示楼盘的图片
     */
	public function actionShowBasePic(){
            $condition = array('select'=>'p_id,p_type,p_img','condition'=>"p_sourceid=:id AND p_sourcetype=:type AND p_type=:ptype",'params'=>array(':id'=>$_GET['id'],':type'=>$_GET['type'],':ptype'=>$_GET['ptype']));
            $basepics = Picture::model()->findAll( $condition );
            $this->layout='frame';
            $this->render('showbasepic',array(
                "data"=>$basepics,
            ));
        }
	
	public function actionSettitle()
	{
		if(isset($_POST['id']))
		{
			$pic=Picture::model()->findByPK($_POST['id']);
			$sid=$pic->p_sourceid;
			$stype=$pic->p_sourcetype;
			switch ($stype)
			{
				case Picture::$sourceType['officebaseinfo']:
					Officebaseinfo::model()->updateAll(array('ob_titlepicurl'=>$_POST['id']),'ob_officeid='.$sid);
					break;
				case Picture::$sourceType['shopbaseinfo']:
					shoppresentinfo::model()->updateAll(array('sp_titlepicurl'=>$_POST['id']),'sp_shopid='.$sid);
					break;
				case Picture::$sourceType['residencebaseinfo']:
					Residencebaseinfo::model()->updateAll(array('rbi_titlepicurl'=>$_POST['id']),'rbi_id='.$sid);
					break;
                case Picture::$sourceType['cyparksource']:
                    Creativesource::model()->updateAll(array('cr_titlepicurl'=>$_POST['id']),'cr_id='.$sid);
                    break;
			}
		}
	}
    public function actionGridshow(){
        $va = va();
        $va->check(array(
            'sId'=>array('not_blank','uint'),
            'sType'=>array('not_blank','uint'),//资源类型。写字楼或者商铺
            'pType'=>array('not_blank','uint'),//图片类型。内景图还是外景图
        ));
        if($va->success){
            $model = null;
            $prevNavigation = array();//上一级的菜单
            if($va->valid['sType']==Picture::$sourceType['systembuilding']){//是楼盘
                $model = Systembuildinginfo::model()->findbyPk($va->valid['sId']);
                $prevNavigation[0]['title']='楼盘中心首页';
                $prevNavigation[0]['value']=array('systembuildinginfo/index');
                $prevNavigation[1]['title']=$model->sbi_buildingname;
                $prevNavigation[1]['value']=array('systembuildinginfo/view','id'=>$va->valid['sId']);
            }elseif($va->valid['sType']==Picture::$sourceType['officebaseinfo']){//是写字楼
                $model = Officebaseinfo::model()->with('presentInfo')->findbyPk($va->valid['sId']);
                if($model->ob_sellorrent==Officebaseinfo::rent){
                    $prevNavigation[0]['title']='写字楼出租';
                    $prevNavigation[0]['value']=array('officebaseinfo/rentIndex');
                    $prevNavigation[1]['value']=array('officebaseinfo/rentView','id'=>$va->valid['sId']);
                }else{
                    $prevNavigation[0]['title']='写字楼出售';
                    $prevNavigation[0]['value']=array('officebaseinfo/saleIndex');
                    $prevNavigation[1]['value']=array('officebaseinfo/saleView','id'=>$va->valid['sId']);
                }
                $prevNavigation[1]['title']=$model->presentInfo->op_officetitle;
            }elseif($va->valid['sType']==Picture::$sourceType['shopbaseinfo']){
                $this->layout = "shop";
                $model = Shopbaseinfo::model()->findbyPk($va->valid['sId']);
                if($model->sb_sellorrent==1){
                    $prevNavigation[0]['title']='商铺出租';
                    $prevNavigation[0]['value']=array('shop/rentIndex');
                }else{
                    $prevNavigation[0]['title']='商铺出售';
                    $prevNavigation[0]['value']=array('shop/sellIndex');
                }
                $prevNavigation[1]['title']=$model->presentInfo->sp_shoptitle;
                $prevNavigation[1]['value']=array('shop/view','id'=>$va->valid['sId']);
            }
            $pictures = Picture::model()->getPicturesByType($va->valid['sId'],$va->valid['sType'],$va->valid['pType']);
            $picArray = Picture::model()->getImgArrayByActiveRecord($pictures);
            $this->render('gridshow',array(
                'model'=>$model,
                'pictures'=>$pictures,
                'picType'=>$va->valid['pType'],
                'picArray'=>$picArray,
                'prevNavigation'=>$prevNavigation,
                'pId'=>isset($_GET['pId'])?$_GET['pId']:"",
            ));
        }else{
            $this->redirect(array('main/error'));
        }
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
				$this->_model=Picture::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='picture-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
