<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); if(CURMODULE != 'logging') { ?>
<form method="post" autocomplete="off" id="lsform" action="/site/login">
    <div class="fastlg cl">
        <span id="return_ls" style="display:none"></span>
        <div class="y pns">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td><label for="ls_username">用户名</label></td>
                    <td><input type="text" name="LoginForm[username]" id="ls_username" autocomplete="off"class="px vm" tabindex="901" /></td>

                    <td class="fastlg_l"></td>
                    <td>&nbsp;<a href="/site/findPwd">找回密码</a></td>
                </tr>
                <tr>
                    <td><label for="ls_password"<?php if(!$_G['setting']['autoidselect']) { ?> class="z psw_w"<?php } ?>>密码</label></td>
                    <td><input type="password" name="LoginForm[password]" id="ls_password" class="px vm" autocomplete="off" tabindex="902" /></td>
                    <td class="fastlg_l"><button type="submit" class="pn vm" tabindex="904" style="width:75px;"><em>登录</em></button></td>
                    <td>&nbsp;<a href="/site/register" class="xi2 xw1"><?php echo $_G['setting']['reglinkname'];?></a></td>
                </tr>
            </table>
        </div>
        <?php if(!empty($_G['setting']['pluginhooks']['global_login_extra'])) echo $_G['setting']['pluginhooks']['global_login_extra'];?>
    </div>
</form>
<?php } ?>