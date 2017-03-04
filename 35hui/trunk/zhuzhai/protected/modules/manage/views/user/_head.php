<?php
$action = $this->getAction()->getId();
?>
<div class="htguanli" id="jibenjiliao">
    <ul>
        <li class="<?=$action=="index"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/index');?>">基本资料</a></li>
        <li class="<?=$action=="changehead"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/changehead');?>">修改头像</a></li>
        <li class="<?=$action=="shenfen"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/shenfen');?>">身份认证</a></li>
        <li class="<?=$action=="mingpian"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/mingpian');?>">名片认证</a></li>
        <? /*<li class="<?=$action=="gongsi"?"clk":""?>"><a href="<?php echo Yii::app()->createUrl('/manage/user/gongsi');?>">公司认证</a></li> */?>
    </ul>
</div>