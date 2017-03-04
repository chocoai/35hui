<?php
Yii::import('application.extensions.*');
Yii::import('application.common.*');
require 'simple_html_dom.php';
require_once('image.php');
class DyfwController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    public function actionDownload() {
        $dname = isset($_POST['name'])?trim($_POST['name']):'全景附件';
        if(! empty($_POST['panoId']) ) {
            $panoId = trim($_POST['panoId']);
        }else{
            exit(0);
        }
            
        $path = PIC_PATH.'/dyfwpano/';

        $start_pan = isset($_POST["start_pan"])?$_POST["start_pan"]:0;
        $start_tilt = isset($_POST["start_tilt"])?$_POST["start_tilt"]:0;
        $start_fov = isset($_POST["start_fov"])?$_POST["start_fov"]:80;

        $min_pan = isset($_POST["min_pan"])?$_POST["min_pan"]:0;
        $min_tilt = isset($_POST["min_tilt"])?$_POST["min_tilt"]:-90;
        $min_fov = isset($_POST["min_fov"])?$_POST["min_fov"]:5;

        $max_pan = isset($_POST["max_pan"])?$_POST["max_pan"]:360;
        $max_tilt = isset($_POST["max_tilt"])?$_POST["max_tilt"]:90;
        $max_fov = isset($_POST["max_fov"])?$_POST["max_fov"]:120;

        //增加parameter.xml文件

        $str = '<?xml version="1.0" encoding="UTF-8" ?><panoramadate><panorama><view fovmode="0">';

        $str .='<start pan="'.$start_pan.'" tilt="'.$start_tilt.'" fov="'.$start_fov.'"/>';
        $str .='<min pan="'.$min_pan.'" tilt="'.$min_tilt.'" fov="'.$min_fov.'"/>';
        $str .='<max pan="'.$max_pan.'" tilt="'.$max_tilt.'" fov="'.$max_fov.'"/>';
        
        $str .='</view><display width="512" height="512" quality="9" changemotionquality="1" changestagequality="0" smoothing="1" fullscreenmenu="0" custommenutext="" custommenulink="" scalemode="stage" scaletofit="1" />';
        $str .='<input tile0url="1.jpg" tile1url="2.jpg" tile2url="3.jpg" tile3url="4.jpg" tile4url="5.jpg" tile5url="6.jpg" tilesize="512" cylinder="2" ></input><cursor ownonmovement="1" ownondefault="1" /></panorama></panoramadate>';

        $fp = fopen($path.$panoId.'/parameter.xml', "w+");
        fputs($fp,$str);//向文件中写入内容;
        fclose($fp);
        
        //判断是否增加水印
        if(isset($_POST["picMask"])&&$_POST["picMask"]==1){
            $imageDeal = new Image();
            $imageDeal->panoMask($path.$panoId."/5.jpg", $_SERVER['DOCUMENT_ROOT']."/images/panoMask.png",$path.$panoId."/5.jpg");
        }
        //创建压缩文件
        $zip = new PHPZip();
        $zip->downloadZip($path.$panoId, $dname.'.rar');
        
    }
    public function actionIndex() {
        $pano_arr = array();
        if( ! empty($_GET['panourl']) ) {
            $panourl = trim($_GET['panourl']);
            $md5panourl = md5($panourl);
            if( ! isset($_SESSION[$md5panourl]) ) {
                $config = '';
                if( ($html = file_get_contents($panourl) ) ) {
                    preg_match("'fuYeFlashInit\((.*?)\)'", $html, $matches);
                    if( isset($matches[1]) )
                        $config = 'http://roompano.diyifangwu.com/panolib/'.str_replace(',', '-', $matches[1]).'.xml';
                    else
                        exit(0);
                }
                if(empty($config)) exit('No configfile.');

                $dom = file_get_dom($config);
                $thumbnailSet = $dom->find('thumbnailSet', 0);
                $idx = 0;
                foreach($thumbnailSet->find('thumbnail') as $thumbnail) {
                    $pano_arr[$idx]['type'] = $thumbnail->children(0)->plaintext;//plaintext innertext
                    foreach ($thumbnail->children(1)->find('item') as $item) {
                        $itemarr = array();
                        $itemarr['imgPath'] = $item->children(0)->plaintext;
                        $itemarr['name'] = $item->children(1)->plaintext;
                        $itemarr['panoId'] = $item->children(4)->plaintext;
                        $pano_arr[$idx][] = $itemarr;
                    }
                    $idx++;
                }
                $_SESSION[$md5panourl] = serialize($pano_arr);
                //configinfo
                $hotspotSet = $dom->find('hotspotSet', 0);
                foreach($hotspotSet->find('hotspot') as $hotspots) {
                    $temp = $panoid = '';
                    foreach($hotspots->children() as $hotspot){
                        if($hotspot->tag == 'panoid')
                            $panoid = $hotspot->plaintext;
                        $temp .= $hotspot->tag.':'.$hotspot->plaintext."\r\n";
                    }
                    $_SESSION['hotspotSet'][$panoid] = $temp;//plaintext innertext
                }
            }else{
                $pano_arr = unserialize($_SESSION[$md5panourl]);
            }
        }
        $this->render('index',array(
                'pano_arr'=>$pano_arr,
        ));
    }
    public function actionPreview(){
        $panoId = $_GET["panoid"];
        $name = $_GET["dname"];
        $path = PIC_PATH.'/dyfwpano/';
        if(is_dir($path.$panoId)){//删除旧文件夹
            common::deldir($path.$panoId);
        }
        mkdir($path.$panoId);
        $imgurl = 'http://pic.diyifangwu.com/panolib/'.$panoId.'/n/';
        $i = 6;
        while($i--) {
            $ii = (string)($i+1);
            $imgurl2 = $imgurl.$ii.'.jpg';
            if( ($imgData = file_get_contents($imgurl2)) ) {
                file_put_contents($path.$panoId.'/'.$ii.'.jpg', $imgData);
            }
        }
        
        $defaultParama = array(
            "start_pan"=>0,
            "start_tilt"=>0,
            "start_fov"=>80,

            "min_pan"=>0,
            "min_tilt"=>-30,
            "min_fov"=>5,

            "max_pan"=>360,
            "max_tilt"=>90,
            "max_fov"=>120,
        );
        $this->render('preview',array(
            "defaultParama"=>$defaultParama,
            "panoId"=>$panoId,
            "name"=>$name,
        ));
    }

}
