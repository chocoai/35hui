<?php
$this->breadcrumbs=array(
	"我的新地标"=>array('/site/userindex'),
    '关键词推广',
	'我的购买记录',
);
?>
<style type="text/css">
    .hideclass{display:none;}
</style>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">我的购买记录</div>
    <div class="manage_rightboxthree">
        <div id="newSummaryText" style="float: right;margin-right: 10px"></div>
        <table class="manage_tabletwo" width="100%" border="0" cellpadding="5" cellspacing="5">
            <tr>
                <th width="60%">关键词</th>
                <th width="20%">购买时间</th>
                <th>过期时间</th>
            </tr>
        </table>
        <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_historylist',
                'summaryText'=>'<div setDomId="newSummaryText">共有<font style="color:red">{count}</font>条记录</div>',
                'summaryCssClass'=>'hideclass',
            ));
            ?>
    </div>
    <div class="manage_righttwoline"></div>
</div>
<script type="text/javascript" src="/js/CListViewSummaryText.js"></script>