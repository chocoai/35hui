<style type="text/css">
    div.form label{display: inline}
</style>
<div class="wide form">

    <?php $form=$this->beginWidget('CActiveForm', array(
            'action'=>Yii::app()->createUrl($this->route),
            'method'=>'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model,'ec_id'); ?>
        <?php echo $form->textField($model,'ec_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'ec_answer'); ?>
        <?php echo $form->dropDownList($model,'ec_answer',Examchoice::$ec_answer,array("empty"=>"--请选择--")); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'ec_type'); ?>
        <?php echo $form->dropDownList($model,'ec_type',Examchoice::$ec_type,array("empty"=>"--请选择--")); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->