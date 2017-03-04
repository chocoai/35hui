<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::encode($data->comy_id); ?>
        </div>
    </div>

    <b>房源名称:</b>
	<?php echo CHtml::encode($data->comy_name);?>
	<br />
    <b>当前微博内容:</b>
    <?=CHtml::link(CHtml::encode(Twitter::model()->getTwitterMessageByBuildingId($data->comy_id,2)),array('view','buildingId'=>$data->comy_id,'type'=>2))?><br /><br />
    <?=CHtml::link('共有'.Twittersuggest::getNums($data->comy_id,2).'条播报微博',array('suggestIndex','buildingId'=>$data->comy_id,'type'=>2))?>
</div>