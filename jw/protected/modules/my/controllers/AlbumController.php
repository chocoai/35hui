<?php

class AlbumController extends Controller {
    private $_model;
    public $layout="album";
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
        $this->layout = "default";
        $albums = Album::model()->findAllByAttributes(array("am_userid"=>User::model()->getId()));
        $this->render('index',
                array(
                "albums"=>$albums
                )
        );
    }
    public function actionCreate() {
        if(isset($_POST)&&$_POST) {
            $title = $_POST["title"];
            $describe = $_POST["description"];
            $type = $_POST["type"];

            $userId = User::model()->getId();
            //统计相册数目。判断是否还能继续创建相册
            $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $levelModel = Memberlevel::model()->getUserLevelModel($memberModel);
            $count = Album::model()->count("am_userid=".$userId);
            if($count>=$levelModel->ml_albumnum) {
                echo json_encode(array("error","您已经创建了".$count."个相册，达到了当前级别可创建相册的最大值！"));
                exit;
            }
            $album = new Album();
            $time = time();
            $album->am_userid = $userId;
            $album->am_albumtitle = $title;
            $album->am_albumdescribe = $describe;
            $album->am_albumtype = $type;

            $album->am_createtime = $time;
            $album->am_updatetime = $time;
            if($album->save()) {
                echo json_encode(array($album->am_id,$album->am_albumtitle));
                exit;
            }
        }
        echo json_encode(array("error","输入内容错误"));
        exit;
    }
    public function actionEdit() {
        $album = $this->loadModel();
        if(isset($_POST)&&$_POST) {
            $title = $_POST["title"];
            $describe = $_POST["description"];
            $type = $_POST["type"];

            $album->am_albumtitle = $title;
            $album->am_albumdescribe = $describe;
            $album->am_albumtype = $type;
            $album->am_updatetime = time();
            if($album->save()) {
                echo json_encode("success");
                exit;
            }
        }
        echo json_encode("error");
        exit;
    }
    public function actionDel() {
        $album = $this->loadModel();
        //删除相册中所有的图片
        $photos = Albumphoto::model()->findAllByAttributes(array("ap_amid"=>$album->am_id));
        foreach ($photos as $value) {
            Albumphoto::model()->delImg($value->ap_url);
            $value->delete();
        }
        //删除相册
        $album->delete();
        //删除相册推荐
        Albumrecommend::model()->deleteAll("ar_amid=".$album->am_id);
        echo json_encode("success");
        exit;
    }
    public function actionView() {
        $id = $_GET["id"];
        //判断相册是否属于当前用户
        $albummodel = $this->loadModel();
        //获取所有相片
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ap_amid"=>$id));
        $criteria->order = "ap_order";
        $albumphoto = Albumphoto::model()->findAll($criteria);

        /*评论*/
        $criteria=new CDbCriteria();
        $criteria->addColumnCondition(array("ac_albumid"=>$albummodel->am_id,"ac_replyuscid"=>0));//不是回复的。。暂时不做回复
        $criteria->order = "ac_createtime desc";
        $dataProvider =  new CActiveDataProvider("Albumcomment", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render('view',
                array(
                "albummodel"=>$albummodel,
                "albumphoto"=>$albumphoto,
                "dataProvider"=>$dataProvider
                )
        );
    }
    public function actionSort() {
        $id = $_GET["id"];
        //判断相册是否属于当前用户
        $model = $this->loadModel();
        //获取所有相片
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ap_amid"=>$id));
        $criteria->order = "ap_order";
        $albumphoto = Albumphoto::model()->findAll($criteria);
        $this->render('sort',
                array(
                "albumphoto"=>$albumphoto
                )
        );
    }
    /**
     * 保存排序
     */
    public function actionSavesort() {
        if(isset($_POST["newsort"])&&$_POST["newsort"]) {
            $idArr = explode("|", $_POST["newsort"]);
            foreach($idArr as $key=>$value) {
                Albumphoto::model()->updateByPk($value, array("ap_order"=>$key+1));
            }
            echo json_encode("success");
            exit;
        }
        echo json_encode("error");
        exit;
    }
    /**
     * 设置封面
     */
    public function actionSetcover() {
        if(isset($_POST["photoid"])&&$_POST["photoid"]) {
            $albumphotoModel = Albumphoto::model()->findByPk($_POST["photoid"]);
            if($albumphotoModel) {
                $album = Album::model()->findByPk($albumphotoModel->ap_amid);
                if($album&&Album::model()->checkAlbumBelongCurrentUser($album)) {
                    $album->am_albumcoverid = $_POST["photoid"];
                    $album->update();
                    echo json_encode("success");
                    exit;
                }
            }
        }
        echo json_encode("error");
        exit;
    }
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id'])) {
                $this->_model=Album::model()->findbyPk($_GET['id']);
            }
            if(!Album::model()->checkAlbumBelongCurrentUser($this->_model)) {//如果相册不属于当前用户
                $this->_model = null;
            }
            if($this->_model===null) {
                throw new CHttpException(404,'The requested page does not exist.');
            }
        }
        return $this->_model;
    }
}