<div class="actmcont">
    <div class="scont" style="width:100%">
        <div class="sccline" style="cursor: pointer;word-break:break-all;" onclick="window.location.href='<?=Yii::app()->createUrl("/userspeak/view",array("id"=>$value->us_id));?>'"><?=CHtml::encode($value->us_content)?></div>
        <div class="sctime"> <?=date("Y-m-d H:i",$value->us_creattime)?><a href="<?=Yii::app()->createUrl("/userspeak/view",array("id"=>$value->us_id));?>" target="_blank">评论（<?=$value->us_replynum?>）</a></div>
    </div>
</div>