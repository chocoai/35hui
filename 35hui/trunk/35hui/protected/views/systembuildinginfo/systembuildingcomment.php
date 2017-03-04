<style type="text/css">
	.submit_bg {position: relative;	text-align: center;	top:2px;top:13px\9;	top:12px\0;	*top:2px;_top:4px;	width: 111px;}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
		.submit_bg {padding-top:12px;position:relative;	top:6px;}
	}
</style>
<?php
$sbi_city = Region::model()->getNameById($model->sbi_city);
$sbi_district = Region::model()->getNameById($model->sbi_district);
$sbi_section = Region::model()->getNameById($model->sbi_section);
$sbi_buildingname = $model->sbi_buildingname;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'写字楼,'.$sbi_buildingname.'写字楼租赁,360°全景看房';
$description='找'.$sbi_city.'出售房源和租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
Yii::app()->clientScript->registerScriptFile("/js/jquery.js");?>
<script src="/js/jquery.rating.js"></script>

    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->sbi_buildingname,array('systembuildinginfo/view','id'=>$model->sbi_buildingid)) ?>&gt;<em>评论</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"comment")); ?>
<link rel="stylesheet" type="text/css" href="/css/index.css" />
<link href="/css/adjustsearch.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="/css/seardetail.css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/buildingcmtlist.css" rel="stylesheet" type="text/css" >
<div id="center">
    <div class="detail"></div>
    <!--banner end-->
    <div id="loup">
        <div id="two_left">
		  <div class="one-column-main">
            <ul class="feed_list" id="feed_list_container2" style="float:right;">
                <?if(isset($_GET["sort"])&&$_GET["sort"]=="vote"){?>
                <a href="<?php $newGet=$_GET;$newGet["sort"]="time"; echo $this->createUrl('view',$newGet) ?>">按时间排序</a>&nbsp;/&nbsp;按投票排序
                <?}else{?>
                &nbsp;按时间排序/&nbsp;<a href="<?php $newGet=$_GET;$newGet["sort"]="vote"; echo $this->createUrl('view',$newGet) ?>">按投票排序</a>
                <?}?>
                
            </ul>
            <ul class="feed_list" id="feed_list_container">
        <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$comments,
                'itemView'=>'_systembuildingcomment',
                'summaryText'=>'共有<strong>{count}</strong>条评论',
                'summaryCssClass'=>'',
                'emptyText'=>'最近点评',
                "cssFile"=>"/css/pager.css",
            ));
            ?>
	</ul>          
    <div id="page_nav" ></div>
</div>
    </div><!--two_left end-->
</div>
    <div class="clear"></div>
          <div class="loupaninfo_fivelinerightbox">
              <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'systembuildingcomment-form',
                    'action'=>'/systembuildinginfo/addcomment/id/'.$model->sbi_buildingid,
                    'enableAjaxValidation'=>true,
                    'htmlOptions'=>array('onSubmit'=>'return false;')
            )); ?>
              <b style="float:left;">给个评价吧?(可选)：</b>
                    <?php
                    $this->widget('CStarRating',array('name'=>'sbc_evaluation',"allowEmpty"=>false,"ratingStepSize"=>2,"minRating"=>2,"maxRating"=>10,"titles"=>array(2=>"非常差",4=>"有点差",6=>"中等",8=>"一般好",10=>"极品好")));
                  ?>
            <dl>
                <dd style="color: rgb(235, 147, 60);">点评内容&nbsp;<font style="color: red;">*</font>&nbsp;：<span id="commentHint" style="color:gray">( 0-500个字符 )</span></dd>

                <dd>
                    <?php $newComment=new Systembuildingcomment;
                    echo $form->textArea($newComment,'sbc_comment',array('style'=>'width:600px;' ,'id'=>'oc_comment','maxlength'=>500,'onkeyup'=>'keyPressCheck(this)','onblur'=>'check_comment_content(this,false)')); ?>
                </dd>
                <dd>
                   <?php
                        echo $form->hiddenField($newComment,'sbc_cid',array("value"=>Yii::app()->user->id));
                        echo $form->hiddenField($newComment,'sbc_buildingid',array("value"=>$model->sbi_buildingid));
                        echo $form->hiddenField($newComment,'sbc_evaluation',array("value"=>0));
                        echo $form->hiddenField($newComment,'sbc_num',array("value"=>0));
                        echo $form->hiddenField($newComment,'sbc_comdate',array("value"=>time()));
                        echo $form->textField($newComment,'verify',array("class"=>"txt_6","style"=>"margin-top:15px"));
                        $this->widget('CCaptcha',array("buttonLabel"=>"","clickableImage"=>true,"imageOptions"=>array("title"=>"看不清？点击更换。")));
                    ?>
                </dd>
                <dd>
                     <?php
                        echo CHtml::Button('提交点评',array('onclick'=>'addComment()','style'=>'background: url("/images/loupan.gif") no-repeat scroll 0 -1580px transparent;width: 74px; border:0; height:26px; line-height:26px; color:#fff;'));
                     ?>
                </dd>
            </dl>
            <?php $this->endWidget(); ?>
        </div>
