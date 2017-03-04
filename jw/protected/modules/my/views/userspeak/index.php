<?=$this->renderPartial('/dynamicmy/_top');?>
<div class="jbmain">
    <div class="dxline">
        <span class="dx_01"><input type="checkbox"></span>
        <span class="dx_03">
				 全选	<input type="button" value="删 除" class="btn_03">
        </span>
    </div>
    <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'summaryText'=>"",
            'cssFile'=>"/css/pager.css"
    )); ?>
</div>