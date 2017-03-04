<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/css/global.css" rel="stylesheet" type="text/css" />
        <link href="/css/login.css" rel="stylesheet" type="text/css" />
        <link href="/js/common/common.css" rel="stylesheet" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <script src="/js/jquery.js" type="text/javascript"></script>
    </head>
    <body>
        <?=$this->renderPartial('/layouts/_top');?>
        <?php
        if($this->topbreadcrumbs) {
            $return = array();
            $return[] = CHtml::link("首页",array("/site/home"));;
            foreach($this->topbreadcrumbs as $key=>$value) {
                if(is_array($value)) {
                    $return[] = CHtml::link($key,$value);
                }else {
                    $return[] = CHtml::link($value,"#",array("class"=>"dq"));
                }
            }
            echo '<div class="space">'.implode(">",$return)."</div>";
        }
        ?>
        <div class="main">
            <?php echo $content; ?>
        </div>
        <?=$this->renderPartial('/layouts/_footer');?>
        <script src="/js/common/common.js" type="text/javascript"></script>
    </body>
</html>
