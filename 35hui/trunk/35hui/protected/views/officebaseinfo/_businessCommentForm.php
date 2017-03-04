<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'officecomment-form',
    'enableAjaxValidation'=>false,
)); ?>
<style type="text/css">
    .errorSummary ul li{ color:red;}
</style>

<div class="fbdianpin">
    <div class="loupaninfo_fivelinerightbox">
        <dl>
            <dt><strong>评分&nbsp;<font style="color:red">*</font>&nbsp;：</strong><code>点星星评分</code></dt>
            <dd>
                <div style="float:left;width:40px;height: 18px;">交通：</div>
                <?php $this->widget('CStarRating',array(
                    'model'=>$newCommentModel,
                    'attribute'=>'oc_traffice',
                    'allowEmpty' => false,
                    'maxRating' => 100,
                    'minRating' => 20,
                    'ratingStepSize' => 20,
                ));?>
                <div style="float:left;width: 20px">&nbsp;</div>
                <div style="float:left;width:60px;height: 18px;">周围设施：</div>
                <?php $this->widget('CStarRating',array(
                    'model'=>$newCommentModel,
                    'attribute'=>'oc_facility',
                    'allowEmpty' => false,
                    'maxRating' => 100,
                    'minRating' => 20,
                    'ratingStepSize' => 20,
                ));?>
                <div style="float:left;width: 20px">&nbsp;</div>
                <div style="float:left;width:40px;height: 18px;">装饰：</div>
                <?php $this->widget('CStarRating',array(
                    'model'=>$newCommentModel,
                    'attribute'=>'oc_adorn',
                    'allowEmpty' => false,
                    'maxRating' => 100,
                    'minRating' => 20,
                    'ratingStepSize' => 20,
                ));?>
            </dd>
            <dd style="color:#EB933C;">点评内容&nbsp;<font style="color:red">*</font>&nbsp;：</dd>
            <dd><?php echo CHtml::activeTextArea($newCommentModel,'oc_comment',array('class'=>'content f12px','id'=>'oc_comment'));?></dd>
            <dd><?php echo $form->errorSummary($newCommentModel); ?></dd>
            <?php echo CHtml::activeHiddenField($newCommentModel,'oc_officeid',array('value'=>$officeid,'class'=>'content f12px'));?>
            <?php
                if (Yii::app()->user->isGuest) {
                    echo "<dd>".CHtml::htmlButton('请先登录',array('class'=>'loupaninfo_submitthree','style'=>' background: url("/images/loupan.gif") no-repeat scroll 0 -1580px transparent;
    border: medium none;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    height: 24px;
    left: 95px;
    line-height: 24px;
    margin: 3px auto 0;
    overflow: hidden;
    position: relative; top:0;
    width: 74px;','submit'=>Yii::app()->createUrl("/site/login")))."</dd>";
                    echo '&nbsp;&nbsp;(<a href="'.Yii::app()->createUrl("/site/login").'">登录</a>后才能发表评论)';
                }else{
                    echo "<dd>".CHtml::submitButton('提交点评',array('class'=>'loupaninfo_submitthree','style'=>' background: url("/images/loupan.gif") no-repeat scroll 0 -1580px transparent;
    border: medium none;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    height: 24px;
    left: 95px;
    line-height: 24px;
    margin: 3px auto 0;
    overflow: hidden;
    position: relative; top:0;
    width: 74px;'))."</dd>";
                }
            ?>
        </dl>
    </div>
</div>
<?php $this->endWidget(); ?>
<?
    if(isset($_SESSION['publishOfficeComment'])){
        echo "<script>alert('".$_SESSION['publishOfficeComment']."')</script>";
        unset($_SESSION['publishOfficeComment']);
    }
?>
<script type="text/javascript" language="javascript">
        function check_comment_content(obj,ifAlert){
       if($(obj).val().length<2){
           if(ifAlert){
              alert('评论内容至少2个字，请重输入!');
           }
           $('#commentHint').css('color','red')
		   $('#commentHint').html('评论内容至少2个字.');
           $(obj).focus();
           return false;
       }
       return true;
    }
    </script>