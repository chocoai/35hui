<?php
$this->breadcrumbs=array(
	'Buildcollects'=>array('index'),
	$model->bc_id,
);
$this->currentMenu = 21;
?>

<h1>查看<?php echo $model->bc_id; ?></h1>
<div class="view">
    <div style="width: 70%;float: left;">
        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_id')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($model->bc_id), array('view', 'id'=>$model->bc_id)); ?>
        <br />
        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_buildname')); ?>:</b>
        <?php echo CHtml::encode($model->bc_buildname); ?>
        <br />
        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_buildaddress')); ?>:</b>
        <?php echo CHtml::encode($model->bc_buildaddress); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_district')); ?>:</b>
        <?php echo CHtml::encode(Region::model()->getNameById($model->bc_district)); ?>&nbsp;
        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_section')); ?>:</b>
        <?php echo CHtml::encode(Region::model()->getNameById($model->bc_section)); ?>&nbsp;
        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_loop')); ?>:</b>
        <?php echo CHtml::encode(Searchcondition::model()->getLoopName($model->bc_loop)); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_state')); ?>:</b>
        <?php echo CHtml::encode(Buildcollect::$bc_state[$model->bc_state]); ?>&nbsp;
        <b><?php echo CHtml::encode($model->getAttributeLabel('bc_releasetime')); ?>:</b>
        <?php echo date("Y-m-d H:i:s",$model->bc_releasetime); ?>
        <br />
<?php
    echo CHtml::link("审核通过",array("audit",'id'=>$model->bc_id,"type"=>"pass"),array("onClick"=>"return confirm('审核通过会跳转的楼盘完善页面')"));
    echo "&nbsp;&nbsp;&nbsp;";
    echo CHtml::link("审核不通过",array("audit",'id'=>$model->bc_id,"type"=>"unpass"),array("onClick"=>"return confirm('审核不通过将会删除楼盘数据，确定吗？')"));

?>
    </div>

</div>

<?php
$haveBuild=0;
if($likeBuilds){
    foreach($likeBuilds as $build){
        if($build->sbi_buildingid != $model->bc_sysid){
            $haveBuild++;
?>
<div class="view" style="height: 50px">
    <div style="width: 70%;float: left;">
<?php
echo CHtml::link(CHtml::encode($build->sbi_buildingname),MAINHOST.Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$build->sbi_buildingid)),array("target"=>"_blank"));
echo '[',CHtml::encode(Region::model()->getNameById($build->sbi_district)),' ',
                CHtml::encode(Region::model()->getNameById($build->sbi_section)),' ',
                CHtml::encode(Searchcondition::model()->getLoopName($build->sbi_loop)),']' ?>
        <br />
        <b>地址:</b>
        <?php echo CHtml::encode($build->sbi_address); ?>
        <br />
        </div>
    <div style="width: 30%;float: right;margin-top: 20px">
        <?php
        echo CHtml::link("匹配",array("match",'id'=>$model->bc_id,'mid'=>$build->sbi_buildingid),array('onclick'=>'return confirm("确定与此楼盘匹配")'));
        ?>
    </div>
</div>
<?php
        }
    }
}
?>
<p>
<?php
if(!$haveBuild)
    echo '系统中未检查到相似楼盘名称';

//    echo CHtml::link("完善信息",array("/systembuildinginfo/view","id"=>$data->bc_sysid));
//    echo "&nbsp;&nbsp;&nbsp;";
//    echo CHtml::link("删除",array("delete","id"=>$data->bc_id),array("onClick"=>"return confirm('此次删除将只会删除征集数据，楼盘数据不会被删除，确定吗？')"));

//    echo CHtml::link("删除",array("delete","id"=>$data->bc_id),array("onClick"=>"return confirm('将要删除征集数据，确定吗？')"));

?>
</p>

