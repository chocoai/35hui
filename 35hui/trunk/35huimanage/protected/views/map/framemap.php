<div id="container" style="width:700px;height: 430px"></div>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<script type="text/javascript">
var mapObj;
var markerOption_x = "<?=$x?>";//地图覆盖物的x坐标
var markerOption_y = "<?=$y?>";//地图覆盖物的y坐标
var markerOption_content = "<?=$name?>";//默认地址
$(document).ready(function(){
        window.map = new BMap.Map("container");
        var point=new BMap.Point(121.51223031865,31.240901955084);
        map.centerAndZoom(point,12);
        map.enableScrollWheelZoom();
        map.setCurrentCity("上海");          // 设置地图显示的城市 此项是必须设置的
        map.addControl(new BMap.NavigationControl());       //添加鱼骨缩放空间
        map.addControl(new BMap.MapTypeControl());          //添加地图类型控件
        addMarker(point);
    <?php
    if(!$isNew){
    ?>
            
    var point=new BMap.Point(<?=$x?>,<?=$y?>);
    
    addMarker(point)
    <?php
    }
    ?>
});
//根据名称获得坐标
function geocodeSearch(addressName){
    if(addressName== ""){
        alert("请输入地址！");
        return;
    }else{
        var myGeo = new BMap.Geocoder();
        // 将地址解析结果显示在地图上,并调整地图视野
        myGeo.getPoint(addressName, function(point){
          if (point) {
            map.setZoom(17)
            addMarker(point);
          }else{
                alert('地址未找到！');
          }
        }, "上海市");
    }
}
//添加标注点
function addMarker(point){
            map.panTo(point);
            map.clearOverlays();
            var marker = new BMap.Marker(point,{raiseOnDrag:true});  // 创建标注
            map.addOverlay(marker);              // 将标注添加到地图中
            marker.enableDragging();;
            map.addOverlay(marker);
            getXY();
            marker.addEventListener("dragend",function(){getXY();});
}
//地图坐标输入框信息内容更新
function getXY(){
    var mark101= map.getOverlays();
    var x = mark101[0]["point"].lng;
    var y = mark101[0]["point"].lat;
    window.parent.setLocalXY(x,y);
}
</script>