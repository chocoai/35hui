<?php
class UserController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $criteria->order = "u_regtime desc";
        $dataProvider =  new CActiveDataProvider("User", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),

        ));
        $this->render("index",array(
            "dataProvider"=>$dataProvider
        ));
    }
}