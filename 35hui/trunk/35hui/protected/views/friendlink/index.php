<?php
if($this->beginCache(common::getApcCacheKey($this->getId(),$this->getAction()->getId()), array('duration'=>Yii::app()->params['duration']))) {
    ?>
<link rel="stylesheet" type="text/css" href="/css/global.css" />
<style type="text/css">
.fractive{ clear:both; width:1000px; line-height:20px; line-height: 25px; padding-top: 20px;}
.newfreind{ clear:both; width:1000px;}
.newfreind h6{ background: url("../images/friendlink_bar.gif") no-repeat; clear: both;  color: #404040; font-size: 14px; height: 31px; line-height: 31px; margin: 10px 0 0; text-align: center; width: 117px;}
.newfreind ul{ border-top:3px solid #82A9CD; clear:both; }
.newfreind ul li{ height:35px; clear:both; border-bottom:1px solid #82A9CD;}
.newfreind ul li a{ line-height:35px; width:140px; text-align:center; display:block; float:left; color:#333333;}
.newfreind ul li.clk{ height:35px; padding-top:5px; text-align:center; }
.newfreind ul li.clk a{ height:35px; width:122px;}
</style>

<div class="fractive">要求：
1、房产类网站PR>=3且没有被引擎惩罚过的，其他类网站PR>=4且没有被引擎惩罚过,收录数量超过1000的<br/>
2、请先做好我们的链接再联系我们。我们审核通过后会第一时间给你们答复的。谢谢！<br/>
3、链接名称 新地标全景看房 链接地址 http://www.360dibiao.com/<br/>
Email：service@360dibiao.com 电  话：021-68880123</div>
<?php
    foreach($allFriendLink as $type =>$source){
?>
<div class="newfreind">
    <h6><?=Friendlink::$fl_type[$type]?></h6>
	<ul>
        <li>
        <?php
        foreach($source as $key=>$value){
            if($value->fl_type==Friendlink::PIC_TYPE){
                echo CHtml::link(CHtml::image($value->fl_picurl,$value->fl_value,array("width"=>"90px","height"=>"30px")),$value->fl_url,array("target"=>"_blank"));
            }else{
                echo CHtml::link($value->fl_value,$value->fl_url,array("target"=>"_blank"));
            }

            if(($key+1)%7==0){
                echo "</li><li>";
            }
        }
        ?>
        </li>
	</ul>
</div>
<?php
    }
 $this->endCache();
} ?>