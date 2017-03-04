<style type="text/css">
    table span{color:#FFF; padding-left:15px; font-weight:bold; padding-top:12px; padding-bottom:2px; display:block;}
</style>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/magicDiv.js"></script>
<div id="reports" style="display:none;">
    <form>
        <table border="0" cellpadding="0" cellspacing="0" width="350">
            <tbody>
                <tr>
                    <td width="350">
                        <table border="0" cellpadding="0" cellspacing="0" width="350px">
                            <tr>
                                <td><img src="/images/dialog_lt.png" width="13" height="33" /></td>
                                <td background="/images/dialog_ct.png" width="326px"><span>举报虚假信息</span></td>
                                <td width="13px"><img src="/images/dialog_rt.png" width="13" height="33" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="350px">
                            <tr>
                                <td background="/images/dialog_mlt.png" width="13px"></td>
                                <td bgcolor="#FFFFFF">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-left:13px; margin-right:13px;">
                                        <tbody>
                                            <tr>
                                                <td width="70px">举报类型：</td>
                                                <td>
                                                    <input type="radio" name="rtype" value="1" checked="check">房源已售或不存在<br/>
                                                    <input type="radio" name="rtype" value="2">价格、面积严重失实<br/>
                                                    <input type="radio" name="rtype" value="3">图片、房源介绍等资料失实
                                                </td>
                                            </tr>
                                            <?
                                                if(Yii::app()->user->isGuest){
                                            ?>
                                            <tr  style="line-height:30px">
                                                <td>用户名：</td>
                                                <td><input type="text" id="username" name="username" />(选填)</td>
                                            </tr>
                                            <tr  style="line-height:30px">
                                                <td>手机号码：</td>
                                                <td><input id="telephone" type="text" name="telphone"  />(选填)</td>
                                            </tr>
                                            <tr  style="line-height:30px">
                                                <td>Email：</td>
                                                <td><input id="email" type="text" name="email" />(选填)</td>
                                            </tr>
                                            <?
                                                }
                                            ?>
                                            <?php if(extension_loaded('gd')){ ?>
                                            <tr style="line-height:30px">
                                                <td>验证码：</td>
                                                <td><input type="text" name="verify" /></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><?php $this->widget('CCaptcha',array('captchaAction'=>'officebaseinfo/captcha')); ?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="userId" value="<?=$suspectUserId?>"/>
                                                    <input type="hidden" name="buildId" value="<?=$sourceId?>"/>
                                                    <input type="hidden" name="buildType" value="<?=$sourceType?>"/>
                                                </td>
                                                <td>
                                                    <input type="button" value="立即举报" onclick="sub()" />
                                                    <input type="button" value="取消举报" onclick="toggleDiv()"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="20px"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td background="/images/dialog_mrb.png" width="13px"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="350px" style="margin:0; padding:0">
                            <tr>
                                <td><img src="/images/dialog_lb.png" width="13" height="13" /></td>
                                <td background="/images/dialog_cb.png" width="100%"></td>
                                <td><img src="/images/dialog_rb.png" width="13" height="13" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript" language="javascript">
    var isSelf = '<?=Yii::app()->user->id==$suspectUserId?"yes":"no"?>';
    //获取举报类型
    $("<?="#".$triggerId?>").live("click", function(){
        if(isSelf=="yes"){
            alert("对不起,你不能自己举报自己.");
        }else{
            toggleDiv();
        }
    });
    $("#telephone").blur(function(){
        var tel = $(this).val();
        checkTel(tel);
    });
    $("#email").blur(function(){
        var email = $(this).val();
        checkMail(email);
    });
 	function raclick(v){
		$("#rt").val(v);
	}
    //切换举报窗口显示状态
	function toggleDiv(){
        magicDivOpenStart('reports',350,300,400,200);
    }
    function checkTel(v){
		if(v){
			var	PhoReg=/(^0{0,1}1[3|4|5|6|7|8|9][0-9]{9}$)/ ; //手机验证
			var check=PhoReg.test(v);
			if(!check){
				alert("手机号码格式不正确！");
				return false;
			}
		}
        return true;
	}
	function checkMail(v){
		if(v){
			var mailReg=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;  //邮箱检测
			var check=mailReg.test(v);
			if(!check){
				alert("邮箱格式不正确！");
				return false;
			}
		}
        return true;
	}
    //ajax提交表单
    function sub(){
        var tel = $("#telephone").val();
        var telCheck = checkTel($("#telephone").val());
        var mailCheck = checkMail($("#email").val());
        if(telCheck==true && mailCheck==true){
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl("/officebaseinfo/createreport"); ?>',
                data: $("form").serialize(),
                success: function(msg){
                    toggleDiv();
                    alert(msg);
                }
            });
         }
	}
</script>