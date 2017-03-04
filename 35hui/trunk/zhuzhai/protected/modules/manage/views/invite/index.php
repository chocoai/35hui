<?php
$this->breadcrumbs=array(
        '邀请好友注册',
);
?>
<div class="htit">邀请好友注册</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td style="text-align: center;" valign="top">通过QQ、MSN、电子邮件发送邀请链接给你的朋友</td>
        </tr>
        <tr>
            <td><input type="text" id="invitelink" onfocus="this.select()" value="<?=DOMAIN.'/site/register/recuid/'.Yii::app()->user->id ?>" size="80" />&nbsp;<a href="javascript:copyToClipboard($('#invitelink').val());" style="color: blue">复制链接</a></td>
        </tr>
    </table>
</div>


<script type="text/javascript">
    function copyToClipboard(txt) {
        if(window.clipboardData) {
            window.clipboardData.clearData();
            window.clipboardData.setData("Text", txt);
            alert("复制成功！")
        } else if(navigator.userAgent.indexOf("Opera") != -1) {
            window.location = txt;
        } else if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
            } catch (e) {
                alert("被浏览器拒绝！请手动复制");
            }
            var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
            if (!clip)
                return;
            var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
            if (!trans)
                return;
            trans.addDataFlavor('text/unicode');
            var str = new Object();
            var len = new Object();
            var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
            var copytext = txt;
            str.data = copytext;
            trans.setTransferData("text/unicode",str,copytext.length*2);
            var clipid = Components.interfaces.nsIClipboard;
            if (!clip)
                return false;
            clip.setData(trans,null,clipid.kGlobalClipboard);
            alert("复制成功！")
        }else{
            alert("被浏览器拒绝！请手动复制");
        }
    }

</script>