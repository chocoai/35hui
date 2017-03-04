<div class="maptip" style="position: absolute; z-index: 1001;" >
    <div class="bk_top">
        <p class="bk_topl" style="width: 502px"></p>
        <p class="bk_topr"></p>
    </div>
    <div class="tipmain">
        <h1>
            <div class="floatl">
                <div class="pic">
                    <a href="<?=Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$communityInfo['comy_id']))?>" target="_blank">
                        <img border="0" alt="小区标题图" src="<?php echo Picture::model()->getPicByTitleInt($communityInfo->comy_titlepic,'_small'); ?>" width="99" height="66" id="projimg" />
                    </a>
                </div>
                <div class="house">
                    <a href="<?=Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$communityInfo['comy_id']))?>" style="color:blue" target="_blank"><strong><?php echo $communityInfo->comy_name;?></strong></a>
                    &nbsp;&nbsp;均价：<strong class="orange number"><?=$communityInfo->comy_avgsellprice?$communityInfo->comy_avgsellprice.'元/平米':'暂无资料';?></strong><br>
                    <span class="gray6"><?=$communityInfo->comy_address;?></span>
                    <br>
                    <a style="color:blue" href="<?=Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$communityInfo['comy_id']))?>" target="_blank">小区详情&gt;&gt;</a>
                </div>
            </div>
            <div class="floatr">
                <input type="button" value="" onclick="closeTip()"/>
            </div>
        </h1>
        <div class="title">
            <div style="float:left;width: 100px">
                共有<strong style="color:red"><?=$allNum?></strong>套房源
            </div>
            <div style="float:right; width: 220px">
               筛选：
                <input type="hidden" name="type_tip" id="type_tip" value="<?=$post['type']?>" />
                <select style="width:80px;color:#666;background-color: #E8EFFA" name="searchForm[area]" onchange="go(1)" id="area_tip">
                    <option value="0-0" <?php if(isset($post['area'])&&$post['area']=="0-0")echo "selected='selected'"?>>面积不限</option>
                    <option value="0-50" <?php if(isset($post['area'])&&$post['area']=="0-50")echo "selected='selected'"?>>50以下</option>
                    <option value="50-70" <?php if(isset($post['area'])&&$post['area']=="50-70")echo "selected='selected'"?>>50-70</option>
                    <option value="70-110" <?php if(isset($post['area'])&&$post['area']=="70-110")echo "selected='selected'"?>>70-110</option>
                    <option value="110-130" <?php if(isset($post['area'])&&$post['area']=="110-130")echo "selected='selected'"?>>110-130</option>
                    <option value="130-150" <?php if(isset($post['area'])&&$post['area']=="130-150")echo "selected='selected'"?>>130-150</option>
                    <option value="150-200" <?php if(isset($post['area'])&&$post['area']=="150-200")echo "selected='selected'"?>>150-200</option>
                    <option value="200-300" <?php if(isset($post['area'])&&$post['area']=="200-300")echo "selected='selected'"?>>200-300</option>
                    <option value="300-"<?php if(isset($post['area'])&&$post['area']=="300-")echo "selected='selected'"?>>300以上</option>
                </select>
                
                <select style="width:80px;color:#666;background-color: #E8EFFA" name="searchForm[price]" onchange="go(1)" id="price_tip">
                    <option value="0-0" <?php if(isset($post['price'])&&$post['price']=="0-0")echo "selected='selected'"?>>售价不限</option>
                    <option value="0-50" <?php if(isset($post['price'])&&$post['price']=="0-50")echo "selected='selected'"?>>50以下</option>
                    <option value="50-100" <?php if(isset($post['price'])&&$post['price']=="50-100")echo "selected='selected'"?> >50-100</option>
                    <option value="100-150" <?php if(isset($post['price'])&&$post['price']=="100-150")echo "selected='selected'"?>>100-150</option>
                    <option value="150-200" <?php if(isset($post['price'])&&$post['price']=="150-200")echo "selected='selected'"?>>150-200</option>
                    <option value="200-300" <?php if(isset($post['price'])&&$post['price']=="200-300")echo "selected='selected'"?>>200-300</option>
                    <option value="300-500" <?php if(isset($post['price'])&&$post['price']=="300-500")echo "selected='selected'"?>>300-500</option>
                    <option value="500-1000" <?php if(isset($post['price'])&&$post['price']=="500-1000")echo "selected='selected'"?>>500-1000</option>
                    <option value="1000-" <?php if(isset($post['price'])&&$post['price']=="1000-")echo "selected='selected'"?>>1000以上</option>
        
                </select>
                
            </div>
        </div>
        <div class="tiplist" style="height: 302px">
            <?php
            if(!empty($list)){
                foreach($list as $value){
                ?>
                <dl>
                    <dt class="last">
                        <?=CHtml::link("<strong>".$value->rbi_title."</strong>",array("communitybaseinfo/viewResidence","id"=>$value->rbi_id),array("style"=>"color:blue","target"=>"_blank"));?>
                        <br><?php echo $value['rbi_floor']?>/<?php echo $value['rbi_allfloor']?>层 <?=$value->sellInfo['rs_unitprice'];?>元/平米
                        <span class="gray9"><?=common::dealShowTime($value->rbi_updatedate);?>更新 </span>
                    </dt>
                    <dd style="padding-top:15px">住宅</dd>
                    <dd class="orange"><strong><?php echo $value->sellInfo['rs_price']?></strong><br />万元/套</dd>
                    <dd><?php echo $value['rbi_area']?><br />平米</dd>
                </dl>
                <?php
                    }
            }else{
                echo "没有找到任何房源！";
            }?>
         </div>
        <?php
        if(!empty($list)&&$pageNum!=1){
        ?>
            <div class="page" id="pageNavibar"><span <?php
               if($nowPage!=1){
                   $prePage = $nowPage-1;
                   echo "style='cursor:pointer;' onclick='go(".$prePage.")'";

               }?>>上一页</span><?php echo $nowPage;?>/<?php echo $pageNum;?><span <?php
               if($nowPage<$pageNum){
                   $nextPage = $nowPage+1;
                   echo "style='cursor:pointer;' onclick='go(".$nextPage.")'";
               }?>>下一页</span>
            </div>
        <?php
        }else{
            echo '<div class="page" id="pageNavibar"></div>';
        }
        ?>
    </div>
    <div class="bk_bottom">
        <p class="bk_bottoml" style="width: 502px">
        </p>
        <p class="bk_bottomr"></p>
    </div>
