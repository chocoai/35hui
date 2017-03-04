<?php
$this->breadcrumbs=array(
        'User'=>array('index'),
        'Upgrade',
);

?>

<h1>Update User <?php echo CHtml::link($model->ua_realname, MAINHOST.'/uagent/index/id/'.$model->ua_id,array("target"=>"_blank")),'[',$model->ua_uid,']'; ?></h1>

<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-notice">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>

<p>
    <?php
    if($model->ua_combo){
        $comboModel = Combo::model()->findByPk($model->ua_combo);
        ?>
    套餐名称：<?=$comboModel->cb_name ?><br />
    套餐到期时间：<?php echo date('Y-m-d',$model->ua_combotime);?>
        <?php
    }else{
        echo "此用户还未购买套餐";
    }
    ?>
</p>
<?php
//if($model->ua_combo){
    ?>
<form method="POST" action="" onsubmit="return checkForm(this)">
    套餐：<?=CHtml::dropDownList("combo",'',$combo,array('empty'=>'--请选择--'))?>
    专属客服：<?=CHtml::dropDownList("mangeuser",'',$mangeuser,array())?>
    套餐期限：<?=CHtml::dropDownList("combotime",'',array(
        '1'=>'1',
        '2'=>'2',
        '3'=>'3',
        '6'=>'6',
        '9'=>'9',
        '12'=>'12',
        ))?><span>单位月（30天）</span>
    
    <?=CHtml::submitButton("确定升级")?>
</form>
    <?php
//}
?>
<script type="text/javascript">
    function checkForm(Obj){
        var combo=Obj.combo.value;
        if(!(combo)){
            alert('请选择套餐');
            return false;
        }
        return confirm('确定要升级');
    }
</script>

