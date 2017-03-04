<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="/css/umanage.css" rel="stylesheet" type="text/css" />
        <title>新地标后台管理系统</title>
        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
    </head>
    <body onload="resetFrameHeight()">
        <div class="space">
            <div style="float:left">当前位置：</div>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    "homeLink"=>CHtml::link("新地标","/manage/main/newindex",array("style"=>"padding:0px;color:#0F29C8")),
                    'links'=>$this->breadcrumbs,
            )); ?>
        </div>
        <?php echo $content; ?>
        <script type="text/javascript">
            function resetFrameHeight(){
                parent.document.getElementById('frame').height=document.body.offsetHeight+40
            }
        </script>
    </body>
</html>
