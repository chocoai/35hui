
//标注点数组
    var defaultKeyword = "请输入地域名或楼盘全称";
//设置标签样式
    var style=[{background:"#0099FF",borderColor:"#0099FF",color:"#fff",cursor:"pointer",padding:"3px"},
           {background:"#CC6633",borderColor:"#CC6633",color:"#000",cursor:"pointer"},]
//创建和初始化地图函数：
    function initMap(x,y){
            window.map = new BMap.Map("container");
            map.centerAndZoom(new BMap.Point(x,y),15);
            map.enableScrollWheelZoom();
            map.setCurrentCity("上海");          // 设置地图显示的城市 此项是必须设置的
            map.addControl(new BMap.NavigationControl());       //添加鱼骨缩放空间
            map.addControl(new BMap.MapTypeControl());          //添加地图类型控件
            map.addControl(new BMap.NavigationControl());               // 添加平移缩放控件
            map.addControl(new BMap.ScaleControl());                    // 添加比例尺控件
            //map.addControl(new BMap.OverviewMapControl());              //添加缩略地图控件
            map.setMinZoom(12);
            window.searchClass = new SearchClass();
            changeDatas()
            map.addEventListener("zoomend",function(){changeDatas();});//增加改变地图缩放级别后的触发事件
            map.addEventListener("dragend",function(){changeDatas();});//增加地图拖拽移动后的触发事件
            map.addEventListener("movestart",function(){closeInfo();});//增加地图移动时触发事件
    }

//根据关键字搜索匹配信息
    window.searchBykeyword = function(){
        clearMarker();
        var keyword=document.getElementById("exact").value;
        if(keyword==defaultKeyword){
        alert("请输入地域名或楼盘全称");
        return false;
        }
        var dd = searchClass.search({k:"sbi_buildingname",d:keyword,t:"more",s:""});
        if(dd.length!==0){
            map.panTo(new BMap.Point(dd[0]["x"],dd[0]["y"]));
            if(dd.length>1){
                map.setZoom(12);
            }
            addMarker(dd);//向地图中添加marker
        }else{
            // 创建地址解析器实例
            var myGeo = new BMap.Geocoder();
            // 将地址解析结果显示在地图上,并调整地图视野
            var keyword=document.getElementById("exact").value;
            myGeo.getPoint(keyword, function(point){
              if (point) {
                map.setZoom(14);//改变地图缩放级别
                map.panTo(point);//地图移动到搜索点
                changeDatas();
                var marker=new BMap.Marker(point);
                var label = new BMap.Label(keyword,{"offset":new BMap.Size(-keyword.length*3,-20)});
                label.setStyle(style[1]);
                marker.disableMassClear();
		marker.setLabel(label);
                map.addOverlay(marker);
              }else{
                  alert("上海市内搜索不到相关的信息");
              }
            }, "上海市");
        }
        return false;
}
//地图上重新匹配数据
    window.changeDatas = function(){
        map.clearOverlays();//清除地图上的覆盖物
        var bounds = map.getBounds();
        minX=bounds.getSouthWest()["lng"];
        minY=bounds.getSouthWest()["lat"];
        maxX=bounds.getNorthEast()["lng"];
        maxY=bounds.getNorthEast()["lat"];
        var type  = $("#SourceType").attr("attr");//资源类型
        var area  = $("#SourceArea").attr("attr");//面积
        var price = $("#SourcePrice").attr("attr");//价格
        var zoom = map.getZoom();
        $.ajax({
        url:"/map/movemap",
        data:{"swX":minX,"swY":minY,"neX":maxX,"neY":maxY,"type":type,"price":price,"area":area,"zoom":zoom},
        type:"POST",
        success:function(msg){
           
           var data = eval("("+msg+")");
            searchClass.setData(data);
            addMarker(data);
            }
        });
   }