</div> <!--center end-->
<div id="albumform" style="display: none">
    <?=$this->renderPartial('_albumform');?>
</div>
<?
Yii::app()->clientScript->registerCssFile("/js/common/common.css");

Yii::app()->clientScript->registerScriptFile("/js/common/common.js");
?>
<script type="text/javascript">

    function createAlbum(){
           var content = "<div id='alertform'>"+$("#albumform").html()+"</div>";
            jw.pop.customtip(
            "用户登录",
            content,
            {
                hasBtn_ok:true,
                hasBtn_cancel:true,
                zIndex:10000,
                ok: function(){
                    var username = $.trim($("#alertform form input[name='LoginForm[username]']").val());
                    var password = $.trim($("#alertform form input[name='LoginForm[password]']").val());
                    var loginType = $("#alertform form input[name='loginType']:checked").val();
                     var url="<?=Yii::app()->createUrl("/site/login");?>"
                    if(username==""){
                        jw.pop.alert("请输入用户名！",{
                            zIndex:10001,
                            icon:2
                        });
                        return false;
                    }
                    if(password==""){
                        jw.pop.alert("请输入密码！",{
                            zIndex:10001,
                            icon:2
                        });
                        return false;
                    }
                    if(loginType==2){
                        url="<?=Yii::app()->createUrl("/site/agentlogin");?>";
                    }
                    $.post(url,$("#alertform form").serialize(),function(msg){
                        jw.pop.alert(msg,{
                            zIndex:10001,
                            icon:2
                        });
                        if(msg=="账户名或密码错误"){
                           createAlbum();
                        }
                        if(msg=="登录成功"){
                            window.location.reload();
                        }
                    },"html")
                },
                btn_float:"center"
            }
        );
    }
    function keyPressCheck(obj){
        if($(obj).val().length>1000){
            $(obj).val($(obj).val().substring(0,500));
        }else{
            var len=$(obj).val().length;
            if(len){
                var num=500-len;
                if(num>=0){
                    $('#commentHint').css('color','green')
                    $('#commentHint').html('您还可以输入'+num+'个字符');
                }else{
                    $('#commentHint').css('color','red')
                    $('#commentHint').html('抱歉，您输入的字符已达上限!多余字符已被截去.');
                }
            }else{
                $('#commentHint').html('评论内容至少2个字.');
                $('#commentHint').css('color','red');
            }
        }
    }
    function check_comment_content(obj,ifAlert){
        if($(obj).val().length<2){
            var str='评论内容至少2个字.';
            if(ifAlert){
                 jw.pop.alert('评论内容至少2个字，请重新输入!',{
                            zIndex:10001,
                            icon:2
                        });
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
    function addCommentLog(id,obj){
        var chec = <?=Yii::app()->user->isGuest?"1":"0" ?>;
        if(chec){
            createAlbum();
            return false;
        }
        $.ajax({
            type:"post",
            url:"<?=Yii::app()->createUrl('/systembuildinginfo/addcommentlog')?>",
            data: {"sbcl_cid":id},
            success: function(Msg){
                if(!Msg){
                  $(obj).parent("div").find("span").html( $(obj).parent("div").find("span").html()/1+1);
                }else{
                     jw.pop.alert(Msg,{
                            zIndex:10001,
                            icon:2
                        });
                }
            }
        });

    }
    function addComment(){
        var chec = <?=Yii::app()->user->isGuest?"1":"0" ?>;
        if(!check_comment_content($('#oc_comment'),true))return false;
        if(chec){
            createAlbum();
            return false;
        }
        $.ajax({
            type:"post",
            url:"<?=Yii::app()->createUrl('/systembuildinginfo/addcomment/id/'.$model->sbi_buildingid)?>",
            data: $("#systembuildingcomment-form").serialize(),
            success: function(Msg){
                 jw.pop.alert(Msg,{
                            zIndex:10001,
                            icon:2
                        });
                if(Msg =='发表评论成功!' || Msg =='发表评论成功！'){
                    window.location.href="<?=Yii::app()->createUrl("/systembuildinginfo/view/id/{$_GET['id']}/tag/comment");?>";
                }
            }
        });
    }

</script>

