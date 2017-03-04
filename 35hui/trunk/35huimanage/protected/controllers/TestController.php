<?php

class TestController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionUpdateCoordinate(){
        $this->render('updatecoordinate',array(
               
        ));
    }
    public function actionGetCoordinate(){
        $sql = "select sbi_buildingid id ,sbi_buildingname name,sbi_x x, sbi_y y from 35_systembuildinginfo";
       
        $dba = dba();
        $data = $dba->select($sql);
        echo json_encode($data);
        
    }
    public function actionUpdateById(){
        if(isset($_POST['id'])&&$_POST['id']){
            $model = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingid"=>$_POST['id']));
            if(isset($_POST['x'])&&isset($_POST['y'])&&$_POST['x']&&$_POST['y'])
            {
                $model->sbi_x=$_POST['x'];
                $model->sbi_y=$_POST['y'];
                if($model->save()){
                    echo "修改成功";
                }
            }
        }
    }
    public function actionWriteBook(){
        $fp=fopen("updatebook.txt",'a');
        fwrite($fp,$_POST["data"]);
        fclose($fp);
        echo "写入成功";
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}