//创建标注
    window.addMarker = function (data){
	var bounds = map.getBounds();
	minX=bounds.getSouthWest()["lng"];
	minY=bounds.getSouthWest()["lat"];
	maxX=bounds.getNorthEast()["lng"];
	maxY=bounds.getNorthEast()["lat"];
        var c=0;
        for(var i=0;i<data.length;i++){
                if(c>50){break;}
                var json=data[i];
                var p0 = json["x"];
                var p1 = json["y"];
             if(p0>minX&&p0<maxX&&p1>minY&&p1<maxY){
                 
                  if(checkNewHouse()){
                       var content = json.sbi_buildingname;
                    }else{
                        var num = json.num;
                        content =num+"套";
                    }
                        c++;
                        var point = new BMap.Point(p0,p1);
                        var iconImg = createIcon();
                        var marker = new BMap.Marker(point,{icon:iconImg});
                        var label = new BMap.Label(content,{"offset":new BMap.Size(0,-18)});
                        marker.setLabel(label);
                        map.addOverlay(marker);
                        label.setStyle(style[0]);
                        (function(){
                                var _json = json;
                                var _content=content
                                var _marker = marker;
                                marker.addEventListener("click",function(){
                                    createInfoWindow(_json.buildingid,this);
                                });
                                label.addEventListener("click",function(){
                                    createInfoWindow(_json.buildingid,_marker);
                                });
                                label.addEventListener("mouseover",function(){
                                    iconImg.setImageOffset(new BMap.Size(0,-0));
                                    _marker.setIcon(iconImg);
                                    _marker.setZIndex(100)
                                    this.setStyle(style[1]);
                                    if(!checkNewHouse()){
                                        this.setContent(_json.sbi_buildingname+_json.num+"套");
                                    }
                                });
                                label.addEventListener("mouseout",function(){
                                    iconImg.setImageOffset(new BMap.Size(0,-20));
                                    _marker.setIcon(iconImg);
                                    this.setStyle(style[0]);
                                    _marker.setZIndex(80)
                                    if(!checkNewHouse()){
                                        this.setContent(_content);
                                    }
                                });
                        })()      
                 }
           }
    }
    //创建InfoWindow信息窗口
    /*@id楼盘ID
    *@type租售类型
    *@object触发事件对象
    */
    function createInfoWindow(id,object){
        var type  = $("#SourceType").attr("attr");//资源类型
        var area  = $("#SourceArea").attr("attr");//面积
        var price = $("#SourcePrice").attr("attr");//价格
        if(checkNewHouse(sellorrent)){
            var opts = {
                        width : 425   // 信息窗口宽度
                        //height: 200      // 信息窗口高度
                        //title : "Hello"// 信息窗口标题
             }
                $.ajax({
                        url:"/map/newhousetip",
                        type:"POST",
                        //async:false,
                         data:"buildid="+id+"&type="+type,
                        success:function(msg){
                        var _iw = new BMap.InfoWindow(msg,opts);
                        //_iw.disableAutoPan();
                        object.openInfoWindow(_iw);
                        }
                })
         }else{
                var url = "#";
                if(type==1){//写字楼
                        url = "/map/officeajaxpage";
                }else if(type==3){//商务中心
                        url = "/map/officeajaxpage";
                }else if(type==2){//商铺
                        url = "/map/shopajaxpage";
                }else if(type==4){
                        url = "/map/residenceajaxpage";
                }
                
                $.ajax({
                        url:url,
                        type:"POST",
                        data:"sellorrent="+sellorrent+"&buildid="+id+"&type="+type+"&price="+price+"&area="+area,
                        success:function(msg){
                         var _iw = new BMap.InfoWindow(msg,opts);
//                         alert(msg)
//                        _iw.disableAutoPan();
//                        object.openInfoWindow(_iw);
                        $("#Info").html(msg);
                        $("#Info").attr('className','showDiv');
                        }
                 })
         }

   }
    //创建一个Icon
    function createIcon(){
        var icon = new BMap.Icon("http://map.baidu.com/fwmap/upload/r/map/fwmap/static/house/images/label.png", new BMap.Size(15,10),{imageOffset: new BMap.Size(0,-20),infoWindowAnchor:new BMap.Size(0,11),offset:new BMap.Size(6,21)})
        return icon;
    }
    function SearchClass(data){
        this.datas = data;
    }
    function closeInfo(){
           $("#Info").attr('className','hideDiv');
    }
    SearchClass.prototype.search = function(rule){
        if(this.datas == null){alert("数据不存在!");return false;}
        if(this.trim(rule) == "" || this.trim(rule.d) == "" || this.trim(rule.k) == "" || this.trim(rule.t) == ""){alert("请指定要搜索内容!");return false;}
        var reval = [];
        var datas = this.datas;
        var len = datas.length;
        var me = this;
        var ruleReg = new RegExp(this.trim(rule.d));
        var hasOpen = false;
        
        var addData = function(data,isOpen){
            //第一条数据打开信息窗口
            if(isOpen && !hasOpen){
                hasOpen = true;
                data.isOpen = 1;
            }else{
                data.isOpen = 0;
            }
            reval.push(data);
        }
        var getData = function(data,key){
           
            var ks = me.trim(key).split(/\./);
            var i = null,s = "data";
            if(ks.length == 0){
                return data;
            }else{ 
                for(var i = 0; i < ks.length; i++){
                    s += '["' + ks[i] + '"]';
                }
                return eval(s);
            }
        }
        for(var cnt = 0; cnt < len; cnt++){
            var data = datas[cnt];
            var d = getData(data,rule.k);
            if(rule.t == "single" && rule.d == d){
                addData(data,true);
            }else if(rule.t != "single" && ruleReg.test(d)){
                addData(data,true);
            }else if(rule.s == "all"){
                addData(data,false);
            }
        }
        return reval;
    }

    SearchClass.prototype.setData = function(data){
        this.datas = data;
    }
    SearchClass.prototype.trim = function(str){
     if(str == null){str = "";}else{str = str.toString();}
        return str.replace(/(^[\s\t\xa0\u3000]+)|([\u3000\xa0\s\t]+$)/g, "");
    }
    function searchByDistrict(region){
        clearMarker();
    //先把楼盘地址定位搜索条件清空
    $("#exact").val("");
    //地图移动至搜索点
    $.ajax({
        url:"/map/findcenter",
        type:"POST",
        data:"type=1&region="+region,
        success:function(msg){
            var msgnew = eval("("+msg+")");
        // 创建地址解析器实例
            var myGeo = new BMap.Geocoder();
            myGeo.getPoint(msgnew.rp_buildname, function(point){
              if (point) {
                map.setZoom(14);//改变地图缩放级别
                map.panTo(point);//地图移动到搜索点
                changeDatas();
                var marker=new BMap.Marker(point);
                var label = new BMap.Label(msgnew.rp_buildname,{"offset":new BMap.Size(-msgnew.rp_buildname.length*3,-20)});
                label.setStyle(style[1]);
                marker.disableMassClear();
		marker.setLabel(label);
                map.addOverlay(marker);
              }
            }, "上海市");
        }
    })
    //描点
    changeData();
}

    function searchByMetroLine(line){
        clearMarker();
        //先把楼盘地址定位搜索条件清空
        $("#exact").val("");
         //地图移动至搜索点
        $.ajax({
            url:"/map/findcenter",
            type:"POST",
            data:"type=2&region="+line,
            success:function(msg){
                var msgnew = eval("("+msg+")");
                var point=new BMap.Point(msgnew.x,msgnew.y);
                map.panTo(point);//地图移动到搜索点
                changeDatas();
                var marker=new BMap.Marker(point);
                    var label = new BMap.Label(msgnew.rp_buildname,{"offset":new BMap.Size(-msgnew.rp_buildname.length*3,-20)});
                    label.setStyle(style[1]);
                    marker.disableMassClear();
                    marker.setLabel(label);
                    map.addOverlay(marker);
            }
        })
       
        
    }
   //判断是否是新房 是返回true 否返回false
    function checkNewHouse(){
        if(sellorrent=="nh"){
            return true;
        }else{
            return false;
        }
    }
    function go(page){
        var type  = $("#type_tip").val();
        var area  = $("#area_tip").val();
        var price = $("#price_tip").val();
        var buildid = $("#buildid_tip").val();

        var url = "";
        if(type==1){//写字楼
            url = "/map/officeajaxpage";
        }else if(type==3){//商务中心
            url = "/map/officeajaxpage";
        }else if(type==2){//商铺
            url = "/map/shopajaxpage";
        }else if(type==4){//住宅
            url = "/map/residenceajaxpage";
        }
        $.ajax({
                url:url,
                type:"POST",
                data:"sellorrent="+sellorrent+"&buildid="+buildid+"&type="+type+"&price="+price+"&area="+area+"&page="+page,
                success:function(msg){
                   $("#Info").html(msg);
                   return false;
                }
        })
    }
     //设置覆盖物都可清除
     function clearMarker(){
        var markers= map.getOverlays();
        for(i in markers){
           markers[0].enableMassClear();
        }
     }
    function changeSearchKeyValue(value){
    var content = document.getElementById("exact").value;
        if(value=="over"){
            if(defaultKeyword==content){
                document.getElementById("exact").value = "";
            }
        }
        if(value=="out"){
            if(content==""){
                document.getElementById("exact").value = defaultKeyword;
            }
        }
    }