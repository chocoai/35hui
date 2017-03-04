<h3><span><?=common::showFormatDate($data->mr_time);?></span>意见内容:</h3>
<div class="wenti"><?=CHtml::encode($data->mr_content);?></div>
<h3><span><?=$data->mr_rtime?common::showFormatDate($data->mr_rtime):"";?></span>答复内容:</h3>
<div class="dafu"><?=CHtml::encode($data->mr_replay?$data->mr_replay:"暂未答复");?></div>