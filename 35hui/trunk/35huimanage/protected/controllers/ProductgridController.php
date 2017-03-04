<?php

class ProductgridController extends Controller
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
     * Lists all models.
     */
    public function actionIndex() {
        $criteria=new CDbCriteria;
        $p_page = $p_position = 0;
        if(isset($_POST['p_page'])&&$_POST['p_page']!=0) {
            $p_page = $_POST['p_page'];
            $criteria->addColumnCondition(array("p_page"=>$p_page));
        }
        if(isset($_POST['p_position'])&&$_POST['p_position']!=0) {
            $p_position = $_POST['p_position'];
            $criteria->addColumnCondition(array("p_position"=>$p_position));
        }
        $dataProvider=new CActiveDataProvider('Productgrid', array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>20,
                        )
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'p_page'=>$p_page,
                'p_position'=>$p_position
        ));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        $model=$this->loadModel();

		if(isset($_POST['Productgrid']))
		{
			$model->attributes=$_POST['Productgrid'];
			if($model->save()){
                $this->redirect(array('view','id'=>$model->p_id));
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
    }
    public function actionView() {
        $this->render('view',array(
			'model'=>$this->loadModel(),
		));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        if($this->_model===null) {
            if(isset($_GET['id']))
                $this->_model=Productgrid::model()->findbyPk($_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
