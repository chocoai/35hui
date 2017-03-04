<?php
$this->breadcrumbs=array(
        'Creativecollects'=>array('index'),
        $model->cc_id,
);

?>

<h1>审核 <?php echo $model->cc_name; ?></h1>

<div class="view">
    <div style="width: 70%;float: left;">
        <b><?php echo CHtml::encode($model->getAttributeLabel('cc_userid')); ?>:</b>
        <?php echo CHtml::encode(User::model()->getRealNamebyid($model->cc_userid)); ?>
        <br />
        <b><?php echo CHtml::encode($model->getAttributeLabel('cc_name')); ?>:</b>
        <?php echo CHtml::encode($model->cc_name); ?>
        <br />
        <b><?php echo CHtml::encode($model->getAttributeLabel('cc_address')); ?>:</b>
        <?php echo CHtml::encode($model->cc_address); ?>
        <br />
        <b><?php echo CHtml::encode($model->getAttributeLabel('cc_district')); ?>:</b>
        <?php echo CHtml::encode(Region::model()->getNameById($model->cc_district)); ?>
        <br />

        <b><?php echo CHtml::encode($model->getAttributeLabel('cc_state')); ?>:</b>
        <?php echo CHtml::encode(Creativecollect::$cc_state[$model->cc_state]); ?>&nbsp;
        <b><?php echo CHtml::encode($model->getAttributeLabel('cc_releasetime')); ?>:</b>
        <?php echo date("Y-m-d H:i:s",$model->cc_releasetime); ?>
        <br />
        <div style="clear:both">
            <?php
            if($model->cc_state==0){
            ?>
            <table width="100%">
                <tr>
                    <td style="text-align: center">
                        <?=CHtml::link("通过",array("audit",'id'=>$model->cc_id,"type"=>"pass"),array("onClick"=>"return confirm('审核通过会跳转的楼盘完善页面')"));?>
                        <br />(审核通过,保留用户录入的创意园，跳转至创意园完善页面。)
                    </td>
                    <td style="text-align: center">
                        <?=CHtml::link("不通过",array("audit",'id'=>$model->cc_id,"type"=>"unpass"),array("onClick"=>"return confirm('审核不通过将会删除楼盘数据，确定吗？')"))?>
                        <br />(审核不通过,删除用户录入的创意园数据，保留房源。)
                    </td>
                </tr>
            </table>
            <?php
            }
            ?>
        </div>
    </div>

</div>
