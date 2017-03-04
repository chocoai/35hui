<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
    "小区搜索"=>array("searchIndex"),
    CHtml::encode($model->comy_name),
);

?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/zhai.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<style type="text/css">
    .fydj{margin-top:10px;}
    ul,li{margin:0; padding:0;}
    .serach_moremenu{ padding-left: 0;}
    .serach_morelefttwobox{border:1px solid #ccc; width:713px;}
    .pager{clear:both;float: right;}
</style>
<div class="xiezilou_left">
    <h1><?=@CHtml::encode($model->comy_name)?></h1>
</div>
<ul class="serach_moremenu">
    <li class="two"id="louright1"><strong><?=CHtml::link("小区概况",array("communitybaseinfo/view","id"=>$model->comy_id))?></strong></li>
    <li class="two" id="louright2"><strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/sellIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($model->comy_name)))?>">二手房(<?=$model->getNums($model->comy_id,2)?>套)</a></strong></li>
    <li class="two" id="louright3"><strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/rentIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($model->comy_name)))?>">租房(<?=$model->getNums($model->comy_id,1)?>套)</a></strong></li>
    <li class="two" id="louright4"><strong><?=CHtml::link("小区图片",array("communitybaseinfo/picture","id"=>$model->comy_id))?></strong></li>
    <li class="one" id="louright5">
        <strong>
            <?=CHtml::link("小区点评",array("communitybaseinfo/comment","id"=>$model->comy_id))?>
        </strong>
    </li>
</ul>
<div class="serach_morelefttwobox">
    <div class="fbdianpin">
        <div>
        <?php
            $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$commentsProvider,
                    'itemView'=>'_singleComment',
            ));
        ?>
        </div>
        <div class="loupaninfo_fivelinerightbox">
              <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'communitycomment-form',
                    'action'=>'/communitybaseinfo/addcomment/id/'.$model->comy_id,
                    'enableAjaxValidation'=>true,
                    'htmlOptions'=>array('onSubmit'=>'if(!check_xing(this))return false;')
            )); ?>
            <dl>
                <dd style="color: rgb(235, 147, 60);">点评内容&nbsp;<font style="color: red;">*</font>&nbsp;：<span id="commentHint" style="color:gray">( 0-3000个字符 )</span></dd>
                <dd>
                    <?php echo $form->textArea($newComment,'comyc_comment',array('class'=>'content f12px','id'=>'oc_comment','maxlength'=>3000,'onkeyup'=>'keyPressCheck(this)','onblur'=>'check_comment_content(this,false)')); ?>
                </dd>
                <dd>
                <?php
                    if(Yii::app()->user->isGuest) {
                ?>
                    <button id="yt0" type="button" name="yt0" style="background:url(/images/loupan.gif) no-repeat scroll 0pt -1580px transparent; border: medium none; color: rgb(255, 255, 255); cursor: pointer; display: block; height: 24px; left: 95px; line-height: 24px; margin: 3px auto 0pt; overflow: hidden; position: relative; top: 0pt; width: 74px;" class="loupaninfo_submitthree" onclick="window.location.href='/site/login';">请先登录</button>
                     &nbsp;&nbsp;(<a href="<?=Yii::app()->createUrl("site/login")?>">登录</a>后才能发表评论)
                <?php
                    }else {
                        echo CHtml::Button('提交点评',array('class'=>"loupaninfo_submitthree",'onclick'=>'addComment()','style'=>'background: url("/images/loupan.gif") no-repeat scroll 0 -1580px transparent;
                            border: medium none;
                            color: rgb(255, 255, 255);
                            cursor: pointer;
                            display: block;
                            height: 24px;
                            left: 95px;
                            line-height: 24px;
                            margin: 3px auto 0;
                            overflow: hidden;
                            position: relative;
                            top: 0px;
                            width: 74px;'));
                }
                ?>
                </dd>
            </dl>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function keyPressCheck(obj){
        if($(obj).val().length>1000){
            $(obj).val($(obj).val().substring(0,3000));
        }else{
            var len=$(obj).val().length;
            if(len){
                var num=3000-len;
                if(num){
                    $('#commentHint').css('color','green')
                    $('#commentHint').html('您还可以输入'+num+'个字符');
                }else{
                    $('#commentHint').css('color','red')
                    $('#commentHint').html('抱歉，您输入的字符已达上限!多余字符已被截去.');
                }
            }else{
                $('#commentHint').html('评论内容至少2个字.');
                $('#commentHint').css('color','red');
                //$('#commentHint').html('注：评论后内容<span style="color:#EB933C">不可更改</span>，请慎重输入!</span>');
            }
        }
    }
    function check_comment_content(obj,ifAlert){
        if($(obj).val().length<2){
            var str='评论内容至少2个字.';
            if(ifAlert){
                alert('评论内容至少2个字，请重新输入!');
            }
            $('#commentHint').css('color','red')
            $('#commentHint').html(str);
            if($('#commentHint').html() !=str){
                $(obj).focus();
            }
            return false;
        }
        return true;
    }
    function addComment(){
        if(!check_comment_content($('#oc_comment'),true))return false;
        $.ajax({
            type:"post",
            url:"<?=Yii::app()->createUrl('/communitybaseinfo/addcomment/id/'.$model->comy_id)?>",
            data: $("#communitycomment-form").serialize(),
            success: function(Msg){
                alert(Msg);
                if(Msg =='发表评论成功!' || Msg =='发表评论成功！'){
                    window.location.href=window.location.href;
                }
            }
        });
    }
</script>
