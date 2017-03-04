<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/js/common/common.css" rel="stylesheet" />
        <link href="/css/global.css" rel="stylesheet" type="text/css" />
        <link href="/css/css.css" rel="stylesheet" type="text/css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script src="/js/jquery.js" type="text/javascript"></script>
    </head>
    <body>
        <?=$this->renderPartial('/layouts/_top');?>
        <div class="main">
            <div class="mnav">
                <ul>
                    <li class="clk">
                        <div class="arrow2"></div>
                        <a href="/my">金窝藏娇</a>
                    </li>
                </ul>
            </div>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    "homeLink"=>CHtml::link("后台首页","/my"),
                    'links'=>$this->breadcrumbs,
                    "htmlOptions"=>array("class"=>"xcspace")
            )); ?>
            <?php echo $content; ?>
        </div>
        <?=$this->renderPartial('/layouts/_footer');?>
    </body>
</html>
