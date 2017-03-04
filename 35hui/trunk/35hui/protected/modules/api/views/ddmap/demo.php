<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="/jquery.js"></script>
<title>新地标API</title>
<style type="text/css">
body{font-size: 12px}
</style>
</head>
<body>
<div>
    <div style="width:100%">返回信息：</div>
    <div id="info">
        <table border="1" width="300px">
            <tr>
                <td>写字楼ID(id)</td>
                <td id="id"></td>
            </tr>
            <tr>
                <td>地址(address)</td>
                <td id="address"></td>
            </tr>
            <tr>
                <td>出租房源数(rentNum)</td>
                <td id="rentNum"></td>
            </tr>
            <tr>
                <td>出售房源数(sellNum)</td>
                <td id="sellNum"></td>
            </tr>
            <tr>
                <td>总页数(totalPageCount)</td>
                <td id="totalPageCount"></td>
            </tr>
            <tr>
                <td>当前页码(page)</td>
                <td id="page"></td>
            </tr>
            <tr>
                <td>每页显示条数(max)</td>
                <td id="max"></td>
            </tr>
        </table>
        <br />
        <table border="1" width="600px" id="office">
            <tr>
                <td colspan="10">房源信息</td>
            </tr>
            <tr>
                <td>楼层</td>
                <td>租金(元/平米·天)</td>
                <td>面积(平米)</td>
                <td>发布者</td>
                <td>类型</td>
                <td>发布时间</td>
                <td>操作</td>
            </tr>
        </table>
    </div>
    <h4>全景</h4>
    <embed height="400" width="500"
       allowfullscreen="true"
       src="<?=DOMAIN?>/api/ddmap/panoplayer/play/45.swf" type="application/x-shockwave-flash" />
</div>

<script type="text/javascript">
$(document).ready(function(){
    //max 和page参数都是可选项
    $.getJSON("<?=DOMAIN?>/api/ddmap/getinfo?id=45&key=5c564b7aca98941b69d677b0efc85d01&max=3&page=1&callback=?",
    function(data){
        if(typeof(data)=="object"){
            $("#id").html(data.id);
            $("#address").html(data.address);
            $("#rentNum").html(data.rentNum);
            $("#sellNum").html(data.sellNum);
            $("#totalPageCount").html(data.totalPageCount);
            $("#page").html(data.page);
            $("#max").html(data.max);

            $.each(data.office, function(){
                var html = "<tr>";
                html +='<td>'+this.floor+'</td>';
                html +='<td>'+this.pirce+'</td>';
                html +='<td>'+this.area+'</td>';
                html +='<td>'+this.connectuser+'</td>';
                html +='<td>'+this.type+'</td>';
                html +='<td>'+this.time+'</td>';
                html +='<td><a href="'+this.url+'" target="_blank">查看联系方式</a></td>';
                html +="</tr>";
                $("#office").append(html);
            })
        }
    });
});
</script>
</body>
</html>
