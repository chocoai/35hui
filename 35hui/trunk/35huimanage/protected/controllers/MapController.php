<?php

class MapController extends Controller
{
    public $layout='//layouts/column2';
    
	public function actionIndex()
	{
//		$this->render('index');
	}
    public function actionFrameMap(){
        $this->layout = "frame";
        $x = isset($_GET['x'])?urldecode($_GET['x']):"121.4769358";
        $y = isset($_GET['y'])?urldecode($_GET['y']):"31.2294078";
        $name = isset($_GET['name'])?urldecode($_GET['name']):"人民广场";

        $isNew = isset($_GET['x'])?false:true;
        $this->render('framemap',array(
            "x"=>$x,
            "y"=>$y,
            "name"=>$name,
            'isNew'=>$isNew,
        ));
    }
    public function actionFrameMapCommunity(){
        $this->layout = "frame";
        $x = isset($_GET['x'])?urldecode($_GET['x']):"121.4769358";
        $y = isset($_GET['y'])?urldecode($_GET['y']):"31.2294078";
        $name = isset($_GET['name'])?urldecode($_GET['name']):"人民广场";

        $isNew = isset($_GET['x'])?false:true;
        $this->render('framemapcommunity',array(
            "x"=>$x,
            "y"=>$y,
            "name"=>$name,
            'isNew'=>$isNew,
        ));
    }
}