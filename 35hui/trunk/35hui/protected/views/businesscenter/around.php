    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->bc_name,array('view','id'=>$model->bc_id)) ?>&gt;<em>周边配套</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->bc_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->bc_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->bc_englishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_nav',array('model'=>$model)); ?>

	<div class="detcont">
        <div class="dllcont">
			<div class="alltraffice">
                <?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$sysModel->sbi_x ? $sysModel->sbi_x:'121.47536873817444',
                        'y'=>$sysModel->sbi_y ? $sysModel->sbi_y:'31.232857675162947',
                        'name'=>$model->bc_name,
                        "searchAddress"=>$model->bc_sysid?"":$model->bc_address,
                        
                        'width'=>"1000px",
                        'height'=>"475px",
                        'type'=>"all",
                ));
                ?>
    		</div>
<?php
if($model->bc_traffic || $model->bc_peripheral){
if($model->bc_traffic){ ?>
			<table border="0" cellpadding="0" cellspacing="0" class="table_03">
				<tr>
					<td class="title" colspan="2">交通</td>
				</tr>
<?php
foreach( unserialize($model->bc_traffic) as $k=>$v ) {
?>
				<tr>
					<td width="16%" class="tit"><?php echo CHtml::encode($k); ?>:</td>
					<td width="84%" class="txt"><?php echo $v?CHtml::encode($v):'暂无资料'; ?></td>
				</tr>
<?php }
}
if($model->bc_peripheral){ ?>
				<tr>
					<td class="title" colspan="2">周边商业配套</td>
				</tr>
<?php
foreach( unserialize($model->bc_peripheral) as $k=>$v ) {
?>
				<tr>
					<td width="16%" class="tit"><?php echo CHtml::encode($k); ?>:</td>
					<td width="84%" class="txt"><?php echo $v?CHtml::encode($v):'暂无资料'; ?></td>
				</tr>
<?php }
} ?>
		  </table><?php } ?>
		</div>
	</div>
<br />
