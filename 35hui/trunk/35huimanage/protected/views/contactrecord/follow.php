<?php
$this->breadcrumbs=array(
        '销售管理',
        '联系人记录'
);
$this->currentMenu = 100;
$this->menu=array(
	array('label'=>'新建联系人', 'url'=>array('isregister')),
	array('label'=>'管理联系人', 'url'=>array('admin')),
);
?>
<table width="100%" style="margin: 0px" >
    <tr>
        <th width="30%">跟进内容</th>
        <th width="12%">业务员</th>
        <th width="20%">预约时间</th>
        <th width="19%">提醒日期</th>
        <th>跟进日期</th>
    </tr>
    <?php
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_follow',
    ));
    ?>
</table>