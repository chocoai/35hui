<?php
$this->breadcrumbs=array('修改密码',);
?>
<div class="htit">修改密码</div>
<div class="rgcont">
    <?php echo CHtml::beginForm(); ?>
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="14%" class="tit"><em>* </em>输入旧密码：</td>
            <td width="86%">
                <?php echo CHtml::activePasswordField($model,'originpwd',array("class"=>"txt_01")); ?>
                <?php if(isset($model->errors["originpwd"][0])){
                    echo "<em>".$model->errors["originpwd"][0]."</em>";
                }else{
                    echo $model->errors?"":"请输入您的旧密码。";
                }?>
            </td>
        </tr>
        <tr>
            <td width="14%" class="tit"><em>* </em>新密码：</td>
            <td width="86%">
                <?php echo CHtml::activePasswordField($model,'newpwd',array("class"=>"txt_01")); ?>
                <?php if(isset($model->errors["newpwd"][0])){
                    echo "<em>".$model->errors["newpwd"][0]."</em>";
                }else{
                    echo $model->errors?"":"请输入新密码，6-20位，英语区分大小写。";
                }?>

            </td>
        </tr>
        <tr>
            <td width="14%" class="tit"><em>* </em>确认密码：</td>
            <td width="86%">
                <?php echo CHtml::activePasswordField($model,'renewpwd',array("class"=>"txt_01")); ?>
                <?php if(isset($model->errors["renewpwd"][0])){
                    echo "<em>".$model->errors["renewpwd"][0]."</em>";
                }else{
                    echo $model->errors?"":"请输确认密码。";
                }?>

            </td>
        </tr>
        <tr>
            <td width="14%">&nbsp;</td>
            <td width="86%"><input type="submit" value="提交" style="width:100px;" /></td>
        </tr>
    </table>
    <?php echo CHtml::endForm(); ?>
</div>


<script type="text/javascript">
<?php
if(Yii::app()->user->hasFlash('message')){
    echo "alert('".Yii::app()->user->getFlash('message')."');";
}
?>
</script>
