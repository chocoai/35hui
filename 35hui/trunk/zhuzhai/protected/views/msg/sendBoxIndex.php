<?php
$this->temp=$menu;
$this->breadcrumbs=array(
	"我的新地标"=>array('/site/userindex'),
	'发件箱',
);
?>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">发件箱</div>
    <div class="manage_rightboxthree">
        <div id="receiveBox" style="width:100%;" class="manage_tabletwo">
         <?php
               $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$sendProvider,
                    'itemView'=>'_sendlist',
                    'summaryText'=>'<span style="padding-left:20px;">共发出<strong>{count}</strong>封站内信</span>',
                    'summaryCssClass'=>'',
                    'emptyText'=>'发件箱内暂时没有信件',
               ));
              ?>
        </div>
    </div>
    <div class="manage_righttwoline"></div>
</div>