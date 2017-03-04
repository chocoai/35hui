<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::encode($data->sbi_buildingid); ?>
        </div>
    </div>
    
    <b>房源名称:</b>
	<?php echo CHtml::encode($data->sbi_buildingname); ?>
	<br />
    <b>当前微博内容:</b>
    <?=CHtml::link(CHtml::encode(Twitter::model()->getTwitterMessageByBuildingId($data->sbi_buildingid,1)),array('view','buildingId'=>$data->sbi_buildingid,'type'=>1))?><br /><br />
    <?=CHtml::link('共有'.Twittersuggest::getNums($data->sbi_buildingid,1).'条播报微博',array('suggestIndex','buildingId'=>$data->sbi_buildingid,'type'=>1))?>
</div>