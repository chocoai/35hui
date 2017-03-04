<?php
class ContactrecordController extends Controller
{
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
    public function actionView()
    {
        $this->render('view',array(
            'model'=>$this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Contactrecord;
        $model->cr_type=0;

        if(isset($_POST['Contactrecord']))
        {
            $model->attributes=$_POST['Contactrecord'];
            $salesman=Manageuser::model()->getNameById(Yii::app()->user->id);
            $model->cr_time=  time();
            $model->cr_salesman=  $salesman;
            if($model->save()){
                if($_POST['fr_address']){
                    $frmodel=new Followrecord;
                    $frmodel->fr_crid=$model->cr_id;
                    $frmodel->fr_content='第一次联系';
                    $frmodel->fr_salesman=$salesman;
                    $frmodel->fr_followtime= time();
                    $frmodel->fr_reservetime=$_POST['fr_reservetime'];
                    $frmodel->fr_address=$_POST['fr_address'];
                    $frmodel->save();
                }
                $this->redirect(array('view','id'=>$model->cr_id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate()
    {
        $model=$this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $cr_realname=$model->cr_realname;
        $cr_company=$model->cr_company;
        $cr_district=$model->cr_district;
        $cr_section=$model->cr_section;
        $cr_tel=$model->cr_tel;
        $cr_email=$model->cr_email;

        if(isset($_POST['Contactrecord']))
        {
            $model->attributes=$_POST['Contactrecord'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->cr_id));
        }

        $this->render('update',array(
            'model'=>$model,
            'cr_realname'=>$cr_realname,
            'cr_company'=>$cr_company,
            'cr_district'=>$cr_district,
            'cr_section'=>$cr_section,
            'cr_tel'=>$cr_tel,
            'cr_email'=>$cr_email,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete()
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $id=$_GET['id'];
            $fmodel=Followrecord::model()->findAll('fr_crid='.$id);
            $mmodel=Meetrecord::model()->findAll('mr_crid='.$id);
            $bmodel=Buyrecord::model()->findAll('br_crid='.$id);
            if($fmodel){
                 foreach($fmodel as $value){
                     $dmodel=Followrecord::model()->findByPk($value->fr_id);
                     $dmodel->delete();
                 }
            }
            if($mmodel){
                 foreach($mmodel as $value){
                     $mmodel=Meetrecord::model()->findByPk($value->mr_id);
                     $mmodel->delete();
                 }
            }
            if($bmodel){
                 foreach($bmodel as $value){
                     $bmodel=Buyrecord::model()->findByPk($value->br_id);
                     $bmodel->delete();
                 }
            }
            $this->loadModel()->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $username = "";
        $cr_company = "";
        $district = "";
        if(isset($_GET['username'])){
            $username= trim($_GET['username']);
            if($username){
               $criteria->addSearchCondition("cr_realname",$username);
            }

        }
        if(isset($_GET['cr_company'])){
            $cr_company= trim($_GET['cr_company']);
            if($cr_company){
                $criteria->addSearchCondition("cr_company",$cr_company);
            }

        }
        if(isset($_GET['district'])&&$_GET['district']!=""){
            $district = $_GET['district'];
            if($district){
                $criteria->addColumnCondition(array("cr_district"=>$district));
            }
        }
        $criteria->addColumnCondition(array("cr_isregistered"=>0));
        $criteria->order='cr_time desc';

        $dataProvider=new CActiveDataProvider('Contactrecord',array(
            'criteria'=>$criteria,
        ));

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'username'=>$username,
            'cr_company'=>$cr_company,
            'district'=>$district,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Contactrecord('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Contactrecord']))
            $model->attributes=$_GET['Contactrecord'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel()
    {
        if($this->_model===null)
        {
            if(isset($_GET['id']))
                $this->_model=Contactrecord::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='lxagent-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

     /**
     * 跟进记录列表.
     */
    public function actionFollow()
    {
        $criteria = new CDbCriteria;
        $criteria->condition="fr_crid=".$_GET['id'];
        $criteria->order="fr_followtime desc";
        $dataProvider=new CActiveDataProvider('Followrecord',array(
            'criteria'=>$criteria,
        ));
        $this->render('follow',array(
            'dataProvider'=>$dataProvider,
        ));
    }
     /**
     * 面谈记录列表.
     */
    public function actionMeet()
    {
        $criteria = new CDbCriteria;
        $criteria->condition="mr_crid=".$_GET['id'];
        $criteria->order="mr_time desc";
        $dataProvider=new CActiveDataProvider('Meetrecord',array(
            'criteria'=>$criteria,
        ));

        $this->render('meet',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * 购买记录列表.
     */
    public function actionBuy()
    {
        $criteria = new CDbCriteria;
        $criteria->condition="br_crid=".$_GET['id'];
        $criteria->order="br_time desc";
        $dataProvider=new CActiveDataProvider('Buyrecord',array(
            'criteria'=>$criteria,
        ));
        $this->render('buy',array(
            'dataProvider'=>$dataProvider,
        ));
    }
}
?>
