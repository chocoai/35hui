<div class="xcpline" id="newcomment">
    <div class="pl_tit"><a href="<?=Yii::app()->createUrl("/album/comment",array("id"=>$albumModel->am_id));?>">查看更多评论</a>我来说两句，给张牌；可选<input type="radio"/>给红牌 <input type="radio"/>给黑牌</div>
    <form onsubmit="return submitCommentForm()" method="post" action="#">
        <table>
            <tr>
                <td colspan="2">
                    <textarea style="width: 500px;height: 100px" class="taxt" name="content"></textarea>
                    <input type="hidden" name="albumId" value="<?=$albumModel->am_id?>" />
                </td>
            </tr>
            <tr><td colspan="2" height="20">&nbsp;</td></tr>
            <tr>
                <td>
                    <span class="errormsg" style="color:red"></span>
                </td>
                <td align="right"><input type="submit" value="发表" class="btn_02"/></td>
            </tr>
        </table>
    </form>
</div>
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
        $.post("/album/addcomment", $("#newcomment form").serialize(), function(msg){
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