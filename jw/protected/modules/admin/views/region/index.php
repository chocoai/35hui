<?php
$this->breadcrumbs=array(
        '地区配置',
);?>
<style type="text/css">
    .bgcl{background-color: gray}
</style>
<div>
    <a href="/admin/region/index">返回省级</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="/admin/region/index/pid/<?=$preid?>">返回上级</a>&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="/admin/region/create/pid/<?=$pid?>">本级增加新条目</a>
</div>
<table width="500px" id="allList" class="bordertable">
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>排序</th>
        <th>首字母</th>
        <th>&nbsp;</th>
    </tr>
    <?php
    if($all){
        foreach($all as $value){
            ?>
    <tr>
        <td><?=$value->re_id?></td>
        <td>
            <a href="/admin/region/index/pid/<?=$value->re_id?>"><?=$value->re_name?>(<?=Region::model()->countAllGroup($value->re_id)?>)</a>
        </td>
        <td><?=$value->re_order?></td>
        <td><?=$value->re_pinyin?></td>
        <td align="center">
            <a href="/admin/region/update/id/<?=$value->re_id?>">修改</a>
            <a href="/admin/region/del/id/<?=$value->re_id?>" onclick="return confirmdel()">删除</a>
        </td>
    </tr>
    <?php
        }
    }
    ?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
        $("#allList tr").mouseover(function(){
            $(this).addClass("bgcl");
        }).mouseout(function(){
            $(this).removeClass("bgcl");
        })
    })
    function confirmdel(){
        if(confirm("确定删除本信息吗？")){
            return true;
        }
        return false;
    }
</script>