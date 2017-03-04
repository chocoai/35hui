<?php
$albums = Album::model()->getAlbums($userModel->u_id, "am_updatetime desc", 4);
if($albums) {
    ?>
<div class="zstit"><a href=""><?=$userModel->u_nickname?>最近的展示</a></div>
    <?php
    foreach($albums as $value) {
        ?>
<div class="zss_model">
    <h5 class="zsbg"><em title="图片数"><?=$value->am_photonum?></em> <?=date("Y-m-d",$value->am_updatetime)?></h5>
    <div class="zs_mod_main">
        <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$value->am_id));?>" target="_blank"><img src="<?=Album::model()->getAlbumcoverUrl($value, "_230x250")?>" /></a>
        <p>
            <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$value->am_id));?>" class="zsbg hd" title="红牌数"><?=$value->am_redboard?></a>
            <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$value->am_id));?>" class="zsbg" title="浏览数"><?=$value->am_visitnum?></a>
            <a href="<?=Yii::app()->createUrl("/album/comment",array("id"=>$value->am_id))?>" class="zsbg xd" title="评论数"><?=$value->am_replynum?></a>
        </p>
    </div>
</div>
        <?php
    }
}
?>

<div class="zstit"><a href="" style="font-size: 22px;">大家对<?=$userModel->u_nickname?>的印象</a><em>(共有<?=$memberModel->mem_impressionnum?>人发表观点)</em></div>
<div class="allfeel" id="all_user_impression">
    <?php
    $impression = Userimpression::model()->getImpression($userModel->u_id, 40);
    $color = array("b14a4a","767676","acacac","c8c8c8");
    foreach($impression as $key=>$value) {
        $c = floor($key/5);
        $c>3?$c=3:"";
        ?>
    <a href="javascript:;" style="display:<?=$key>=20?"none":""?>" class="<?=@$color[$c]?>" onclick="addImpression(<?=$value["uic_id"]?>)"><?=$value["uic_content"]?></a>
        <?php
    }
    ?>
</div>
<?php
if(count($impression)>20) {
    echo '<div class="sub_feel" style="padding:0px;margin-right:10px"><a href="javascript:;"  onClick="showMoreImpression(this)">更多</a></div>';
}
?>
<div class="sub_feel">输入其他印象：
    <input type="text" class="txt_06" maxlength="15" id="impression_content"/>
    <input type="button" value="发表" class="btn_11" onClick="impressionContent()"/>
</div>


<div class="zstit"><a href="">大家对韩卓尔评论</a><code>(1254545)</code></div>
<div class="hyleft">
    <?php
    $dataProvider = Membercomment::model()->getMemberCommentDataProvider($userModel->u_id);
    foreach($dataProvider->getData() as $value) {
        $this->renderPartial('_membercomment',array("value"=>$value));
    }
    ?>
    <div style="height: 30px">
        <?php
        $this->widget('CLinkPager',array(
                'pages'=>$dataProvider->pagination,
                "cssFile"=>"/css/pager.css"
        ));
        ?>
    </div>

    <div id="newcomment">
        <div class="pl_tit_t"> 我来说两句：</div>
        <div class="pl_tit">           
            <input type="radio"/>想约会 <input type="radio"/>已约会 给个评价吧：<input type="radio"/>给红牌 <input type="radio"/>给黑牌
        </div>
        <form onsubmit="return submitCommentForm()" method="post" action="#">
            <table>
                <tbody>
                  <tr>
                    <td colspan="2">
                        <textarea style="width: 500px;height: 100px" class="taxt" name="content"></textarea>
                        <input type="hidden" name="userId" value="<?=$userModel->u_id?>">
                    </td>
                </tr>
                <tr><td height="20" colspan="2">&nbsp;</td></tr>
                <tr>
                    <td>
                        <span class="errormsg" style="color:red"></span>
                    </td>
                    <td align="right"><input type="submit" value="评论" class="btn_02"></td>
                </tr>
            </tbody></table>
        </form>
    </div>
</div>
<?php
$this->renderPartial('/userspeak/_boardorder');
?>
<div id="loginForm" style="display:none">
    <?=$this->renderPartial('/user/_loginform');?>
</div>
<script type="text/javascript">
    var moreImpression = 0;
    function showMoreImpression(obj){
        if(moreImpression){
            moreImpression = 0;
            $("#all_user_impression a").slice(20).each(function(){
                $(this).css("display","none");
            })
            $(obj).html("更多")
        }else{
            moreImpression = 1;
            $("#all_user_impression a").slice(20).each(function(){
                $(this).css("display","");
            })
            $(obj).html("收起")
        }
    }
    function impressionContent(){
        var content = $.trim($("#impression_content").val());
        if(content==""){
            jw.pop.alert("印象不能为空",{autoClose:1000,icon:2});
        }else{
            $.post("/userimpression/create",{"content":content,"uid":<?=$userModel->u_id?>},function(msg){
                if(msg=="success"){
                    jw.pop.alert("印象添加成功",{autoClose:1000});
                    setTimeout(function(){window.location.reload()},1000);
                }else{
                    jw.pop.alert(msg,{autoClose:1000,icon:2});
                }
            },"text");
        }
    }
    function addImpression(id){
        $.post("/userimpression/create",{"contentId":id,"uid":<?=$userModel->u_id?>},function(msg){
            if(msg=="success"){
                jw.pop.alert("印象添加成功",{autoClose:1000});
                setTimeout(function(){window.location.reload()},1000);
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2});
            }
        },"text");
    }
    var oldUsername = "";
    function submitCommentForm(){
        var content = $.trim($("#newcomment textarea[name='content']").val());
        if(content==""){
            $("#newcomment .errormsg").html("不能为空！");
            return false;
        }
        if(txtNum_func(content)>500){
            $("#newcomment .errormsg").html("超过最大可输入长度！");
            return false;
        }
        var userId = "<?=User::model()->getId()?>";
        if(!userId){//没有登录
            var content = "<div id='alertFrom' style='width:260px' >"+$("#loginForm").html()+"</div>"
            jw.pop.customtip("用户登录",content,
            {
                hasBtn_ok:true,
                hasBtn_cancel:true,
                ok: function(){
                    oldUsername = $("#alertFrom input[name='username']").val();
                    $.post("/site/index", $("#alertFrom form").serialize(), function(msg){
                        if(msg=="error"){
                            jw.pop.alert("用户名或者密码错误",{autoClose:1000,icon:2})
                        }else{
                            submitComment();
                        }
                    }, "text")
                },
                btn_float:"center"
            });
            $("#alertFrom input[name='username']").val(oldUsername);
            return false;
        }
        submitComment();
        return false;
    }
    function submitComment(){
        $.post("/membercomment/create", $("#newcomment form").serialize(), function(msg){
            if(msg=="success"){
                jw.pop.alert("评论成功",{autoClose:1000});
                setTimeout(function(){
                    window.location.reload();
                },1000);
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2})
            }
        }, "text")
    }
    function memberCommentSupport(obj){
        var id = $(obj).attr("attr");
        $.post("/membercommentsupport/create", {"id":id}, function(msg){
            if(msg=="success"){
                var old = parseInt($(obj).prev("span").html());
                $(obj).prev("span").html(old+1)
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2})
            }
        }, "text")
    }
</script>