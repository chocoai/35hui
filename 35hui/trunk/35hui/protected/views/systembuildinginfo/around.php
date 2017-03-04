<?php
$sbi_city = Region::model()->getNameById($model->sbi_city);
$sbi_district = Region::model()->getNameById($model->sbi_district);
$sbi_section = Region::model()->getNameById($model->sbi_section);
$sbi_buildingname = $model->sbi_buildingname;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'写字楼,'.$sbi_buildingname.'写字楼租赁,360°全景看房';
$description='找'.$sbi_city.'出售房源和租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
?>


    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->sbi_buildingname,array('systembuildinginfo/view','id'=>$model->sbi_buildingid)) ?>&gt;<em>周边配套</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"around")); ?>

	<div class="detcont">
        <div class="dllcont">
			<div class="alltraffice">
                <?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$model->sbi_x ? $model->sbi_x:'121.47536873817444',
                        'y'=>$model->sbi_y ? $model->sbi_y:'31.232857675162947',
                        'name'=>$model->sbi_buildingname ? $model->sbi_buildingname:'人民广场',
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
if($model->sbi_traffic){
foreach( unserialize($model->sbi_traffic) as $k=>$v ) {
    if(empty($v)) continue;
?>
				<tr>
					<td width="16%" class="tit"><?php echo CHtml::encode($k); ?>:</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($v); ?></td>
				</tr>
<?php }
} ?>
				<tr>
					<td class="title" colspan="2">周边商业配套</td>
				</tr>
<?php
if($model->sbi_peripheral){
foreach( unserialize($model->sbi_peripheral) as $k=>$v ) {
    if(empty($v)) continue;
?>
				<tr>
					<td width="16%" class="tit"><?php echo CHtml::encode($k); ?>:</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($v); ?></td>
				</tr>
<?php }
} ?>
		  </table>
		</div>
	</div>
<br />
