<form method="post">
    <table width="300px">
        <tr>
            <td colspan="2" align="center"><input type="radio" checked="checked" value="1" name="loginType">普通用户登录<input type="radio" value="2" name="loginType">经纪人登录</td>
            <td>&nbsp;</td>
        </tr>
        <tr style="line-height: 35px;">
            <td width="60px">用户名：</td>
            <td align="left" width="180px"><input  type="text" style="border: 1px solid #D7D5D6;" id="LoginForm_username" name="LoginForm[username]" /></td>
            <td><a href="<?=Yii::app()->createUrl("/site/personregister");?>">注册</a></td>
        </tr>
        <tr>        
            <td valign="top">密码：</td>
            <td align="left"><input type="password" style="border: 1px solid #D7D5D6" id="LoginForm_password"name="LoginForm[password]"></td>
            <td><a href="/site/findpwd">忘记密码？</a></td>
        </tr>
    </table>
</form>