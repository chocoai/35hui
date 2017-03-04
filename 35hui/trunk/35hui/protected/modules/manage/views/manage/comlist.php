<style type="text/css">
    .threeline_boxleftsix dt{background: none;}
    .mupai table a:link,.mupai table a:visited{color: #fff;}
    .mupai table a:hover{color: #f60;}
    #footer{background: url(/images/footer.png) repeat-x; width: 100%; height: 240px;}
    .copyright span{color:#000;}
    .copyright a:link,.copyright a:visited{color:#fff;}
    .copyright a:hover{color: #FF6600}
</style>
<?php
$this->pageTitle = $model->ua_realname."的店铺-新地标";
?>
<style type="text/css">
    .hideclass{display:none}
</style>
<div id="two_left">
    <h1><span class="title_icon"><img src="/images/bullet1.gif" /></span>写字楼房源 </h1>
    <span id="newSummaryText" style="float:right; font-size:12px; color:#000; margin-left:500px; font-weight:normal; margin-top:10px;"></span>
    <div class="items">
        <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $comlist,
                'itemView' => '_comlistView',
                'summaryText'=>'<div setDomId="newSummaryText">共有<b>{count}</b>条留言</div>',
				'summaryCssClass'=>'hideclass',
            ));
            ?>
    </div>
    <div class="commt">
        <div id="dlpl" class="commentsList neicommt">
            <?php if(!Yii::app()->user->isGuest):?>
            <?php echo $this->renderPartial('/uagentcomment/_form', array('model'=>$comment,'show'=>false,'ifAllowComment'=>$ifAllowComment)); ?>
            <?php else:?>
                <?php echo CHtml::link('登录后评论',array('/site/login'),array("style"=>"color:blue")); ?>
            <?php endif;?>
        </div>
    </div>
</div>
<div id="tworight"> </div>
<script type="text/javascript" src="/js/CListViewSummaryText.js"></script>