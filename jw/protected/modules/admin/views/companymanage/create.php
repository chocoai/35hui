<?php
$this->breadcrumbs=array(
        '公司管理',
        '添加新公司',
);?>

<h1>添加新公司</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,"district"=>$district)); ?>

<script type="text/javascript">
$(document).ready(function(){
   <?php if(Yii::app()->user->getFlash('message')){ ?>jw.pop.alert("添加新公司成功",{autoClose:1000})<?php } ?>
});
</script>