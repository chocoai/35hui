<?php

class AccountrechargeController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("arc_state"=>1));
        $criteria->order = "arc_rechargetime desc";
        $dataProvider =  new CActiveDataProvider("Accountrecharge", array(
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