<style type="text/css">
    .hidden{display:none}
    .show{display:}
	.submit_bg {position: relative;	text-align: center;	top:2px;top:13px\9;	top:12px\0;	*top:2px;	_top:4px;width: 111px;}
	@media screen and (-webkit-min-device-pixel-ratio:0) {
        .submit_bg {padding-top:12px;position:relative;	top:6px;}
	}
</style>
<?php
$this->pageTitle = "楼盘评论-新地标";
$this->breadcrumbs=array(
	$ifShop?'商业广场首页':'楼盘首页'=>array('index'),
    $ifShop?'商业广场点评信息':'楼盘点评信息'
);
?>
<link rel="stylesheet" type="text/css" href="/css/index.css" />
<link href="/css/adjustsearch.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="/css/seardetail.css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/buildingcmtlist.css" rel="stylesheet" type="text/css" >
<div id="center">
    <div class="detail">
            <?php
                $this->widget('SearchMenu',array(
                    'showMenu'=>array(1,4,9),//显示的条件
                    'url'=>$this->getId()."/".$this->action->getId(),//url
                    "autoCompleteData"=>2,//自动完成使用数据
                ));
                ?>
            </div>
    <!--banner end-->
    <div id="loup">
        <div id="two_left">
		  <div class="one-column-main">
            <ul class="feed_list" id="feed_list_container2"></ul>
            <ul class="feed_list" id="feed_list_container">
        <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$comments,
                'itemView'=>'_comment',
                'summaryText'=>'共有<strong>{count}</strong>条点评',
                'summaryCssClass'=>'',
                'emptyText'=>'最近点评',
            ));
            ?>

	</ul>
<div id="page_nav">

	</div>
			</div>

        </div><!--two_left end-->

        <div id="two_right" style="width:273px">
                    <?php
            $this->widget('RecentView',array("cssType"=>"shop"));
        ?>
        </div>
    </div>
    <div class="clear5"></div>
    <div class="zs"> </div>
</div> <!--center end-->