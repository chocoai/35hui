<?php
$this->breadcrumbs=array(
	'需求登记'=>array('index'),
	$model->qrq_id,
);

$this->menu=array(
	array('label'=>'查看', 'url'=>array('index')),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->qrq_id),'confirm'=>'确定删除?')),
	array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>ID#<?php echo $model->qrq_id; ?></h1>
<div class="view">
    
       <b><?php echo CHtml::encode($model->getAttributeLabel('qrq_name')); ?>:</b><?php echo CHtml::encode($model->qrq_name); ?><br/>

       <b><?php echo CHtml::encode($model->getAttributeLabel('qrq_tel')); ?>:</b><?php echo CHtml::encode($model->qrq_tel); ?><br/>

       <b><?php echo CHtml::encode($model->getAttributeLabel('qrq_email')); ?>:</b><?php echo  CHtml::encode($model->qrq_email); ?><br/>

       <b><?php echo $model->qrq_check?"发布状态":"审核状态" ?>:</b><?php echo $model->qrq_check?$model->qrq_check==1?"<font color='green'>发布":"<font color='FF0000'>下线":"<font color='#808080'>未审核";?></font>
                <?php
                    if($model->qrq_settledate>time()){
                        echo CHtml::link($model->qrq_check?$model->qrq_check==1?"下线":"发布":"通过",array(""),array('submit'=>array('checked','id'=>$model->qrq_id),'confirm'=>$model->qrq_check?"确定下线?":"确定发布?"));
                    }
                    echo "&nbsp".CHtml::link("删除",array(""),array('submit'=>array('delete','id'=>$model->qrq_id),'confirm'=>'确定删除?'))
                ?>
       <br/>

       <b><?php echo CHtml::encode($model->getAttributeLabel('qrq_releasedate')); ?>:</b><?php echo date("Y-m-d H:i:s",$model->qrq_releasedate); ?> <br/>
            
       <b><?php echo CHtml::encode($model->getAttributeLabel('qrq_settledate')); ?>:</b><font style="color:<?=$model->qrq_settledate>time()?"green":"#FF0000";?>"><?php echo date("Y-m-d H:i:s",$model->qrq_settledate); ?></font>
                <?php
                    if($model->qrq_settledate>time()){
                        echo CHtml::link("停止",array(""),array('submit'=>array('SettleTime','id'=>$model->qrq_id),'confirm'=>'确定停止?'));
                    }
                    echo "&nbsp;".CHtml::link("延期",array(""),array('submit'=>array('ProlongTime','id'=>$model->qrq_id),'confirm'=>'确定延长有效期?'))
                ?>
       <br/>

       <b><?php echo CHtml::encode($model->getAttributeLabel('qrq_require')); ?>:</b><br/><?php echo CHtml::encode($model->qrq_require); ?>
       <br/>
   
</div>
<?php
/* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'qrq_id',
		'qrq_require',
		'qrq_tel',
		'qrq_name',
		'qrq_email',
		'qrq_check',
		'qrq_releasedate',
		'qrq_settledate',
	),
)); */
?>
