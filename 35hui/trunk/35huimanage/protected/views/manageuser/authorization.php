<?php
$this->breadcrumbs=array(
	'管理员列表'=>array('manageuser/index'),
    '授权'
);
$this->currentMenu = 92;
?>
<h1>授权查看</h1>
<div>
    <?php
    //print_r($roles);
    $postUrl = Yii::app()->createUrl('/manageuser/authorization');
    ?>
    <form method="POST" action="<?=$postUrl?>" id="form">
    <?php
        echo '<div class="row">当前用户：<b>',$model->mag_username,'</b> ID:<b>'.$model->mag_userid.'</b></div>';
        $i = 0;
        echo '<div class="row">权限：';
        foreach($allAuthItems as $item){
            if($item['name'] == Yii::app()->params['systemAdministrator']){
                if( ! Yii::app()->user->checkAccess(Yii::app()->params['systemAdministrator']))
                    continue;
            }
            echo '<input type="checkbox" name="authItems[]"'.(in_array($item['name'], $assignments)?' checked="checked"':'').'" id="authItems_'.$i.'" value="'.$item['name'].'">';
            echo '<label for="authItems_'.$i.'">{'.$item['name'].'}'.$item['description'].'</label>';
            $i++;
        }
        echo '<input type="hidden" name="oldAccessItems" value="'.implode(',', $assignments).'" />';
        echo '<input type="hidden" name="userid" value="'.$model->mag_userid.'" />';
?>
        <div class="row buttons">
		<?php echo CHtml::submitButton('['.$model->mag_username.']授权'); ?>
        </div>
<?php
        echo '</div>';
        ?>
    </form>
</div><!-- search-form -->