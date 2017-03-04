<?php
class ReleaseController extends Controller
{
    /**
     * 待跳转的Controller
     * @var string
     */
    public $redirectController=array(
        'rent'=>'/manage/officebaseinfo/rentrelease',
        'sell'=>'/manage/officebaseinfo/salerelease',
    );
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
			array('allow',  // allow all users
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    public function init(){
        parent::init();//redirectController
//        switch (Yii::app()->user->getState('mainbusiness','1')) {
//            case "1":
//                $this->redirectController=array(
//                    'rent'=>'/manage/officebaseinfo/rentrelease',
//                    'sell'=>'/manage/officebaseinfo/salerelease'
//                    );
//                break;
//            case '2':
//                $this->redirectController=array(
//                    'rent'=>'/manage/shopbaseinfo/rentrelease',
//                    'sell'=>'/manage/shopbaseinfo/sellrelease',
//                );
//                break;
//            case '3':
//                $this->redirectController=array(
//                    'rent'=>'/manage/residencebaseinfo/rentrelease',
//                    'sell'=>'/manage/residencebaseinfo/sellrelease',
//                );
//                break;
//        }
    }
    
    public function actionRent(){
        $this->redirect(array($this->redirectController['rent']));
    }
    public function actionSell(){
        $this->redirect(array($this->redirectController['sell']));
    }
}