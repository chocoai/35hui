    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->cp_name,array('systembuildinginfo/view','id'=>$model->cp_id)) ?>&gt;<em>周边配套</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->cp_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->cp_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->cp_englishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('model'=>$model)); ?>

	<div class="detcont">
        <div class="dllcont">
			<div class="alltraffice">
                <?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$model->cp_x ? $model->cp_x:'121.47536873817444',
                        'y'=>$model->cp_y ? $model->cp_y:'31.232857675162947',
                        'name'=>$model->cp_name ? $model->cp_name:'人民广场',
                        'width'=>"1000px",
                        'height'=>"475px",
                        'type'=>"all",
                ));
                ?>
    		</div>
			<table border="0" cellpadding="0" cellspacing="0" class="table_03">
				<tr>
					<td class="title" colspan="2">交通</td>
				</tr>
<?php
if($model->cp_traffic){
$keyNames = array(
    'guidao'=>'轨道交通',
    'gaojia'=>'高架',
    'jichang'=>'机场',
    'gongjiao'=>'公交车',
    'huoche'=>'火车',
);
foreach( unserialize($model->cp_traffic) as $k=>$v ) {
?>
				<tr>
					<td width="16%" class="tit"><?php echo $keyNames[$k]; ?>:</td>
					<td width="84%" class="txt"><?php echo $v?CHtml::encode($v):'暂无资料'; ?></td>
				</tr>
<?php }
} ?>
				<tr>
					<td class="title" colspan="2">周边商业配套</td>
				</tr>
<?php
if($model->cp_peripheral){
$keyNames = array(
    'shangjie'=>'临近商街',
    'shangchang'=>'商场',
    'jiudian'=>'酒店',
    'yinhang'=>'银行',
    'canyin'=>'餐饮',
);
foreach( unserialize($model->cp_peripheral) as $k=>$v ) {
?>
				<tr>
					<td width="16%" class="tit"><?php echo $keyNames[$k]; ?>:</td>
					<td width="84%" class="txt"><?php echo $v?CHtml::encode($v):'暂无资料'; ?></td>
				</tr>
<?php }
} ?>
		  </table>
		</div>
	</div>
<br />
