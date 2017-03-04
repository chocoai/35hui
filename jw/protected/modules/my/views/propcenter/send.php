<?=$this->renderPartial('_top');?>
<div class="jbmain">
    <div class="yue">我共送出<a href="/my/propcenter/my"><em><?=$countAll?></em></a>个道具</div>
    <div class="djline">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_propsendview',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </div>
</div>
<script type="text/javascript">
    function showdescribe(obj){
        var html = $(obj).prev("span").html();
        jw.pop.tip(html)
    }
</script>