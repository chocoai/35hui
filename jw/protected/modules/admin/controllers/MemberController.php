<?php
class MemberController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $show = array(
            "userId"=>"",
            "name"=>"",
            "order"=>"0",
        );
        if(isset($_GET["userId"])&&$_GET["userId"]){
            $criteria->addColumnCondition(array("am_userid"=>$_GET["userId"]));
            $show["userId"] = $_GET["userId"];
        }
        if(isset($_GET["name"])&&$_GET["name"]){
            $show["name"] = $_GET["name"];
            $c=new CDbCriteria;
            $c->addSearchCondition("u_nickname",$_GET["name"]);
            $c->select = "u_id";
            $userList = User::model()->findAll($c);
            
            $idArr = array();
            foreach($userList as $v){
                $idArr[] = $v->u_id;
            }
            $criteria->addInCondition("mem_userid",$idArr);
            
        }
        if(isset($_GET["order"])&&$_GET["order"]){
            $show["order"] = $_GET["order"];
            switch ($_GET["order"]){
                case 1:
                    $criteria->order = "mem_redboard desc";
                    break;
                case 2:
                    $criteria->order = "mem_allrecommentnum desc";
                    break;
                case 3:
                    $criteria->order = "mem_lastrecommenttime desc";
                    break;
                
            }
        }
        $dataProvider =  new CActiveDataProvider("Member", array(
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