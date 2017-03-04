<?php

class Test188Controller extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
     
    public function actionAddDFL(){
        $logFile = $_SERVER['DOCUMENT_ROOT']."/protected/messages/adddfl.log";//日志文件
        $SuccessNum=0;
        $failureNum=0;
        $failureID="";
        $criteria=new CDbCriteria;
        $criteria->select="sbi_buildingid,sbi_defanglv";
        $model=Systembuildinginfo::model()->findAll($criteria);
        foreach($model as $val){
            if(!$val->sbi_defanglv){
                $buildid=$val->sbi_buildingid;
                $val->sbi_defanglv=mt_rand(65,78);
                if($val->update()){
                $SuccessNum++;
                }else{
                    $failureNum++;
                    $failureID.="[".$buildid."] ,";
                }
            }
            
        }
        //写日志文件
        if (!$handle = fopen($logFile, 'a')) {
            exit;
        }
        $time = time();
        $logContent = date("Y-m-d H:i:s",$time)."\n";
        $str = "";

        $logContent .="本次更新成功：".$SuccessNum."条；更新失败：".$failureNum."条\n";
        $logContent .= "失败ID".$failureID."\n\n";
        $logContent .= "##################################\n\n";
        if (fwrite($handle, $logContent) === FALSE) {
            exit;
        }else{
           echo "日志文件写入成功";
        }
         fclose($handle);
        //写日志结束
    }
}