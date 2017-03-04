<?php
$controller = trim(Yii::app()->controller->getId());
$action = trim(Yii::app()->controller->getAction()->getId());
$check = $controller."_".$action;
?>
<div class="zftnav">
    <ul>
        <li class="<?=$check=="dynamicmy_index"?"clk":""?>" onclick="location.href='/my/dynamicmy/index'" style="cursor: pointer">我的空间动态</li>
        <li class="<?=$check=="userspeak_index"?"clk":""?>" onclick="location.href='/my/userspeak/index'" style="cursor: pointer">我的说说</li>
        <li class="<?=$check=="attention_index"?"clk":""?>" onclick="window.location.href='/my/attention/index'" style="cursor: pointer">我关注了谁</li>
        <li class="<?=$check=="attention_attentionme"?"clk":""?>" onclick="window.location.href='/my/attention/attentionme'" style="cursor: pointer">谁关注了我</li>
        <li class="<?=$check=="userboard_index"?"clk":""?>" onclick="location.href='/my/userboard'" style="cursor: pointer">我的金牌</li>
    </ul>
</div>