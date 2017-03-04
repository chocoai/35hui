<style type="text/css">
    .title{margin: 0px auto;width: 230px}
    table{margin: 0px auto;border: 1px solid #C9E0ED;}
</style>
<form action="" method="post" onsubmit="return checkForm()">
    <div class="title"><h4>登录</h4></div>
    <table width="230px">
        <tr>
            <td align="right">用户名：</td>
            <td><input name="adminname" value="root" type="text" disabled /></td>
        </tr>
        <tr>
            <td align="right">密码：</td>
            <td>
                <input name="adminpassword" value="" type="password" />
                <?=$show?"<br /><font color='red' id='showerrormsg'>".$show."</font>":""?>
            </td>
        </tr>
        
        <tr>
            <td>&nbsp;</td>
            <td align="right"><input type="submit" value="登录" /></td>
        </tr>
    </table>
</form>
<script type="text/javascript">
function checkForm(){
    var password = $("form input[name='adminpassword']").val();
    if(password==""){
        $("#showerrormsg").html("请输入密码！");
        return false;
    }
    return true;
}
</script>