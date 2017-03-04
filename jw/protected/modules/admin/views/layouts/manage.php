<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
        <title>管理后台</title>
        <link href="/js/common/common.css" rel="stylesheet" />
        <link href="/css/manage/css.css" rel="stylesheet" type="text/css" />
        <script src="/js/jquery.js" type="text/javascript"></script>
    </head>
    <body>

        <div class="top_img" align="right">
            <div class="logininfo">
                您好，管理员！<a href="/admin/manageuser/logout">退出</a>！
            </div>
        </div>
        <div class="mid">
            <div class="left">
                <div class="left2">
                    <div class="left2_1"><img src="/images/manage/left2_01.jpg" /></div>
                    <?=$this->renderPartial('/layouts/_leftmenu');?>
                    <div class="left2_1"><img src="/images/manage/left2_02.jpg" /></div>
                </div>
            </div>
            <div class="right">
                <div class="right1">
                    <div class="def">现在的位置：</div>
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            "homeLink"=>CHtml::link("后台管理","/admin"),
                            'links'=>$this->breadcrumbs,
                    )); ?>
                </div>
                <div class="right2" align="center">
                    <div class="right2_tt" align="left">
                        <?php echo $content; ?>
                    </div>
                </div>
                <div class="right3"><img src="/images/manage/right_b_03.jpg" /></div>
            </div>
        </div>
        <div style=" clear:both;"></div>
        <div class="btt" align="center">
            <table width="98%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" align="right">版权所有：<?=DOMAIN?></td>
                </tr>
            </table>
        </div>
        <script src="/js/common/common.js" type="text/javascript"></script>
    </body>
</html>
