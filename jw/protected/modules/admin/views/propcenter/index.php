<style type="text/css">
    .info {overflow: hidden;}
    .info .title{clear: both; font-weight: bold;border-bottom: 1px dotted #FF6E00}
    .info .one{float: left;
               padding: 14px 4px;
               width: 221px;
               height: 350px;overflow: hidden}
    .info .one img{
        border: 1px solid #DDD;
        height: 245px;
        padding: 1px;
        width: 217px;
    }
    .info .one p{
        clear: both;
        font-size: 12px;
        line-height: 18px;
        padding: 0px;
    }
</style>
<?php
$this->breadcrumbs=array(
        '礼物与道具',
);?>
<div class="info">
    <div class="title">道具</div>
    <?php
    foreach($allProp as $value) {
        ?>
    <div class="one">
        <a href="/admin/propcenter/update/id/<?=$value->pc_key?>"><img src="<?=$value->pc_url?>" width="210px" height="240px"></a>
        <p><?=$value->pc_name?></p>
        <p>
            <span style="float: left;width: 190px;overflow: hidden;height: 20px">使用：<?=$value->pc_describe?></span>
            <span style="float:right;color:#FF7F27;cursor: pointer" onclick="showdescribe(this)">详细</span>
        </p>
        <p>价格：<?=$value->pc_price?>金币  操作：<?=$value->pc_optnumber?></p>
    </div>
        <?php
    }
    ?>
    <div class="title">
        礼物
        <span><a href="/admin/giftcenter/create">添加新礼物</a></span>
    </div>
    <?php
    foreach($allGift as $value) {
        ?>
    <div class="one">
        <a href="/admin/giftcenter/update/id/<?=$value->gc_id?>"><img src="<?=$value->gc_url?>" width="210px" height="240px"></a>
        <p><?=$value->gc_name?></p>
        <p>价格：<?=$value->gc_price?>金币</p>
    </div>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
        $(document).ready(function(){
<?php if(Yii::app()->user->hasFlash('message')): ?>
        jw.pop.alert("<?=Yii::app()->user->getFlash('message')?>",{autoClose:1000})
<?php endif; ?>
    });
    function showdescribe(obj){
        var html = $(obj).prev("span").html();
        jw.pop.tip(html)
    }
</script>