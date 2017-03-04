<?php $rightwidth="130px";
      $mapwidth=substr($width,"0",strpos($width,"px"))-140;
      $mapheight=substr($height,"0",strpos($height,"px"))+50;
      ?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<div style="width:<?=$mapwidth?>px;height:<?=$mapheight?>px;" id="container"></div>
<style type="text/css">
.loupaninfo_threelineboxthree {	width: <?=$rightwidth?>;float: left;background:url(/images/loupan.gif) no-repeat 30px -870px;position:absolute;top:40px;right:0px;}
.loupaninfo_threelineboxthree dl {margin-top: 0px;float: left;}
.loupaninfo_threelineboxthree dd {height:18px;	line-height:18px;	overflow:hidden;	margin-top:12px;margin-left: 10px}
.loupaninfo_threelineboxthree dd input {vertical-align:middle;	margin:0 37px 0 0px;	width:13px;	height:13px;	overflow:hidden;}
</style>
<script type="text/javascript">
    //设置标签样式
var style=[{background:"#0099FF",borderColor:"#0099FF",color:"#fff",cursor:"pointer",padding:"3px"},
            {background:"#CC6633",borderColor:"#CC6633",color:"#000",cursor:"pointer"},]
document.domain = "<?=JS_DOMAIN?>";
var zoom = 17;
var checkbox;//当前选中的复选框值 1周边小区 2银行 3餐饮 4超市 5 交通
var sellorrent = "";
var searchAddress = ""
var data =  "";

