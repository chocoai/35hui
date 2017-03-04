<?php
$this->breadcrumbs=array(
        '版块精选',
);
?>
<div class="msg">
    “版块精选”是新地标网全新推出的增值服务功能，当用户点击到所购买的版块后，您设置的版块精选房源将会优先排序。一个版块下最多能设置10条版块精选房源。版块精选只能由中介公司购买和设置，且同一个版块在同一断时间内只能由一个中介公司购买！
</div>
<div class="htit">板块精选</div>
<?php
foreach($userRegion as $model){
    $str = "您于".date("Y-m-d",$model->br_buytime)."购买了";
    $str .= CHtml::link(Buyregion::$br_sourcetype[$model->br_sourcetype].Buyregion::$br_sellorrent[$model->br_sellorrent].Buyregion::model()->getShowRegionName($model->br_regionid),Buyregion::model()->getViewUrl($model),array("target"=>"_blank"));
    $str .= "页面"."的版块精选，有效期".($model->br_expiredate/86400)."天！感谢您的支持！";
    ?>
<div class="jxtit"><?=$str;?></div>
<div class="gltu">
        <?php
        $allSource = Buyregion::model()->getNowSetSource($model);
        foreach($allSource as $value){
            if($model->br_sourcetype==1){//写字楼
                $img = Picture::model()->getPicByTitleInt($value->presentInfo->op_titlepicurl,"_small");
                $url = array("/office/view","id"=>$value->ob_officeid);
                $title = $value->presentInfo->op_officetitle;
                $sourceId = $value->ob_officeid;
            }elseif($model->br_sourcetype==2){//商铺
                $img = Picture::model()->getPicByTitleInt($value->presentInfo->sp_titlepicurl,"_small");
                $url = array("/shop/view","id"=>$value->sb_shopid);
                $title = $value->presentInfo->sp_shoptitle;
                $sourceId = $value->sb_shopid;
            }elseif($model->br_sourcetype==3){//住宅
                $img = Picture::model()->getPicByTitleInt($value->rbi_titlepicurl,"_small");
                $url = array("/communitybaseinfo/viewResidence","id"=>$value->rbi_id);
                $title = $value->rbi_title;
                $sourceId = $value->rbi_id;
            }
            ?>
    <div class="jxbord">
        <div class="jxmodle">
            <?php
                echo CHtml::link(CHtml::image($img,"",array("class"=>"showpic")),$url,array("target"=>"_blank"));
                echo '<p><a href="javascript:unRecommend('.$sourceId.",".$model->br_id.')">取消推荐</a>'.common::strCut($title, 21).'</p>';
            ?>
        </div>
    </div>
            <?php
        }
        ?>

    <div class="jxmodl" style="display:<?=count($allSource)<Buyregion::$maxSetNum?"":"none"?>">
        <a href="javascript:openNewDiv(<?=$model->br_id?>)">房源设置</a>
    </div>
</div>
    <?php
}
?>





<!--
<style type="text/css">
    .onepic{width: 125px;height:150px;margin: 3px;border: 1px #DDDBDC solid;float: left;overflow: hidden;}
    .onepic .discri{padding: 5px}
    .showpic{width: 125px;height: 95px}
</style>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">
        <div style="float:left;width: 500px">版块精选</div>
        <div style="float:right;font-weight: normal;font-size: 12px;margin-right: 10px ">
            <img src="/images/default/hint.gif" alt="">
<?=CHtml::link("什么是版块精选？",array("help/buyregion"),array("style"=>"color:blue","target"=>"_blank"));?>
            <a style="color:blue" href="#"></a>
        </div>
    </div>
    <div class="manage_rightboxthree">

<?php
foreach($userRegion as $model){
    ?>
        <div class="manage_rightthreeine"></div>
        <div class="manage_rightfoutbox">
            <div >
    <?php
    $str = "您于".date("Y-m-d",$model->br_buytime)."购买了";
    $str .= CHtml::link(Buyregion::$br_sourcetype[$model->br_sourcetype].Buyregion::$br_sellorrent[$model->br_sellorrent].Buyregion::model()->getShowRegionName($model->br_regionid),Buyregion::model()->getViewUrl($model),array("target"=>"_blank","style"=>"color:blue"));
    $str .= "页面"."的版块精选，有效期30天！感谢您的支持！";
    echo $str;
    ?>
            </div>
            <table class="manage_tabletwo" width="100%" border="0" cellpadding="5" cellspacing="5">
                <tr align="center">
                    <td width="100%" valign="top">
    <?php
    $allSource = Buyregion::model()->getNowSetSource($model);
    foreach($allSource as $value){
        if($model->br_sourcetype==1){//写字楼
            $img = Picture::model()->getPicByTitleInt($value->presentInfo->op_titlepicurl,"_small");
            $url = array("office/view","id"=>$value->ob_officeid);
            $title = $value->presentInfo->op_officetitle;
            $sourceId = $value->ob_officeid;
        }elseif($model->br_sourcetype==2){//商铺
            $img = Picture::model()->getPicByTitleInt($value->presentInfo->sp_titlepicurl,"_small");
            $url = array("shop/view","id"=>$value->sb_shopid);
            $title = $value->presentInfo->sp_shoptitle;
            $sourceId = $value->sb_shopid;
        }elseif($model->br_sourcetype==3){//住宅
            $img = Picture::model()->getPicByTitleInt($value->rbi_titlepicurl,"_small");
            $url = array("communitybaseinfo/viewResidence","id"=>$value->rbi_id);
            $title = $value->rbi_title;
            $sourceId = $value->rbi_id;
        }
        ?>
                        <div class="onepic">
        <?php
        echo CHtml::link(CHtml::image($img,"",array("class"=>"showpic")),$url,array("target"=>"_blank"));
        ?>
                            <div class="discri">
                                <span title="<?=$title?>"><?=common::strCut($title, 45)?></span><br>
                                <a href="javascript:unRecommend(<?=$sourceId.",".$model->br_id?>)" style="color:blue">取消推荐</a>
                            </div>
                        </div>
        <?php
    }
    ?>

                        <div class="onepic" style="background-color: #cccccc;display:<?=count($allSource)<Buyregion::$maxSetNum?"":"none"?>">
                            <div style="padding-top:60px;text-align: center;">
                                <a href="javascript:openNewDiv(<?=$model->br_id?>)">
                                    <img src="/images/recomendsource.gif">
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="manage_rightfourine"></div>
    <?php
}
?>

    </div>
    <div class="manage_righttwoline"></div>

</div>
<div id="newDiv" style="display:none;position: fixed;width: 640px;height: 480px;padding: 2px;background-color:white; ">
    <iframe width="640px" height="480px" frameborder="0" scrolling="no" src=""></iframe>
</div>

-->
<script type="text/javascript">
    //取消首页推荐
    function unRecommend(sourceId,brId){
        if(confirm("确定要取消推荐吗？")){
            $.ajax({
                type: "GET",
                url: "<?php echo Yii::app()->createUrl('/manage/buyregion/unrecommend') ?>",
                data: {"sourceId":sourceId,"brId":brId},
                success: function(msg){
                    if(msg==1){
                        window.location.reload();
                    }
                }
            });
        }
    }
    function openNewDiv(brid) {
        var url = "<?php echo Yii::app()->createUrl('/manage/buyregion/regionframe');?>?id="+brid;
        var width = "640px";
        var height = "610px";
        parent.window.openTip(url,width,height);
    }
</script>