<?php
$action = $this->getAction()->getId();
?>
<div class="htguanli" id="jibenjiliao">
    <ul>
        <li class="<?=$action=="comindex"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/comindex');?>">基本资料</a></li>
        <li class="<?=$action=="changehead"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/changehead');?>">修改Logo</a></li>
        <li class="<?=$action=="yunying"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/yunying');?>">运营认证</a></li>
    </ul>
</div>