<?php
$url = $type==1?Yii::app()->createUrl("site/login"):Yii::app()->createUrl("site/agentlogin");
?>
<div class="lm_left">
    <div class="smile">恭喜，注册成功！</div>
    <div class="sm_line">
        <a href="<?=$url?>">立刻登陆</a>
    </div>
</div>