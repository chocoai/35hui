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
        <th width="13%">业务员</th>
        <th width="37%">套餐</th>
        <th width="18%">成交金额</th>
        <th width="13%">合同编号</th>
        <th>成交时间</th>
    </tr>
    <?php 
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_buy',
    ));
    ?>
</table>