<input type="hidden" name="buildid_tip" value="<?php echo $post['buildid'];?>" id="buildid_tip"/>
</div>
<style type="text/css">
.maptip{font-family:Arial;color:#666; position:relative; float:left;}
.maptip h1 input,.maptip h1 input:hover{width:15px; height:15px; background:url(<?=IMAGE_URL;?>/map_bktip.gif) 3px -40px no-repeat; border:none;margin:0 3px;cursor:pointer;float:left;}
.maptip .bk_topl,.maptip .bk_topr,.maptip .bk_bottoml,.maptip .bk_bottomr{height:10px;background:url(<?=IMAGE_URL;?>/map_bktip.gif) 0 0 no-repeat;float:left; overflow:hidden;}
.maptip .bk_topr {width:10px; background-position:100% 0;}
.maptip .bk_bottoml {background-position:0 -87px;}
.maptip .bk_bottomr {width:10px; background-position:100% -87px;}
/* map tipmain ------------------ */
.tipmain{width:490px; padding:0 10px; border-left:1px solid #999;border-right:1px solid #999; background:#fff; float:left;}
.tipmain h1{width:490px;font:12px/22px Arial; margin-top:8px; float:left;}
.tipmain h1 .pic{width:99px; height:65px; margin-right:10px; float:left;}
.tipmain h1 .house{width:355px;float:left;}
.maptip .title{width:485px;padding:3px 0px 2px 5px; margin-top:5px; color:#666; background:#E8EFFA;float:left;}
.maptip .tiplist{width:490px; float:left; color:#333;}
.maptip .tiplist dl{width:486px; padding:3px 2px;border-bottom:1px solid #dcdcdc; float:left;}
.maptip .tiplist dt{width:290px;float:left;overflow:hidden;text-overflow: ellipsis;-o-text-overflow: ellipsis;/*--4 opera--*/white-space:nowrap;}
.maptip .tiplist dd{width:60px;text-align:center; float:left; padding:0px 0 0 0px;white-space:nowrap; overflow:hidden;}
.maptip .tiplist dd strong{font:bold 14px/20px Verdana;}
.maptip .tiplist .last{line-height:20px; padding-top:3px;}
.maptip .tiplist .wid310{width:300px;}
.maptip .tiplist .wid80{width:85px;}
.maptip .page{width:462px; height:20px;text-align:center;float:left; margin-top:5px;}
.maptip .page input{border:none; background:#fff; margin-right:20px; cursor:pointer;}
</style>