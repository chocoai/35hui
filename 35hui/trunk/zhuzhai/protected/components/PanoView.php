<?php
/**
 * PanoView
 * 展示全景
 * 使用 clickChangePano(panoId [, swfObjectId ])方法可以修改全景
 * @author dcq
 */
class PanoView extends CWidget
{
    /**
     *全景这个object的id。一般不用设置，只有当页面存在多个flash全景的时候，才需要区分
     * @var <type>
     */
    public $swfObjectId = "panoPlayerObject";
    /**
     *主xml文件
     * @var <type>
     */
    public $mainXml = "http://35upload.my360dibiao.com/pano/images.xml";
    /**
     *是否在载人后自动播放
     * @var <type>
     */
    public $autoPlay = true;
    /**
     *如果不自动播放。开始时显示的背景图片
     * @var <type> 
     */
    public $backgroundImg = "";
    /**
     *全景宽度
     * @var <type>
     */
    public $width = 700;
    /**
     *全景宽度
     * @var <type>
     */
    public $height = 400;
    
	public function run(){
        $items = array(
            "swfObjectId"=>$this->swfObjectId,
            "mainXml"=>$this->mainXml,
            "autoPlay"=>$this->autoPlay,
            "backgroundImg"=>$this->backgroundImg,
            "width"=>$this->width,
            "height"=>$this->height,
        );
        $this->render('PanoView',array('items'=>$items));
	}
}