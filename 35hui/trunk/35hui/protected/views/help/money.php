<style type="text/css">
    table{margin-top:10px; border-collapse: collapse;}
    table th,table td{ text-indent:2em;}
    table th{height:40px; line-height:40px; color:#333; font-weight:normal;}
    table td{height:35px; line-height:35px; }
    table th img{margin-right:10px; padding-top:3px; margin-bottom:-5px;}
    table td, table th{border-collapse:collapse; border-bottom:1px solid #E3E1E1;}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<div class="container">
    <?=$this->renderPartial('_leftMenu');?>
    <div class="right">
            <div class="rtitle">
                <div class="rtitlefont">新地标会员获取积分方式一览：</div>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <th width="80%"><img src="/images/credit_card.gif" /><b>获取方式</b></th>
                        <th width="20%"><img src="/images/gift.gif" /><b>积分</b></th>
                    </tr>
                    <tr>
                        <td width="80%">经纪人通过身份认证</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('ua_identify_audit');?>
                        <td  width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">经纪人通过名片认证</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('ua_practice_audit');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">经纪人通过公司认证</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('ua_license_audit');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">发布楼盘动态被采纳</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('bindTwitter');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">楼盘纠错被采纳</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('dealError');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">成功上传一套新全景图</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('uploadPanoramaPicAndSucBinding');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">注册个人用户和经纪人每天第一次登录</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('day_login_first');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">中介公司每天第一次登录</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('day_login_ucom');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">邀请的用户注册了经纪人并通过所有认证</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('invite_uagent');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                    <tr>
                        <td width="80%">邀请的用户注册了中介公司并通过运营认证</td>
                        <?php $data=Oprationconfig::model()->getConfigByName('invite_ucom');?>
                        <td width="20%"><?=$data[1]?></td>
                    </tr>
                </table>
            </div>
    </div>
    <div style="clear:both"><!--自适应高度需要本层--></div>
</div>