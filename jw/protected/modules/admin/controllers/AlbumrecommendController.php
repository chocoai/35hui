<?php
class AlbumrecommendController extends Controller {
    public $layout = "manage";
    public function actionView() {
        $amid = $_GET["amid"];
        $albumModel = Album::model()->findByPk($amid);
        if(!$albumModel){
            throw new CHttpException(404,'页面不存在');
        }
        /*推荐记录*/
        
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ar_amid"=>$albumModel->am_id));
        $criteria->order = "ar_recommendtime desc";
        $albumRecommend = Albumrecommend::model()->findAll($criteria);
        $this->render("view",array(
            "albumRecommend"=>$albumRecommend,
            "albumModel"=>$albumModel
        ));
    }
    public function actionCreate(){
        $amId = $_POST["amid"];
        if(!Albumrecommend::model()->checkCanRecommend($amId)){
            echo "今日此相册已经推荐！不能重复推荐！";exit;
        }
        $model = new Albumrecommend();
        $model->ar_amid = $amId;
        $model->ar_recommendtime = strtotime(date("Y-m-d"));
        $model->ar_createtime = time();
        $model->save();
        //修改总推荐数目;
        $albumModel = Album::model()->findByPk($amId);
        $albumModel->am_allrecommentnum += 1;
        $albumModel->am_lastrecommenttime = $model->ar_recommendtime;
        $albumModel->update();
        echo "success";exit;
    }
}