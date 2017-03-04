<?php
$this->breadcrumbs=array(
        '销售管理',
        '联系人记录'
);
$this->currentMenu = 100;
$this->menu=array(
	array('label'=>'新建联系人', 'url'=>array('create')),
	array('label'=>'管理联系人', 'url'=>array('admin')),
);
?>
<form action="" method="get">
	<div class="row">
                区域：<?php echo CHtml::dropDownList('district',$district,Region::model()->getTarafUnits(37),array("empty"=>"--请选择--")); ?>
		姓名：<?php echo CHtml::textField('username',$username,array('size'=>20,'maxlength'=>50)); ?>
                所在公司：<?php echo CHtml::textField('cr_company',$cr_company,array('size'=>20,'maxlength'=>50)); ?>
                <input type="submit" value="搜索" onclici="$('#search-fomr').submit();"/>
	</div>
</form>
<table width="100%" style="margin: 0px" >
    <tr>
        <th width="7%">ID</th>
        <th width="10%">姓名</th>
        <th width="23%">所在公司</th>
        <th width="11%">是否跟进</th>
        <th width="13%">登记人</th>
        <th width="13%">手机号码</th>
        <th width="11%">用户质量</th>
        <th>登记时间</th>
    </tr>
</table>
    <?php
    $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_itemview',
            'summaryText'=>'',
            'summaryCssClass'=>'',
    ));
    ?>