<?=$this->renderPartial('_top');?>
<div class="jbmain">
    <div class="yue">我共送出<em><?=$countAll?></em>个礼物</div>
    <div class="djline">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_giftsendview',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </div>
</div>