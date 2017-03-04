<?php

class UnormalController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $this->render('view',array(
                'model'=>$this->loadModel(),
        ));
    }


    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        if(Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $normalModel = $this->loadModel();
            $normalUserId = $normalModel->puser_uid;
            $userModel = User::model()->findByPk($normalUserId);

            $path = PIC_PATH."/puser/".$userModel->user_name;
            common::deldir($path);//删除文件夹

            $normalModel->delete();
            $userModel->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            Yii::app()->user->setFlash('deleteResult','个人用户删除成功！');
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    public function actionUnormallogo() {
        $dataProvider=new CActiveDataProvider('Unormal',
           array('criteria'=>array(
                                'condition' => 'puser_logoaudit!="1" and puser_logopath!=""',
           ),
        ));
        $this->render('unormallogo',array(
                'dataProvider'=>$dataProvider,
        ));
    }
    public function actionAuditlogo(){
        $check = (int)$_GET['check'];
        $ucids = explode(',', trim($_GET['id']));
        if( in_array($check, array(1,2)) && $ucids){
            foreach($ucids as $ucid){
                if( ($Unormal = Unormal::model()->findByPk($ucid) ) ){
                    if($check === 1){//通过
                        $Unormal->puser_logoaudit = 1;
                    }else{
                        $Unormal->puser_logoaudit = 2;
                        @ unlink(PIC_URL.$Unormal->puser_logopath);
                        $Unormal->puser_logopath = '';
                    }
                    $Unormal->update();
                }
            }
            echo '1';exit;
        }
        echo '0';exit;
    }
    /**
     * Lists all models.
     */
    public function actionIndex() {
        $loginName = "";
        $criteria=new CDbCriteria();
        if(isset($_POST['search'])) {
            $loginName = $_POST['loginName'];
            $criteria->addSearchCondition("user_name",$loginName);
        }
        $criteria->order = "puser_id desc";
        $criteria->with = "user";
        $dataProvider = new CActiveDataProvider('Unormal',array(
                        'pagination'=>array(
                                'pageSize'=>20,
                        ),
                        'criteria'=>$criteria,
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'loginName'=>$loginName,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Unormal::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

}
