<div class="dxline">
    <span class="dx_01"><input type="checkbox"></span>
    <span class="dx_03">
        <p style="word-break:break-all;"><?=CHtml::encode($data->us_content)?></p>
        <div class="p"><a href="">评论（<?=$data->us_replynum?>）</a><em><?=date("Y-m-d H:i",$data->us_creattime)?></em></div>
    </span>
</div>