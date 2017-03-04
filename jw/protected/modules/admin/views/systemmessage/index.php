<?php
$this->breadcrumbs=array(
        '发送系统消息',
);?>
<form action="#" method="post" onsubmit="return checkForm()">
    <table>
        <tr>
            <td align="right">接收者ID：</td>
            <td><input name="userid" value="" type="text" />(不填表明要发送给所有用户)</td>
            <td><span class="errormsg"></span></td>
        </tr>
        <tr>
            <td align="right" valign="top">内容：</td>
            <td><textarea rows="10" cols="60" name="content"></textarea></td>
            <td valign="top"><span class="errormsg"></span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td align="right"><input type="submit" value="发布" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <img src="/images/loading.gif" id="loadingPic" style="display: none" alt="" />
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    function checkForm(){
        var userId = $.trim($("form input[name='userid']").val());
        $("form .errormsg").each(function(){
            $(this).html("");
        })
        if(userId){
            var preg = /^[0-9]*$/;
            if(!preg.test(userId)){
                $("form .errormsg").eq(0).html("ID为由数字组成");
                return false;
            }
        }
        var content = $.trim($("form textarea[name='content']").val());
        if(!content){
            $("form .errormsg").eq(1).html("消息内容不能为空");
            return false;
        }
        if(userId==""){
            jw.pop.alert(
            "确定要给所有用户发布本消息吗？",
            {
                ok: function(){create()},
                hasBtn_ok:true,
                ok_label:'确定',
                hasBtn_cancel:true,
                icon:4
            });
        }else{
            create();
        }
        return false;
    }
    function create(){
        $("#loadingPic").css("display","block");
        $.post("/admin/systemmessage/create", $("form").serialize(), function(msg){
            $("#loadingPic").css("display","none");
            if(msg=="success"){
                jw.pop.alert("消息发布成功",{autoClose:1000});
                setTimeout(function(){
                    window.location.reload();
                },1000)
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2});
            }
        }, "text")
    }
</script>
