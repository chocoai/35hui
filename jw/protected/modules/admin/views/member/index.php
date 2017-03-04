<?php
$this->breadcrumbs=array(
        '专业会员推荐',
);?>
<table width="100%" id="tableform">
    <tr>
        <td>用户ID：<input type="text" name="userId" value="<?=$show["userId"]?>" /></td>
        <td>姓名：<input type="text" name="name" value="<?=$show["name"]?>" /></td>
        <td>排序：<?=CHtml::dropDownList("order",$show["order"],array(
            "0"=>"默认排序",
            "1"=>"按红牌数",
            "2"=>"推荐次数",
            "3"=>"按最后推荐时间",
            ))?></td>
        <td><input type="button" value="搜索" onclick="search()" /></td>
        
    </tr>
</table>
<table width="100%" class="bordertable">
    <tr>
        <th width="50px">用户ID</th>
        <th >姓名</th>
        <th width="80px">电话</th>
        <th width="40px">等级</th>
        <th width="60px">红牌数</th>
        <th width="60px">推荐次数</th>
        <th width="60px">最后推荐</th>
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
    var base = "/admin/member/index";
    var arr = new Array();
    var userId = $.trim($("#tableform input[name='userId']").val());
    if(userId){
        arr.push("userId="+userId);
    }
    var name = $.trim($("#tableform input[name='name']").val());
    if(name){
        arr.push("name="+name);
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