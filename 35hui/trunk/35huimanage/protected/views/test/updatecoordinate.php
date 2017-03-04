<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<script type="text/javascript" src="/assets/convertor.js"></script>
<?Yii::app()->clientScript->registerCoreScript('jquery');?>
</head>
<body>
<input type="button"  onclick="updatecoordinate()" value="开始转换">
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
			updatecoordinate=function(){
			
				$.ajax({
							url:"/test/getcoordinate",
							type:"POST",
							data:{},
                            async:false,
							success:function(msg){
							var data = eval("("+msg+")");
								for(var i=100;i<data.length;i++){
								var x = data[i]["x"];
								var y = data[i]["y"];
								var id = data[i]["id"];
								var name=data[i]["name"];
									if(x!=0&&y!=0){
										var book=new Array();
										book["id"]=id;
										book["name"]=name;
										book["ggx"]=x;
										book["ggy"]=y;
										ggxy(x,y,id,book);
									}
								}
							}
					});
					
			}
			ggxy = function (x,y,id,book){
				var ggPoint = new BMap.Point(x,y);
				BMap.Convertor.translate(ggPoint,2,translateCallback,id,book);
			}
			translateCallback = function (point,id,book){
			book["bdx"]=point.lng;
			book["bdy"]=point.lat;
			var data="["+book["id"]+"] 楼盘名称:"+book["name"]+"Google坐标X:"+book["ggx"]+"Y:"+book["ggy"]+"     =====>    Baidu坐标X:"+book["bdx"]+"Y:"+book["bdy"]+";\r\n";
				$.ajax({
							url:"/test/updatebyid",
							type:"POST",
							data:{"id":id,"x":point.lng,"y":point.lat},
                            async:false,
							success:function(msg){
								if(msg){
									alert(msg);
									daybooklist(data);
								}else{
									alert("修改失败");
								}
							}
				});
			}
			daybooklist = function(data){
				$.ajax({
							url:"/test/writebook",
							type:"POST",
							data:{"data":data},
                            async:false,
							success:function(msg){
								if(msg){
									alert(msg);
								}else{
									alert("写入失败");
								}
							}
				});
				
			}
})
</script>