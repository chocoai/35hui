<?php
$this->breadcrumbs=array(
	'系统权限管理'=>array('/authmanage/index'),
    '创建'
);
//$this->currentMenu = 92;
?>
<h1>创建</h1>
<div class="wide form">
    <form method="POST" action="<?=Yii::app()->createUrl('/authmanage/create')?>" id="createform" onsubmit="return chekCreateForm(this);">
	<div class="row">
        类型：
        <?php
        echo CHtml::dropDownList('type',$authType,array('operation'=>'操作','task'=>'任务','role'=>'角色'));
        ?>
        名称：<span class="required">*</span>
        <?php
        echo CHtml::textField('name','',array('size'=>30)); ?>
	</div>
    <div class="row">
        描述：
        <?php echo CHtml::textArea('description',''); ?>
	</div>
    <div class="row">
        规则：
        <?php echo CHtml::textArea('bizrule',''); ?>
        <font color="red">
            return Yii::app()->user->id==$authID;
        </font>
	</div>
    <div class="row" style="display: none;">
        <?php echo CHtml::textArea('data','',array('size'=>40)); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('创建'); ?>
	</div>
</form>
</div>
<script type="text/javascript">
function chekCreateForm(obj){
    var name = obj.name.value.replace(/\s/g,'');
    if( name == '') {
        alert('名称不能为空');
        return false;
    }
    return true;
}
</script>
