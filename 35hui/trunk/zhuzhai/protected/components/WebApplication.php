<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class WebApplication extends CWebApplication {
    public function init() {
        error_reporting(E_ALL);
        parent::init();
        Yii::app()->session;
        if( isset(Yii::app()->user->id)) {
            if(!isset($_SESSION['login_time'])){
               $_SESSION['login_time']=time();
            }
            $logout_time = time();
            $dur = $logout_time-$_SESSION['login_time'];
            if($dur>30){
                $model=User::model()->findbyPk(Yii::app()->user->id);
                $model->user_online = $model->user_online+$dur;
                $model->user_lastoptime= $logout_time;
                $model->update();
                $_SESSION['login_time']=$logout_time;
            }
        }
    }
}