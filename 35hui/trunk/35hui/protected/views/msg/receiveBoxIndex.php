<?php
$this->temp=$menu;
$this->breadcrumbs=array(
	"我的新地标"=>array('/site/userindex'),
	'收件箱',
);
?>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">收件箱</div>
    <div class="manage_rightboxthree">
        <div id="receiveBox" class="manage_tabletwo" style="width:100%;padding: 0px 0px" >
         <?php
               $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$receiveProvider,
                    'itemView'=>'_revlist',
                    'summaryText'=>'<span style="padding-left:20px;">共有<strong>{count}</strong>封站内信</span>',
                    'summaryCssClass'=>'',
                    'emptyText'=>'收件箱内暂时没有信件',
               ));
              ?>
        </div>
    </div>
    <div class="manage_righttwoline"></div>
</div>