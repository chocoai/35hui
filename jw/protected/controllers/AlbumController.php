<?php

class AlbumController extends Controller
{
    public $layout='user';
    private $_model;
    public function actionIndex(){
        $userModel = User::model()->findByPk($_GET['id']);
        if(!$userModel||$userModel->u_role==User::ROLE_AUDIENCE){
            throw new CHttpException(404,'页面不存在');
        }
        $this->layout = "user";
        $this->uid = $userModel->u_id;
        $criteria=new CDbCriteria;
        $criteria->order = "am_updatetime desc";
        $criteria->addColumnCondition(array("am_userid"=>$userModel->u_id));
        $album = Album::model()->findAll($criteria);
        
        $this->render("index",array(
                "album"=>$album,
            "userModel"=>$userModel
        ));
    }
    public function actionComment(){
        $albumModel = $this->loadModel();
        $userModel = User::model()->findByPk($albumModel->am_userid);
        $this->uid = $userModel->u_id;

        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ac_albumid"=>$albumModel->am_id));
        $criteria->addCondition("ac_replyuscid='0'");
        $criteria->order = "ac_createtime desc";
        $dataProvider =  new CActiveDataProvider("Albumcomment", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        /*所有相册*/
        $criteria=new CDbCriteria;
        $criteria->order="am_createtime desc";
        $criteria->addColumnCondition(array("am_userid"=>$userModel->u_id));
        $albumList = Album::model()->findAll($criteria);
        
		$this->render('comment',array(
            "userModel"=>$userModel,
            "albumModel"=>$albumModel,
            "dataProvider"=>$dataProvider,
            "albumList"=>$albumList,
        ));
    }
    public function actionAddComment(){
        $userId = User::model()->getId();
        if(!$userId){
            echo "请先登录";exit;
        }
        $albumId = $_POST["albumId"];
        $content = $_POST["content"];
        
        if(Albumcomment::model()->addComment($albumId, 0, $content)){
            echo "success";exit;
        }
        echo "输入的内容太长";exit;
    }
    public function actionView(){
        $albumModel = $this->loadModel();
        $userModel = User::model()->findByPk($albumModel->am_userid);
        $this->uid = $userModel->u_id;

        /*本相册下所有图片*/
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ap_amid"=>$albumModel->am_id));
        $photoList = Albumphoto::model()->findAll($criteria);

        /*所有相册*/
        $criteria=new CDbCriteria;
        $criteria->order="am_createtime desc";
        $criteria->addColumnCondition(array("am_userid"=>$userModel->u_id));
        $albumList = Album::model()->findAll($criteria);

        
        /*浏览数增加*/
        $cookie = Yii::app()->request->getCookies();
        $arr = array();
        if($cookie["album_view"]&&isset($cookie["album_view"]->value)){
            $arr = explode(",",$cookie["album_view"]->value);
        }
        if(array_search($albumModel->am_id,$arr)===false){//没有访问过这个详细，增加访问数
            //增加访问数
            $albumModel = Album::model()->addVisitNum($albumModel);
            //更新cookie
            $arr[] = $albumModel->am_id;
            $val = implode(",",$arr);
            $cookie = new CHttpCookie('album_view',$val);
            $cookie->expire = time()+3600;  //有限期1个小时
            Yii::app()->request->cookies['album_view']=$cookie;
        }

        /*相册的最新5条评论*/
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ac_albumid"=>$albumModel->am_id));
        $criteria->addCondition("ac_replyuscid='0'");
        $criteria->limit = 5;
        $criteria->order = "ac_createtime desc";
        $albumComment = Albumcomment::model()->findAll($criteria);
        
        $this->render('view',array(
            "userModel"=>$userModel,
            "albumModel"=>$albumModel,
            "photoList"=>$photoList,
            "albumList"=>$albumList,
            "albumComment"=>$albumComment
        ));
    }
     public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id'])){
                $this->_model=Album::model()->findbyPk($_GET['id']);
            }
            if($this->_model===null){
                throw new CHttpException(404,'页面不存在');
            }
        }
        return $this->_model;
    }
}