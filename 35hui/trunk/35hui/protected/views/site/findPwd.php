<style type="text/css">  body{margin:0 auto; text-align:center;}</style>
<?php
$this->pageTitle = "新地标";
?>
<style type="text/css">
.vessel{width: 100%;height: 500px;float:left;border: 1px solid #eeeeee;}
.mid_frame{ width:670px;height: 400px;margin: 40px auto;border: 1px solid #A8E1E9;}
.top_bar{ background-color: #BDE4E9;width: 100%;height: 30px;}
.h_font{ font-size: 14px;font-weight: bold;color: #333;line-height: 30px;margin-left: 5px;}
.c_content{ width: 450px;height: 250px;margin: 60px auto 0px; text-align: left;}
.tb_content{  width:100%;}
.tb_content tr{ height: 30px;}
.tit_font{ font-size: 14px;line-height: 30px;}
</style>
<div class="vessel">
    <div class="mid_frame">
        <div class="top_bar">
            <span class="h_font">找回密码</span></div>
            <div class="c_content">
                <?
                    if($result){
                ?>
                <div style="margin-top:110px;margin-left: 30px;float:left;">申请密码找回成功,新的密码已经发送到了你的安全邮箱.请注意查收.</div>
                <?
                    }else{
                ?>
                <form method="post" action="<?=Yii::app()->createUrl('site/findPwd',array('s'=>1));?>">
                    <table class="tb_content" >
                        <tr>
                            <td class="tit_font"><span class="red">*</span>用户名：</td>
                            <td>
                                <input type="text" name="username">
                                <span class="red"><?=isset($errors['username'])?$errors['username']:""?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="tit_font"><span class="red">*</span>注册时的安全邮箱：</td>
                            <td>
                                <input type="text" name="email">
                                <span class="red"><?=isset($errors['email'])?$errors['email']:""?></span>
                            </td>
                        </tr>
                        <?php if(extension_loaded('gd')): ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <?php $this->widget('CCaptcha'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="tit_font"><span class="red">*</span>验证码：</td>
                            <td>
                                <input type="text" name="virifyCode">
                                <span class="red"><?=isset($errors['virifyCode'])?$errors['virifyCode']:""?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style="padding-top: 10px;">
                                <input type="image" src="/images/submit.gif" />
                            </td>
                        </tr>
                        <?php endif; ?>
                    </table>
                </form>
                <?
                    }
                ?>
            </div>
        
    </div>
</div>