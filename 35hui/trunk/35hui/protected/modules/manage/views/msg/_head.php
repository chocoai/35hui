<?php
$action = $this->getAction()->getId();
?>
<div class="htguanl">
    <ul>
        <li class="<?=$action=="receivebox"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/msg/receivebox');?>" target="frame">收件箱</a></li>
        <li class="<?=$action=="sendbox"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/msg/sendbox');?>" target="frame">发件箱</a></li>
        <li class="<?=$action=="gonggao"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/msg/gonggao');?>" target="frame">站点公告</a></li>
    </ul>
</div>