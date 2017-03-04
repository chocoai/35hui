<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/kuaisufabu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<?php
$this->breadcrumbs=array(
	'快速发布需求登记'=>array('quickrelease/searchIndex','type'=>4),
	'需求快速登记',
);
$this->pageTitle = '需求快速登记';
?>
<!--content start-->
<div class="clearfix"  style="width:984px;margin:0px auto;">
    <div class="quick-content">
        <div class="pnreg-char">
            <dl>
                <dt>您好，欢迎来新地标!</dt>
                <dd>每天有<em class="highlight">数十万</em>想租售商业地产的网友在新地标上查找所需房源信息；</dd>
                <dd>有<em class="highlight">数万</em>位房产经纪人在线提供专业房产服务；</dd>
                <dd>无数网民正把自己想出售的房源登记到新地标……</dd>
                <dd><em>填写您的出售/出租房源信息，更快更方便！</em></dd>
            </dl>
        </div>
        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
<!--content end-->