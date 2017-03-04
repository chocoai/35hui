<?php

class Test2Controller extends Controller
{
	public function actionIndex()
	{
        $cc="";
        if(isset($_GET["start"])&&$_GET["start"]=="coby"){
            $model=  Uagent::model()->findAll();
            for($i=0;$i<count($model);$i++){
               if($model[$i]->ua_combo){
                   $newModel[]=$model[$i];
               }
            }
            foreach($newModel as $key=>$val){
                   $content=Combo::model()->findByPk($val->ua_combo);
                   $starttime=$val->ua_combotime;
                   $combolog=new Combolog;
                   $time=time();
                   for($i=0;$i<20;$i++){
                        if($starttime<$time){
                            break;
                        }
                        $starttime -=3600*24*30;
                   }
                  $muid=$val->ua_muid?$val->ua_muid:"";
                  $combolog->attributes=array("cbl_uid"=>$val->ua_uid,"cbl_content"=>$content->cb_name,"cbl_starttime"=>$starttime,"cbl_endtime"=>$val->ua_combotime,"cbl_muid"=>$muid);
                  if($combolog->save()){
                      $cc.= "写入成功<br/>";
                  }else{
                     $cc.= "写入失败<br/>";
                  }

            }
        }
		$this->render('index',array(
            "content"=>$cc
        ));
	
    }
    public function actionCopy()
	{
        $cc="";
        
            $model=  Uagent::model()->findAll();
            for($i=0;$i<count($model);$i++){
               if($model[$i]->ua_combo){
                   $newModel[]=$model[$i];
               }
            }
            foreach($newModel as $key=>$val){
                   $content=Combo::model()->findByPk($val->ua_combo);
                   $starttime=$val->ua_combotime;
                   $combolog=new Combolog;
                   $time=time();
                   for($i=0;$i<20;$i++){
                        if($starttime<$time){
                            break;
                        }
                        $starttime -=3600*24*30;
                   }
                  $muid=$val->ua_muid?$val->ua_muid:"";
                  $combolog->attributes=array("cbl_uid"=>$val->ua_uid,"cbl_content"=>$content->cb_name,"cbl_starttime"=>$starttime,"cbl_endtime"=>$val->ua_combotime,"cbl_muid"=>$muid);
                  if($combolog->save()){
                      $cc.= "写入成功<br/>";
                  }else{
                     $cc.= "写入失败<br/>";
                  }

            }
        
		$this->render('index2',array(
            "content"=>$cc
        ));

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