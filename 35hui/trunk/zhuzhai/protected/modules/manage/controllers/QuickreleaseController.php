<?php
class QuickreleaseController extends Controller
{
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionIndex(){
        //print_r($criteria);
        $dataProvider=new CActiveDataProvider('Quickrelease', array(
			'pagination'=>array(
				'pageSize'=>10,//buildname
			),
            'criteria'=>array('condition'=>'qrl_check != 0','order'=>'qrl_id DESC','with'=>'buildname'),
		));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
}
