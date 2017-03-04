<?php
$this->breadcrumbs=array(
        '专业会员级别管理',
);?>
<div style="float:left">
    <a href="/admin/memberlevel/create">添加新级别</a>
</div>
<div style="clear:both"></div>
<table class="bordertable">
    <tr>
        <th width="50px">序号</th>
        <th width="80px">名称</th>
        <th width="80px">红牌数目</th>
        <th width="110px">允许创建相册数</th>
        <th width="110px">每日可打牌数</th>
        <th width="80px"></th>
    </tr>
    <?php
    foreach($allLevel as $key=>$value) {
        ?>
    <tr>
        <td><?=$key+1?></td>
        <td><?=$value->ml_name?></td>
        <td><?=$value->ml_redboards?></td>
        <td><?=$value->ml_albumnum?></td>
        <td><?=$value->ml_dayboardnum?></td>
        <td>
            &nbsp;<a href="/admin/memberlevel/update/id/<?=$value->ml_id?>">修改</a>&nbsp;
            <a href="/admin/memberlevel/del/id/<?=$value->ml_id?>">删除</a>
        </td>
    </tr>
        <?php
    }
    ?>
</table>
<script type="text/javascript">
    $(document).ready(function(){
<?php if(Yii::app()->user->hasFlash('message')): ?>
        jw.pop.alert("<?=Yii::app()->user->getFlash('message')?>",{autoClose:1000})
<?php endif; ?>
    });
</script>