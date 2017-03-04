<?php
class ManageuserController extends Controller
{
    public $layout = "login";

    public function actionLogin(){
        $show = "";
        if(isset($_POST)&&$_POST){
            $name = Manageuser::DEFAULT_ROOT_NAME;
            $password = md5($_POST["adminpassword"]);
            $model = Manageuser::model()->findByAttributes(array("m_name"=>$name));
            if($model&&$password==$model->m_password){
                Yii::app()->user->setState("adminkey",Yii::app()->params->adminkey);
                header("Location:".DOMAIN."/admin");
            }else{
                $show="密码错误";
            }
        }
        $this->render("login",array(
            "show"=>$show,
        ));
    }
    public function actionLogout(){
        Yii::app()->user->setState("adminkey","");
        $this->redirect("login");
    }
    public function actionChagepwd(){
        $this->layout = "manage";
        if(isset($_POST)&&$_POST){
            $return = "内部错误！";
            $name = Manageuser::DEFAULT_ROOT_NAME;
            $model = Manageuser::model()->findByAttributes(array("m_name"=>$name));
            $password = md5($_POST["oldpwd"]);
            if($model&&$password==$model->m_password&&$_POST["newpwd1"]==$_POST["newpwd2"]){
                $model->m_password = md5($_POST["newpwd2"]);
                if($model->save()){
                    $return = "success";
                }
            }else{
                $return = "旧密码输入错误！";
            }
            echo $return;exit;
        }
        $this->render("chagepwd");
    }
}