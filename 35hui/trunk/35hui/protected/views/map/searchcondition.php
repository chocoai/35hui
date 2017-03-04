<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style_map.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form_map.css" />
<?php $this->renderPartial('/map/_region'); ?>
<?php $this->renderPartial('/map/_traffic'); ?>