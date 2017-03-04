<?php

class RegionController extends Controller
{
	public function actionGetlistByParentid()
	{
        $return = array();
		$parentid = @$_GET["parentid"];
        if($parentid){
            $return = Region::model()->getAllGroupList($parentid);
        }
        echo json_encode($return);exit;
	}
}