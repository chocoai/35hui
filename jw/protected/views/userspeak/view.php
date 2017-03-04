<?php
$this->topbreadcrumbs = array(
    "展示"=>array("/member/list"),
    $userModel->u_nickname=>array("/user/view","id"=>$userModel->u_id),
    "我的动态"=>array("/userspeak/index","id"=>$userModel->u_id),
    $speakModel->us_id,
);
?>
<div class="hyleft">
    <div class="hyline">
        <div class="hypic">
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="60px" height="60px"></a>
        </div>
        <div class="hytxt">
            <div class="hytit"><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>"><?=$userModel->u_nickname?></a> 说：</div>
            <p style="word-wrap:break-word;word-break:break-all;"><?=CHtml::encode($speakModel->us_content)?></p>
            <div class="hymsg"><?=date("Y-m-d H:i",$speakModel->us_creattime);?> 评论（<?=$speakModel->us_replynum?>） </div>
        </div>
    </div>

    <?php
    foreach($dataProvider->getData() as $value) {
        $this->renderPartial('_comment',array("value"=>$value));
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
        <form onsubmit="return submitCommentForm()" method="post" action="#">
            <table>
                <tr>
                    <td colspan="2">
                        <textarea style="width: 500px;height: 100px" class="taxt" name="content"></textarea>
                        <input type="hidden" name="speakId" value="<?=$speakModel->us_id?>" />
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="评论" class="btn_02"/></td>
                    <td align="right">
                        <span class="errormsg" style="color:red"></span>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
$this->renderPartial('_boardorder');
?>
<div id="loginForm" style="display:none">
    <?=$this->renderPartial('/user/_loginform');?>
</div>
<script type="text/javascript">
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
        $.post("/userspeak/addspeakcomment", $("#newcomment form").serialize(), function(msg){
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
</script>

