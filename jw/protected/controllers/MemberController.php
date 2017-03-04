<?php

class MemberController extends Controller
{
    public $layout='main';
    
    public function actionList()
    {
        $get = SearchMenu::explodeAllParamsToArray();//获取所有参数
        $criteria=new CDbCriteria;
        /*公司类型*/
        if(isset($get["type"])){//类型
            if($get["type"]==0){//个人
                $criteria->addColumnCondition(array("mem_company"=>0));
            }else{//有公司
                $newCriteria=new CDbCriteria;
                $newCriteria->select = "cm_id";
                $newCriteria->addColumnCondition(array("cm_companytype"=>$get["type"]));
                $idArr = array();
                $com = Companymanage::model()->findAll($newCriteria);
                foreach($com as $value){
                    $idArr[] = $value->cm_id;
                }
                $criteria->addInCondition("mem_company",$idArr);
            }
        }
        /*区 要飞公司还是个人来不同的进行搜索*/
        if(isset($get["district"])){
            if(!isset($get["type"])||$get["type"]==0){//个人情况，就搜住址
                $criteria->join .= " left join {{user}} on {{user}}.u_id=mem_userid ";
                $criteria->addColumnCondition(array("u_district"=>$get["district"]));
                if(isset($get["section"])){
                    $criteria->addColumnCondition(array("u_section"=>$get["section"]));
                }
            }else{//公司情况
                //如果有选择特定的公司，则直接搜公司
                if(isset($get["company"])){
                    $criteria->addColumnCondition(array("mem_company"=>$get["company"]));
                }else{//没有选择公司，则要获取区域下所有的公司
                    $newCriteria=new CDbCriteria;
                    $newCriteria->select = "cm_id";
                    $newCriteria->addColumnCondition(array("cm_district"=>$get["district"]));
                    $idArr = array();
                    $com = Companymanage::model()->findAll($newCriteria);
                    foreach($com as $value){
                        $idArr[] = $value->cm_id;
                    }
                    $criteria->addInCondition("mem_company",$idArr);
                }
            }
        }
        /*级别*/
        if(isset($get["level"])){
            $levelModel = Memberlevel::model()->findByPk($get["level"]);
            if($levelModel){
                $criteria->addCondition("mem_redboard>=".$levelModel->ml_redboards);
                //查看封顶的值
                $newCriteria=new CDbCriteria;
                $newCriteria->order = "ml_redboards";
                $newCriteria->select = "ml_redboards";
                $newCriteria->addCondition("ml_redboards>".$levelModel->ml_redboards);
                $endLevelModel = Memberlevel::model()->find($newCriteria);
                if($endLevelModel){
                    $criteria->addCondition("mem_redboard<".$endLevelModel->ml_redboards);
                }
            }
        }
        /*排序*/
        $criteria->order = "mem_todayredboard desc";
        if(isset($get["order"])){
            switch ($get["order"]){
                case 1://今日
                    $criteria->order = "mem_todayredboard desc";
                    break;
                case 2://本周
                    $criteria->order = "mem_weekredboard desc";
                    break;
                case 3://本月
                    $criteria->order = "mem_monthredboard desc";
                    break;
            }
        }
        $dataProvider =  new CActiveDataProvider("Member", array(
                        'criteria'=>$criteria,
                        'pagination'=>array(
                                'pageSize'=>12,
                        ),

        ));
		$this->render('list',array(
            "dataProvider"=>$dataProvider
        ));
    }
}