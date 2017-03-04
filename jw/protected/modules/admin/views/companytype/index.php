<?php
$this->breadcrumbs=array(
        '公司管理',
        '公司类型',
);?>
<div style="float:left"><a href="<?php echo Yii::app()->createUrl("/admin/companytype/create");?>">添加新类型</a></div><br />
<table class="bordertable">
    <tr>
        <th width="30px">序号</th>
        <th width="150px">名称</th>
        <th width="80px">操作</th>
    </tr>
    <?php
    foreach($all as $value) {
        ?>
    <tr>
        <td><?=$value->ct_id?></td>
        <td><?=$value->ct_name?></td>
        <td>
            <a href="/admin/companytype/del/id/<?=$value->ct_id?>" onclick="return confirmDel()">删除</a>
            <a href="/admin/companytype/update/id/<?=$value->ct_id?>">修改</a>
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
    function confirmDel(){
        if(confirm("确定删除此类型吗")){
            return true;
        }
        return false;
    }
</script>
