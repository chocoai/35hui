<?php
$action = $this->getAction()->getId();
?>
<div class="htguanli" id="jibenjiliao">
    <ul>
        <li class="<?=$action=="perindex"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/perindex');?>">基本资料</a></li>
        <li class="<?=$action=="changehead"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/changehead');?>">修改头像</a></li>
    </ul>
</div>