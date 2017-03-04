<?php
$this->breadcrumbs=array(
	'系统权限管理'=>array('authmanage/index'),
    '授权查看'
);
$this->currentMenu = 92;
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/diy.css" />
<h1>授权查看</h1>
<div>
    <?php
    //print_r($roles);
    $postUrl = Yii::app()->createUrl('/authmanage/Authorization');
    //echo '<div class="row">管理员角色：',Yii::app()->params['systemAdministrator'],'</div><div class="row">权限：<font color="red">拥有最高权限</font></div>';
    foreach ($roleItems as $role => $items) {
        if($role == Yii::app()->params['systemAdministrator']) continue;
    ?>
    <form method="POST" action="<?=$postUrl?>" id="<?=$role?>form">
    <?php
        //if($role == Yii::app()->params['systemAdministrator']) continue;
        echo '<div class="row">权限上级：',$role,'</div>';
        $itemNames = array();
        foreach($items as $item){
            $itemNames[] = $item->getName();
            //$itemKeyDescriptions[$item->getName()] = $item->getDescription();
        }
        $haveItems = array_intersect($itemNames,$authItemsValue);
        $i = 0;
        if(isset($authItemsValueByType[1]) && !in_array($role, $authItemsValueByType[1])){
        echo '<div class="row">权限（TASK）：';
        foreach($authItemsValueByType[1] as $v){
            echo '<input type="checkbox" name="authItems[]"'.(in_array($v, $haveItems)?' checked="checked"':'').'" id="authItems_'.$i.'" value="'.$v.'">';
            echo '<label for="authItems_'.$i.'">'.$itemKeyDescriptions[$v].'</label>';
            echo '<span>'.CHtml::link("权限设置",array("/authmanage/authorizationview",'name'=>$v) ).'</span>';
            $i++;
        }
        echo '</div>';
        }
        echo '<div class="row">权限（OPERATION）：';
        $controller = '';$controllerChange = TRUE;
        foreach($authItemsValueByType[0] as $v){
            $vexp = explode('/', $v);
            if($controller != $vexp[0]){
                $controller = $vexp[0];
                $vexp[0][0] = strtoupper($vexp[0][0]);
                echo '<p><b>'.$vexp[0].'Controller</b></p>';
            }
            echo '<input type="checkbox" name="authItems[]"'.(in_array($v, $haveItems)?' checked="checked"':'').'" id="authItems_'.$i.'" value="'.$v.'">';
            echo '<label for="authItems_'.$i.'">'.$itemKeyDescriptions[$v].'</label>';
            $i++;
        }
        echo '<input type="hidden" name="oldAccessItems" value="'.implode(',', $haveItems).'" />';
        echo '<input type="hidden" name="name" value="'.$role.'" />';
?>
        <div class="row buttons">
		<?php echo CHtml::submitButton('['.$role.']授权选中项'); ?>
        </div>
<?php
        echo '</div>';
        ?>
    </form>
<?php
    }
?>
</div><!-- search-form -->