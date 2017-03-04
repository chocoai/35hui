<?php
$this->breadcrumbs=array(
        '相册推荐',
);?>
<table width="100%" id="tableform">
    <tr>
        <td>用户ID：<input type="text" name="userId" value="<?=$show["userId"]?>" /></td>
        <td>相册标题：<input type="text" name="albumTitle" value="<?=$show["albumTitle"]?>" /></td>
        <td>排序：<?=CHtml::dropDownList("order",$show["order"],array(
            "0"=>"默认排序",
            "1"=>"按红牌数",
            "2"=>"按黑牌数",
            "3"=>"按总推荐数",
            "4"=>"按最后推荐时间",
            "5"=>"按最后更新时间",
            ))?></td>
        <td><input type="button" value="搜索" onclick="search()" /></td>
        
    </tr>
</table>
<table width="100%" class="bordertable">
    <tr>
        <th width="50px">相册ID</th>
        <th width="50px">用户ID</th>
        <th>相册标题</th>
        <th width="50px">红牌数</th>
        <th width="50px">黑牌数</th>
        <th width="60px">推荐次数</th>
        <th width="60px">最后推荐</th>
        <th width="90px">创建时间</th>
        <th width="90px">更新时间</th>
    </tr>
    <?php
    foreach($dataProvider->getData() as $data) {
        $this->renderPartial('_view', array(
                'data'=>$data,
        ));
    }
    ?>
</table>
<div style="height:65px">
<?php
$this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "cssFile"=>"/css/pager.css"
));
?>
</div>
<script type="text/javascript">
function search(){
    var base = "/admin/album/index";
    var arr = new Array();
    var userId = $.trim($("#tableform input[name='userId']").val());
    if(userId){
        arr.push("userId="+userId);
    }
    var albumTitle = $.trim($("#tableform input[name='albumTitle']").val());
    if(albumTitle){
        arr.push("albumTitle="+albumTitle);
    }
    var order = $.trim($("#tableform select[name='order']").val());
    if(order!=0){
        arr.push("order="+order);
    }
    var param = "";
    if(arr.length!=0){
        param = "?"+arr.join("&");
    }
    window.location.href=base+param;
}
</script>