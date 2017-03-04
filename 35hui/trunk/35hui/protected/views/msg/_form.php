<style type="text/css">
    table span{color:#FFF; padding-left:15px; font-weight:bold; padding-top:12px; padding-bottom:2px; display:block;}
</style>
<?
$magic_x = 'false';
$magic_y = '200';
$magic_width = '500';
$magic_height = '230';
$msg_subject = "";
if(isset($x)){
    $magic_x = strval($x);
}
if(isset($y)){
    $magic_y = strval($y);
}
if(isset($subject)){
    $msg_subject = $subject;
}
?>
<div id="msgForm" class="form" style="display: none;">
    <table border="0" cellpadding="0" cellspacing="0" width="350">
        <tbody>
            <tr>
                <td width="350">
                    <table border="0" cellpadding="0" cellspacing="0" width="350px">
                        <tr>
                            <td><img src="/images/dialog_lt.png" width="13" height="33" /></td>
                            <td background="/images/dialog_ct.png" width="326px"><span>发送站内信</span></td>
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
                                <table border="0" cellpadding="0" cellspacing="0" style="margin-left:13px; margin-right:13px;line-height: 30px" width="100%">
                                    <tbody>
                                        <tr>
                                            <td style="width:50px;">收信人:</td>
                                            <td align="left"><?=User::model()->getNamebyid($toUserId);?><input id="toUserId" type="hidden" value="<?=$toUserId?>"></td>
                                        </tr>
                                        <tr>
                                            <td>主题:</td>
                                            <td align="left"><input id="title" type="text" value="<?=$msg_subject?>"></td>
                                        </tr>
                                        <tr>
                                            <td>内容:</td>
                                            <td align="left"><textarea id="content" type="text" cols="25" rows="6"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="button" value="发送" onclick="sendMsg()"/>&nbsp;&nbsp;<input type="button" value="取消" onclick="magicDivOpenStart('msgForm',0,0);"/></td>
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
</div><!-- form -->
<script type="text/javascript">
    function sendMsg(){
        var toUserId = $("#toUserId").val();
        var title = $.trim($("#title").val());
        var content = $.trim($("#content").val());
        if(toUserId==""){
            alert("收信人错误!");
        }else if(title==""){
            alert("主题不能为空");
        }else if(content==""){
            alert("内容不能为空");
        }else{
            $.ajax({
                type: 'POST',
                url: '<?php echo Yii::app()->createUrl("/msg/create"); ?>',
                data: {toUserId:toUserId,title:title,content:content},
                success: function(msg){
                    eval("var data = " + msg + ";");
                    magicDivOpenStart('msgForm',0,0);
                    if(data['result']==true){
                        alert(data['warning']);
                    }else{
                        alert(data['warning']);
                    }
                }
            });
        }
    }
    function checkUser(){
        var userid = "<?=Yii::app()->user->id;?>";
        if(userid==""){
            alert("您还没登录，请先登录！");
        }else{
            magicDivOpenStart('msgForm',<?=$magic_width?>,<?=$magic_height?>,<?=$magic_x?>,<?=$magic_y?>);
        }
    }
</script>