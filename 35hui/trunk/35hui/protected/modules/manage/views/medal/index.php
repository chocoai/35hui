<?php
$this->breadcrumbs=array('我的勋章');
?>
<style type="text/css">
    .hidden{display:none}
    .layerBox{width: 320px;position: absolute;}
    .layerBoxCon{border: 1px solid #b1b8bb;width: 100%;}
    .upcontent{height:88px; overflow:hidden; padding:16px 20px 0px;}
    .honoricon{float:left; margin-right:10px;}
    .honortext{font-size:14px; font-weight:bold; line-height:24px;color:#333; float:right; width:210px; margin:0; padding:0; text-align:left;}
    .honortext dd{line-height:16px; text-align:left; margin:0;}
    .honortext dd p{font-size:12px; font-weight:normal; margin:0;}

    .line{background:url(/images/linedot1.gif) repeat-x 0 ;height: 5px}
    .btcontent{padding:5px 20px 14px;}
    .layerBoxCon a{color: #0082CB}
    .layerBoxCon a:hover{color: #390;}
    .layerBoxCon a:visited{color: #0082CB;}
    .jianjiao{background: url(/images/new_index_bg.png) no-repeat -142px -71px;height: 8px;width: 16px;overflow: hidden;
    }
</style>

<div class="htit">我的勋章</div>
<div class="xzcont">
    <div class="zxborder">
        <div class="<?php echo $medals[4]->md_size>3?'yes':'no';?>">
            <div class="topimg">
                <?php
                if($medals[4]->md_rank){
                    echo CHtml::image("/images/medal/4/".$medals[4]->md_rank.".gif");
                }
                ?>
            </div>
            <div class="bottom">
                <span>呼风唤雨</span>
            </div>
        </div>

        <div class="layerBox hidden">
            <div class="jianjiao"></div>
            <div class="layerBoxCon">
                <div class="upcontent">
                    <div class="honoricon">
                        <img src="<?php echo "/images/medal/4/".$nextMedals[4].".gif"; ?>" width="60px" height="60px">
                    </div>
                    <dl class="honortext">
                        <dt>呼风唤雨</dt>
                        <dd>
                            <p>邀请<?php echo $nextMedals[4]; ?>人开通新地标并通过身份认证与名片认证，即可获得这枚勋章。<a href="<?php echo Yii::app()->createUrl('/manage/invite/index');?>">现在就去邀请</a></p>
                        </dd>
                    </dl>
                </div>
                <div class="line"></div>
                <div class="btcontent">
                    <p ><?php
                    $man= $nextMedals[4]-$medals[4]->md_size;
                    if($man<=0){
                        echo "您已经邀请了".$medals[4]->md_size."人并成功进行了认证";
                    }else{
                        echo "再邀请".$man."人即可获得此勋章!";
                    } ?> </p>
                </div>
                <div class="clearit"></div>
            </div>
        </div>

    </div>
    <div class="zxborder">
        <div class="<?php echo $medals[9]->md_rank?'yes':'no';?>">
            <div class="topimg">
                <?php
                if($medals[9]->md_rank){
                    echo CHtml::image("/images/medal/9/".$medals[9]->md_rank.".gif");
                }
                ?>
            </div>
            <div class="bottom">
                <span>房源控</span>
            </div>
        </div>

        <div class="layerBox hidden">
            <div class="jianjiao"></div>
            <div class="layerBoxCon">
                <div class="upcontent">
                    <div class="honoricon"><img src="<?php echo "/images/medal/9/".$nextMedals[9].".gif"; ?>" width="60px" height="60px" /> </div>
                    <dl class="honortext">
                        <dt>房源控</dt>
                        <dd>
                            <p>连续<?php echo $nextMedals[9]; ?>天发布新房源，即可获得这枚勋章（有一天未发布就倒减一天） 。<a  href="<?=$releaseUrl?>">现在就去发布新房源</a></p>
                        </dd>
                    </dl>
                </div>
                <div class="line"></div>
                <div class="btcontent">
                    <p class="honortip">再连续<?php
                   if($nextMedals[9]-$medals[9]->md_rank>=0){
                       echo "您已经连续".$medals[9]->md_rank; ?>天发布新房源！ 
                  <? }else{
                       echo $nextMedals[9]-$medals[9]->md_rank; ?>天发布新房源，即可获得这枚勋章! 
                  <? }?>
                    </p>
                </div>
                <div class="clearit"></div>
            </div>
        </div>

    </div>
</div>			
<div style="clear: both"></div>
<div style="height: 500px"></div>
<script type="text/javascript">
    $(".zxborder").mousemove(function(){
        $(this).children(".layerBox").removeClass("hidden")
    }).mouseout(function(){
        $(this).children(".layerBox").addClass("hidden")
    })
</script>