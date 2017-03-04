<?php

class CompanymanageController extends Controller
{
	public function actionGetCompanyName()
	{
        $return = array();
		$district = @$_GET["district"];
        if($district){
            $return = Companymanage::model()->getAllCompanyList($district);
        }
        echo json_encode($return);exit;
	}
    public function actiongetCompanyaddress(){
        $id = $_POST["company"];
        $return = "";
        $model = Companymanage::model()->findByPk($id);
        if($model){
            $return = $model->cm_address;
        }
        echo $return;exit;
    }
}