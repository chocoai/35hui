<?php
$this->beginContent('application.views.layouts.basemain');
?>
<?php $this->widget('zii.widgets.CBreadcrumbs', array(
        "homeLink"=>"<a href='".DOMAIN."'>首页</a>",
        'links'=>$this->breadcrumbs,
        'htmlOptions'=>array('style'=>'padding: 10px 0;')
	)); ?><!-- breadcrumbs -->
<?php echo $content; ?>
<?php $this->endContent(); ?>