<div id="map" style="width:100%;height: 400px"></div>
<script type="text/javascript" src="http://app.mapabc.com/apis?&t=flashmap&v=2.3.4&key=<?php echo Yii::app()->params['mapkey']?>"></script>
<script type="text/javascript">
var mapObj;
var markerOption_x = "<?=$x?>";//地图覆盖物的x坐标
var markerOption_y = "<?=$y?>";//地图覆盖物的y坐标
var markerOption_content = "<?=$name?>";//默认地址
$(document).ready(function(){
    var mapoption = new MMapOptions();
    mapoption.mapComButton = 'hide';//不显示新增商铺按钮
    mapoption.toolbar = MINI; //设置地图初始化工具条，ROUND:新版圆工具条
    mapoption.overviewMap = HIDE; //设置鹰眼地图的状态，SHOW:显示，HIDE:隐藏（默认）
    mapoption.scale = HIDE; //设置地图初始化比例尺状态，SHOW:显示（默认），HIDE:隐藏。
    mapoption.zoom = 13;//要加载的地图的缩放级别
    mapoption.center = new MLngLat(markerOption_x,markerOption_y);//要加载的地图的中心点经纬度坐标
    mapoption.language = MAP_CN;//设置地图类型，MAP_CN:中文地图（默认），MAP_EN:英文地图
    mapoption.fullScreenButton = HIDE;//设置是否显示全屏按钮，SHOW:显示（默认），HIDE:隐藏
    mapoption.centerCross = HIDE;//设置是否在地图上显示中心十字,SHOW:显示（默认），HIDE:隐藏
    mapoption.toolbarPos=new MPoint(2,5); //设置工具条在地图上的显示位置
    mapObj = new MMap("map", mapoption); //地图初始化
    mapObj.addEventListener(mapObj,DRAG_END,getXY);
    <?php
    if(!$isNew){
    ?>
   addPoint(<?=$x?>,<?=$y?>,"<?=$name?>");
    <?php
    }
    ?>
});
function geocodeSearch(){
    var address = window.parent.document.getElementById("Communitybaseinfo_comy_name");
    var addressName = address.value;
    if(addressName== ""){
        alert("请输入地址！");
        return;
    }else{
        var mls =new MLocalSearch();
        var mlsp= new MLocalSearchOptions();
        mls.setCallbackFunction(addMarker);
        mls.poiSearchByKeywords(addressName,021,mlsp);
    }
}

function addMarker(data){
    if(data.poilist.length>0){
        markerOption_x = data.poilist[0].x;//地图覆盖物的x坐标
        markerOption_y = data.poilist[0].y;//地图覆盖物的y坐标
        markerOption_content = data.poilist[0].name;
    }else{
        alert('地址未找到！');
    }
    addPoint(markerOption_x,markerOption_y,markerOption_content);
    getXY();
}
function addPoint(point_x,point_y,point_content){
    var tipOption=new MTipOptions();//添加信息窗口
    tipOption.content= point_content;//信息窗口内容
    //构建一个名为markerOption的点选项对象。
    var markerOption = new MMarkerOptions();
    //标注图片或SWF的url，默认为蓝色气球图片
    markerOption.imageUrl="http://code.mapabc.com/images/lan_1.png";
    //设置图片相对于加点经纬度坐标的位置。九宫格位置。默认BOTTOM_CENTER代表正下方
    markerOption.imageAlign=BOTTOM_CENTER;
    //标注左上角相对于图片中下部的锚点。Label左上角与图片中下部重合时，记为像素坐标原点(0,0)。
    markerOption.labelPosition=new MPoint(10,10);
    //拖动结束后是否有弹跳效果,ture，有弹跳效果；false，没有弹跳效果（默认）
    //当有弹跳效果的时候，marker的imageAlign属性必须为BOTTOM_CENTER，否则弹跳效果显示不正确
    markerOption.isBounce=true;
    //设置点是否为可编辑状态,rue，可以编辑；   false，不可编辑（默认）
    markerOption.isEditable=true;
    //设置点的信息窗口参数选项
    markerOption.tipOption = tipOption;
    //是否在地图中显示信息窗口，true，可以显示（默认）；false，不显示
    markerOption.canShowTip= true;
    //是否显示阴影，默认为true，即有阴影
    markerOption.hasShadow=true;
    //是否使用图片代理形式
    //如果imageUrl属性的图片资源所在域名下没有crossdomain.xml，则需要用代理形式添加该图片资源
    markerOption.picAgent=true;
    //设置点是否高亮显示
    //设置高亮显示与设置可编辑有冲突，只能设置一个，不能同时设置。
    markerOption.isDimorphic=true;
    //设置第二种状态的颜色，默认为0xFF0000，即红色
    markerOption.dimorphicColor="0x00A0FF";
    //通过经纬度坐标及参数选项确定标注信息
    Mmarker = new MMarker(new MLngLat(point_x,point_y),markerOption);
    //对象编号，也是对象的唯一标识
    Mmarker.id="mark101";
    //向地图添加覆盖物
    mapObj.addOverlay(Mmarker,true) ;
}
function getXY(){
    var mark101= mapObj.getOverlayById("mark101");
    var x = mark101.lnglat.lngX;
    var y = mark101.lnglat.latY;
    window.parent.document.getElementById("Communitybaseinfo_comy_x").value = x;
    window.parent.document.getElementById("Communitybaseinfo_comy_y").value = y;
}
</script>