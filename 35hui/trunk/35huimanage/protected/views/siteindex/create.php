<h1><?php echo $title;?></h1>
<?php echo $this->renderPartial('_form', array('model'=>$model,'id'=>$id,'type'=>$type,'sellPrice'=>$sellPrice, 'rentPrice'=>$rentPrice,)); ?>