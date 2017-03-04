<div class="fygline">
    <span class="fygl1">页面：<?=Productgrid::model()->getPageName($data->p_page)?></span>
    <span class="fygl1">模块：<?=Productgrid::model()->getPositionName($data->p_position)?></span>
    <span class="fygl1"><a href="<?php echo Productgrid::model()->getRecommendImageByPageAndPosition($data->p_page, $data->p_position) ?>" target="_blank">查看显示位置</a></span>
    <span class="fygl1">
        <a href="javascript:void(0)" onclick="showOrHidden(<?=$index?>)"><img src="<?=$index==0?"/images/btn_hideinfo.gif":"/images/btn_showinfo.gif"?>" style="float:right" /></a>
    </span>
</div>
<div class="fyglin" style="display:<?=$index==0?"":"none"?>">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td class="itit">&nbsp;</td>
            <td class="itit">基本价格</td>
            <td class="itit">当前价格</td>
            <td class="itit">价格保护</td>
            <td class="itit">可抢购时间</td>
            <td class="itit">购买天数</td>
            <td class="itit">消耗新币</td>
            <td class="itit">操作</td>
        </tr>
        
        <?php
        $list = Productgrid::model()->getIndex($data->p_page, $data->p_position);
        foreach($list as $key=>$value){
            $canBuy = Productgrid::model()->checkPositionCanBuy($value->p_id);
            ?>
        <tr>
            <td class="txt"><?=Productgrid::model()->getChineseIndexName($key+1)?></td>
            <td class="txt"><?=$value->p_baseprice?>&nbsp;点/天</td>
            <td class="txt"><?=$value->p_nowprice?>&nbsp;点/天</td>
            <td class="txt"><?=$value->p_protectpricedays?>&nbsp;天</td>
            <td class="txt"><?php echo Productgrid::model()->getCanBuyTime($value->p_id);?></td>
            <td class="txt">
                <?php
                if($canBuy&&$value->p_nowprice){
                    echo CHtml::dropDownList("maxBuyDays","",Productgrid::model()->formatMaxDaysToArray($value->p_maxbuydays),array("onchange"=>"getTotalPrice(this,".$value->p_nowprice.")"));
                }else{
                    echo $value->p_lastbuydatys."&nbsp;天";
                }
                ?>
            </td>
            <td class="txt">
                <em>
                    <?php
                    if($canBuy){
                        echo $value->p_nowprice;
                    }else{
                        echo Productgrid::model()->getLastBuyUsePrice($value->p_id);
                    }
                    ?>
                </em>点
            </td>
            <td class="txt">
                <?php
                if($canBuy){
                    echo CHtml::link("竞价","javascript:void(0)",array("onclick"=>"buyposition('".$value->p_id."', this)"));
                }else{
                    echo "请等待抢购时间";
                }
                ?>
                <span style="display:none">1</span>
            </td>
        </tr>
            <?php
        }
        ?>
    </table>
</div>