$(document).ready(function(){
    var parent = $("#framevalue", window.parent.document);
    data = eval("("+parent.children("#framevalue_data").html()+")");
    searchAddress = parent.children("#framevalue_searchAddress").html();
    sellorrent = parent.children("#framevalue_sellorrent").html();
    window.map = new BMap.Map("container");
    var point=new BMap.Point(data.sbi_x,data.sbi_y);
    map.centerAndZoom(point,zoom);
    map.setCurrentCity("上海"); 
    map.setMinZoom(zoom);
    var NavigationControl=new BMap.NavigationControl()
    map.addControl(NavigationControl);       //添加鱼骨缩放空间
    NavigationControl.setType(BMAP_NAVIGATION_CONTROL_ZOOM);
    map.addControl(new BMap.MapTypeControl());          //添加地图类型控件
    map.enableScrollWheelZoom();//启用滚轮缩放大小
    if(searchAddress!=""){
        addSearchAddress();
    }else{
        addJumpMarker();
    }
});
function addSearchAddress(){
     // 创建地址解析器实例
    var myGeo = new BMap.Geocoder();
    // 将地址解析结果显示在地图上,并调整地图视野
    myGeo.getPoint(searchAddress, function (point){
      if(point) {
            map.centerAndZoom(point, 16);
            addJumpMarker(point);
      }else{
            var leftmap=$(".left_map",window.parent.document);
            if(leftmap.html()){
                leftmap.prev("div").attr("style","display:none");
                leftmap.attr("style","display:none");
            }
      }
    }, "上海市");
    
     
}
//添加跳动标注
function addJumpMarker(point){
    if(!point){
         var point=new BMap.Point(data.sbi_x,data.sbi_y);
    }
    var marker = new BMap.Marker(point);  // 创建标注
    map.addOverlay(marker);              // 将标注添加到地图中
    marker.disableMassClear();
    var label = new BMap.Label(data.name,{"offset":new BMap.Size(25,-40)});
    marker.setLabel(label);
    label.setStyle(style[0]);
    label.hide();
    marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    (function(){
            var _label = label;
            marker.addEventListener("mouseover",function(){
                   _label.show();
            });
            marker.addEventListener("mouseout",function(){
                   _label.hide();
            });
    })()
}
//添加标注
function addMarkers(data){
    map.clearOverlays();
    var bounds = map.getBounds();
	minX=bounds.getSouthWest()["lng"];
	minY=bounds.getSouthWest()["lat"];
	maxX=bounds.getNorthEast()["lng"];
	maxY=bounds.getNorthEast()["lat"];
    var parent = $("#framevalue", window.parent.document);
    var newdata = eval("("+parent.children("#framevalue_data").html()+")");
    var num=0;
    for(i=0;i<data.length;i++){
              var json=data[i];
              var p0 = json["x"];
              var p1 = json["y"];
              if(p0>minX&&p0<maxX&&p1>minY&&p1<maxY&&p0!==newdata.sbi_x&&p1!==newdata.sbi_y){
                    num++;
                    var point = new BMap.Point(p0,p1);
                    var iconImg = createIcon();
                    var marker = new BMap.Marker(point,{icon:iconImg});
                    var label = new BMap.Label(json.sbi_buildingname,{"offset":new BMap.Size(0,-18)});
                    marker.setLabel(label);
                    map.addOverlay(marker);
                    label.setStyle(style[0]);
                    (function(){
                            var _json = json;
                            var _marker = marker;
                            var html="<?=DOMAIN.Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>"buildingid"))?>";
                            var html= html.replace("buildingid",_json.buildingid );
                            _marker.addEventListener("click",function(){
                                window.open(html);
                            });
                            label.addEventListener("click",function(){
                                 window.open(html);
                            });
                            label.addEventListener("mouseover",function(){
                                iconImg.setImageOffset(new BMap.Size(0,-0));
                                 _marker.setIcon(iconImg);
                                _marker.setZIndex(100)
                                this.setStyle(style[1]);
                            });
                            label.addEventListener("mouseout",function(){
                                iconImg.setImageOffset(new BMap.Size(0,-20));
                                _marker.setIcon(iconImg);
                                this.setStyle(style[0]);
                                _marker.setZIndex(80)
                            });
                      })()
                 }
        }
        

}
function goback(){
    map.centerAndZoom(new BMap.Point(data.sbi_x,data.sbi_y),zoom);
}
////判断是否属于新房
function checkNewHouse(sellorrent){
    if(sellorrent=="nh"){
        return true;
    }else{
        return false;
    }
}
//搜索
function searchByType(obj){
    if(obj.checked){
    $(".check").attr("checked",false);
    $(obj).attr("checked","checked");
    checkbox = $(obj).val();
    map.addEventListener("dragend",function(){if(obj.checked){searchDataFirst();}});
    map.addEventListener("zoomend",function(){if(obj.checked){searchDataFirst();}});
    searchDataFirst();
    }else{
    map.clearOverlays();
    }
    
 
}
//根据选择加载点
function searchDataFirst(){
    var kwd ="";
    if(checkbox==2){
        kwd="银行";
    }else if(checkbox==3){
        kwd = "餐饮";
    }else if(checkbox==4){
        kwd = "超市";
    }else if(checkbox==5){
        kwd = "公交车站";
    }
    if(kwd!=""){
         map.clearOverlays();//清除地图上的覆盖物
        var local = new BMap.LocalSearch(map,{ renderOptions:{map: map,selectFirstResult:false,autoViewport:false}});
        local.searchInBounds(kwd, map.getBounds());
    }else{//为空表示是要查询小区。
        var gg=map.getBounds();
        var swX =gg._swLng;//西南X
        var swY =gg._swLat;//西南Y
        var neX =gg._neLng;//东北X
        var neY =gg._neLat;//东北Y
        //alert(swX+"\n"+swY+"\n"+neX+"\n"+neY);
        var newmsg = "";
        if(checkNewHouse(sellorrent)){
            $.ajax({
                url:"/map/otheroffice",
                data:"swX="+swX+"&swY="+swY+"&neX="+neX+"&neY="+neY+"&price=0-0&type=1&where=smallMap&zoom="+zoom,
                type:"POST",
                async:false,
                success:function(msg){
                    if(msg!=""){
                        newmsg = eval("("+ msg +")");
                    }
                }
            });
        }else{
            alert("暂时只有新房才能有大地图");
        }
        addMarkers(newmsg);
    }
}
function createIcon(){
        var icon = new BMap.Icon("http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png", new BMap.Size(15,10),{imageOffset: new BMap.Size(0,-20),infoWindowAnchor:new BMap.Size(0,11),offset:new BMap.Size(6,21)})
        return icon;
}
</script>
<?php
    if($type=="normal"){
    ?>
        <div id="map" style="width: <?=$width?>;height: <?=$height;?>">
            <input type="button" value="返回小区" onclick="goback()" style="position:absolute;top:18px;right:30px; width: 70px; height: 22px; border: 1px solid gray; background:#fff;"/>
    </div>
    <?php
    }else{
    ?>
<div style="width: <?=$width?>;height: <?=$height;?>">
    <div id="map" style="width: <?=$width-$rightwidth?>px;height: <?=$height;?>; float:left">
        <input type="button" value="返回小区" onclick="goback()" style="position:absolute;top:18px;right:30px; width: 70px; height: 22px; border: 1px solid gray; background:#fff;"/>
    </div>
    <div class="loupaninfo_threelineboxthree">
        <dl>
            <dd><input type="checkbox" name="checkbox" value="1" onClick="searchByType(this)" class="check" id="xq"/><label for="xq">周边楼盘</label></dd>
            <dd><input type="checkbox" name="checkbox" value="2" onClick="searchByType(this)" class="check" id="yh"/><label for="yh">银行</label></dd>
            <dd><input type="checkbox" name="checkbox" value="3" onClick="searchByType(this)" class="check" id="cy"/><label for="cy">餐饮</label></dd>
            <dd><input type="checkbox" name="checkbox" value="4" onClick="searchByType(this)" class="check" id="cs"/><label for="cs">超市</label></dd>
            <dd><input type="checkbox" name="checkbox" value="5" onClick="searchByType(this)" class="check" id="jt"/><label for="jt">公交</label></dd>
        </dl>
    </div>
</div>
    <?php
    }
?>

