<?php

class ShowSmallMap extends CWidget
{
    public $x = '121.47536873817444';//显示坐标的X坐标
    public $y = '31.232857675162947';//显示坐标的Y坐标
    public $name = '人民广场';//显示的tip名称
    public $width = '100px';//地图大小
    public $height = '100px';//地图大小

    public $showTip = true;//是否显示弹出tip
    public $searchAddress = "";//如果不知道坐标，就输入这个地址，通过地址来查询坐标
    public $type = "normal";//显示地图类型 normal all
    public $sellorrent = "nh";//当$type为all时需要添加的租售类型 nh新房 1租房 2售房。此参数在查询周边楼盘时使用。
	public function run(){
        $data = array();
        $data['sbi_x'] = $this->x;
        $data['sbi_y'] = $this->y;
        $data['name'] = $this->name;
        $data = json_encode($data);
		$this->render('ShowSmallMap',array(
            'data'=>$data,
            'width'=>$this->width,
            'height'=>$this->height,
            'type'=>$this->type,
            'sellorrent'=>$this->sellorrent,
            'searchAddress'=>$this->searchAddress,
            'showTip'=>$this->showTip,
        ));
	}
}