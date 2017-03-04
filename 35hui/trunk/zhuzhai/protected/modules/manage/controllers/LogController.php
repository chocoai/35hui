<?php

class LogController extends Controller
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
			array('allow',
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function actionAjaxClearLog(){
        $reInt = 2;
        $va = va();
        $va->check(array(
            'type'=>array('not_blank',array('eq',Log::integral,Log::money))
        ));
        if($va->success){
            if(Yii::app()->user->isGuest){
                $reInt=3;//未登录
            }else{
                $deleteCount = Log::model()->deleteAllByAttributes(
                    array(
                        'lg_userid'=>Yii::app()->user->id,
                        'lg_type'=>$va->valid['type']
                    )
                );
                if($deleteCount>0)
                    $reInt=1;
            }
        }
        echo $reInt;
    }
}
