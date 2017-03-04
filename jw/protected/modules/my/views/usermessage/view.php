<div class="zftnav">
    <ul>
        <li <?=$userId==$userMessageModel->um_userid?'class="clk"':""?> onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage");?>'" style="cursor: pointer">收件箱</li>
        <li <?=$userId==$userMessageModel->um_fromid?'class="clk"':""?> onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage/sendindex");?>'" style="cursor: pointer">发件箱</li>
        <li onclick="location.href='<?=Yii::app()->createUrl("/my/systemmessage");?>'" style="cursor: pointer">系统消息</li>
    </ul>
</div>
<div class="jbmain">
    <div style="float: right">
        <span style="cursor:pointer" onclick="goback()">返回</span>
    </div>
    <table style="width: 100%;line-height: 30px">
        <tr>
            <td width="50px">标题：</td>
            <td><?=$userMessageModel->um_title?></td>
        </tr>
        <tr>
            <td>内容：</td>
            <td><?=$userMessageModel->um_content?></td>
        </tr>
        <tr>
            <td>时间：</td>
            <td><?=date("Y-m-d H:i",$userMessageModel->um_createtime)?></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
function goback(){
    var url = "<?=$userId==$userMessageModel->um_userid?'/my/usermessage':"/my/usermessage/sendindex"?>";
    window.location.href = url;
}
</script>