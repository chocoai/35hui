<?php
class AlbumController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $show = array(
            "userId"=>"",
            "albumTitle"=>"",
            "order"=>"0",
        );
        if(isset($_GET["userId"])&&$_GET["userId"]){
            $criteria->addColumnCondition(array("am_userid"=>$_GET["userId"]));
            $show["userId"] = $_GET["userId"];
        }
        if(isset($_GET["albumTitle"])&&$_GET["albumTitle"]){
            $criteria->addSearchCondition("am_albumtitle",$_GET["albumTitle"]);
            $show["albumTitle"] = $_GET["albumTitle"];
        }
        if(isset($_GET["order"])&&$_GET["order"]){
            $show["order"] = $_GET["order"];
            switch ($_GET["order"]){
                case 1:
                    $criteria->order = "am_redboard desc";
                    break;
                case 2:
                    $criteria->order = "am_blackboard desc";
                    break;
                case 3:
                    $criteria->order = "am_allrecommentnum desc";
                    break;
                case 4:
                    $criteria->order = "am_lastrecommenttime desc";
                    break;
                case 5:
                    $criteria->order = "am_updatetime desc";
                    break;
            }
        }
        $dataProvider =  new CActiveDataProvider("Album", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
            "dataProvider"=>$dataProvider,
            "show"=>$show,
        ));
    }
}