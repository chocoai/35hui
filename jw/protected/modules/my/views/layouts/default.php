<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <script src="/js/jquery.js" type="text/javascript"></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/js/common/common.css" rel="stylesheet" />
        <link href="/css/global.css" rel="stylesheet" type="text/css" />
        <link href="/css/css.css" rel="stylesheet" type="text/css" />
        
    </head>
    <body>
        <?=$this->renderPartial('/layouts/_top');?>
        <div class="main">
            <div class="mnav">
                <ul>
                    <li class="clk">
                        <div class="arrow2"></div>
                        <a href="/my">金屋藏娇</a>
                    </li>
                </ul>
                <input type="button" value="添加展示" class="btn_02" />
            </div>
            <div class="mleft">
                <?php
                if(User::model()->getRole()==User::ROLE_MEMBER){
                    $this->renderPartial('/layouts/_leftmember');
                }else{
                    $this->renderPartial('/layouts/_leftaudience');
                }
                ?>
            </div>
            <div class="mright">
                <?php echo $content; ?>
            </div>
        </div>
        <?=$this->renderPartial('/layouts/_footer');?>        
    </body>
</html>