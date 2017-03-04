<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController
{
    public $layout = "frame";
	/**
	 * Index action is the default action in a controller.
	 */
	public function actionIndex(){
        $this->render("index",array(
            "swfObjectId"=>@$_GET["swfObjectId"],
        ));
	}
	public function actionFrame(){
        if(isset($_GET["panoId"])){
            $this->render("frame",array(
                "panoId"=>$_GET["panoId"],
            ));
        }
    }
    
    public function actionError(){
        if($error=Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    public function actionPanoPreView(){
        $panoId = $_GET['panoId'];
        $start_pan = isset($_GET["start_pan"])?$_GET["start_pan"]:0;
        $start_tilt = isset($_GET["start_tilt"])?$_GET["start_tilt"]:0;
        $start_fov = isset($_GET["start_fov"])?$_GET["start_fov"]:80;

        $min_pan = isset($_GET["min_pan"])?$_GET["min_pan"]:0;
        $min_tilt = isset($_GET["min_tilt"])?$_GET["min_tilt"]:-90;
        $min_fov = isset($_GET["min_fov"])?$_GET["min_fov"]:5;

        $max_pan = isset($_GET["max_pan"])?$_GET["max_pan"]:360;
        $max_tilt = isset($_GET["max_tilt"])?$_GET["max_tilt"]:90;
        $max_fov = isset($_GET["max_fov"])?$_GET["max_fov"]:120;
        
        $panorama = '<panorama><view fovmode="0">';
        $panorama .='<start pan="'.$start_pan.'" tilt="'.$start_tilt.'" fov="'.$start_fov.'"/>';
        $panorama .='<min pan="'.$min_pan.'" tilt="'.$min_tilt.'" fov="'.$min_fov.'"/>';
        $panorama .='<max pan="'.$max_pan.'" tilt="'.$max_tilt.'" fov="'.$max_fov.'"/>';

        $panorama .='</view><display width="512" height="512" quality="9" changemotionquality="1" changestagequality="0" smoothing="1" fullscreenmenu="0" custommenutext="" custommenulink="" scalemode="stage" scaletofit="1" /><input ';

        $panorama .='tile0url="/dyfwpano/'.$panoId.'/1.jpg" ';
        $panorama .='tile1url="/dyfwpano/'.$panoId.'/2.jpg" ';
        $panorama .='tile2url="/dyfwpano/'.$panoId.'/3.jpg" ';
        $panorama .='tile3url="/dyfwpano/'.$panoId.'/4.jpg" ';
        $panorama .='tile4url="/dyfwpano/'.$panoId.'/5.jpg" ';
        $panorama .='tile5url="/dyfwpano/'.$panoId.'/6.jpg" ';

        $panorama .='tilesize="512" cylinder="2" ></input></panorama>';
        $this->render("panopreview",array(
            "panorama"=>$panorama,
            "start_pan"=>$start_pan,
            "start_tilt"=>$start_tilt,
            "start_fov"=>$start_fov,
        ));
    }
}