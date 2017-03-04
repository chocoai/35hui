<?php

class NewsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';

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
				'actions'=>array('day','newsbyid','newslist'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('addcommend'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	//图片新闻
	public function Pictrue()
	{
		//首页自动切换图片资讯
        $criteria=new CDbCriteria;
        $criteria->condition = "np_type=1";
		$criteria->limit=10;
		$criteria->order="np_order";
		$pic=Newspic::model()->findAll($criteria);
        return $pic;
	}

	
	//查询评论
	public function ShowComment()
	{
		$id="";
		if(isset($_GET['nid'])){
			$id=$_GET['nid'];
		}
		$criteria=new CDbCriteria;
		$dataProvider=new CActiveDataProvider('Comment',array(
                        'criteria'=>array(
                            'condition'=>'n_id='.$id,
                            'with'=>array("user"),
                        ),
                        'pagination'=>array(
                            'pageSize'=>5,
                        ),
                ));
		return $dataProvider;
	}
	
	
	//新闻列表
	public function actionNewsList()
	{
        $criteria = new CDbCriteria(array(
            'order' => 'n_date desc',
        ));
        $state = "";
        if(isset($_GET['n_state'])&&$_GET['n_state']!=""){
            $state = $_GET['n_state'];
            $criteria->addColumnCondition(array('n_state'=>$state));
        }
        $keyword = "";
        if(isset($_GET['title'])&&$_GET['title']!=""){
            $keyword = urldecode($_GET['title']);
            $idArr = @common::getIdsBySphinxSearch($keyword, Yii::app()->params['newsIndex'],"array");
            $criteria->addInCondition('n_id', $idArr);
        }
        $dataProvider=new CActiveDataProvider('News', array(
                'criteria'=>$criteria,
                'pagination'=>array(
                    'pageSize'=>20,
                ),
        ));
        $hotnews = News::model()->getNewsByClick(10);
        $recentnews = News::model()->getRecentNews(10);
        $seotkd = Seotkd::model()->findByPk(8);//SEO优化
        $this->render('newslist',array(
            'hotnews'=>$hotnews,
            'recentnews'=>$recentnews,
            'state'=>$state,
            'title'=>$keyword,
            'dataProvider'=>$dataProvider,
            'seotkd'=>$seotkd
        ));
	}
	
	//根据id查询详细新闻
	public function actionNewsById()
	{    
		$id="";
		if(isset($_GET['nid'])){
			$id=$_GET['nid'];
		}
		$criteria=new CDbCriteria;
		$criteria->condition="n_id=".$id;
		$newsdeatil=News::model()->find($criteria);
        if(!empty($newsdeatil)){//如果id正确，判断是否cookie中是否有此信息，没有就添加。
            $cookie_viewNewsId = Yii::app()->request->cookies['viewNewsId'];
            if(isset($cookie_viewNewsId)&&$cookie_viewNewsId!=""){//已经看过资讯
                $viewidstr = $cookie_viewNewsId->value;//id在cookie中以字符串存放，用,分割。
                $viewidarr = split(",", "$viewidstr");
                if(!in_array($id, $viewidarr)){//如果还没看过此资讯
                    $viewidarr[] = $id;
                    $viewidstr = implode(",", $viewidarr);
                    $cookie=new CHttpCookie("viewNewsId",$viewidstr);
                    $cookie->expire = time()+86400;
                    Yii::app()->request->cookies["viewNewsId"]=$cookie;
                    //点击数加1。
                    News::model()->updateClick($id);
                }
            }else{//如果还没有看过任何资讯
                $cookie=new CHttpCookie("viewNewsId",$id);
                $cookie->expire = time()+86400;
                Yii::app()->request->cookies["viewNewsId"]=$cookie;
                //点击数加1。
                News::model()->updateClick($id);
            }
        }
		//相关新闻
		$like="";
		if($newsdeatil!=""){
			$like=$newsdeatil['n_keyword'];
		}
		$criteria=new CDbCriteria;
        $criteria->limit = 5;
		$criteria->condition="n_id!=$id and n_title like '%".$like."%'";
		$newslike=News::model()->findAll($criteria);
		$hotnews = News::model()->getNewsByClick(10);
        $recentnews = News::model()->getRecentNews(10);
		$Comment=$this->ShowComment();
		$seotkd = Seotkd::model()->findByPk(8);//SEO优化
        $this->render('newsdeatil',array(
                'newsdeatil'=>$newsdeatil,//当前新闻
                'newslike'=>$newslike,//相关新闻
                'Comment'=>$Comment,
                'hotnews'=>$hotnews,
                'recentnews'=>$recentnews,
                'seotkd'=>$seotkd,
            ));
		
	}
    //评论
    public function actionAddCommend(){
        //发表评论(未完善)
        if(isset($_POST['nid'])&&$_POST['nid']!=""){
            if(isset($_POST['comment'])&&$_POST['comment']!=""){
                $userid = Yii::app()->user->id;
                if($userid!=""){
                    $time=time();
                    $model = new Comment();
                    $model->n_id = $_POST['nid'];
                    $model->user_id = $userid;
                    $model->c_comment = $_POST['comment'];
                    $model->c_date = $time;
                    $model->save();
                }
            }
            $this->redirect(array('newsbyid','nid'=>$_POST['nid']));
        }
    }
	//资讯首页
	public function actionDay()
	{
        $criteria=new CDbCriteria;
        $criteria->condition = "np_type=1";
		$criteria->limit=10;
		$criteria->order="np_order";
		$pic=Newspic::model()->findAll($criteria);
        
        //房产资讯
        $newsall = News::model()->getAllNews(7);
        //上海写字楼政策
        $newszc = News::model()->getNewsByType(0,8);
        //上海写字楼成交数据
        $newscj = News::model()->getNewsByType(1,8);
        //上海写字楼调查报告
        $newsdc = News::model()->getNewsByType(2,8);
        //上海写字楼研究报告
        $newsyj = News::model()->getNewsByType(3,8);
        //热点资讯
        $criteria=new CDbCriteria;
		$criteria->limit=7;
		$criteria->order="n_click desc";
		$hotnews=News::model()->findAll($criteria);
        $seotkd = Seotkd::model()->findByPk(8);//SEO优化
		$this->render('newsday',
			array(
                'pic'=>$pic,
				'newsall'=>$newsall,
				'newszc'=>$newszc,
				'newscj'=>$newscj,
				'newsdc'=>$newsdc,
				'newsyj'=>$newsyj,
				'hotnews'=>$hotnews,//热点资讯
				'seotkd'=>$seotkd,//SEO优化
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
				$this->_model=news::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}	
}
