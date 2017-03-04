<?php $link = Yii::app()->createUrl("/shop/view",array("id"=>$model->sb_shopid));?>
<li  sourceId="<?=$model->sb_shopid;?>" mainXml="<?=Panoxml::model()->getPanoXml($model->sb_shopid, 4)?>">
    <table width="287" border=0" cellpadding="0" cellspacing="0">
        <tr>
            <td rowspan="3" width="104px"><img alt="" src="<?=Picture::model()->getPicByTitleInt($model->presentInfo->sp_titlepicurl,"_small");?>" width="100" height="66" border="0" class="pic" />
                <div class="<?=$model->sb_sellorrent==1?"tag_zhu":"tag_sale"?>"></div>
            </td>
            <td valign="top">
                <table border="0" cellpadding="0" cellspacing="0" height="66px" id="msnr" style="width:100%">
                    <tr>
                        <td>
                            <?=CHtml::encode(Region::model()->getNameById($model->sb_district))?>&nbsp;-&nbsp; <a class="blue" title="<?=$model->presentInfo->sp_shoptitle?>" href="<?=$link;?>"><?=common::strCut($model->presentInfo->sp_shoptitle, 21);?></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="green"><?=common::strCut(CHtml::encode($model->sb_shopaddress), 27);?></td>
                    </tr>
                    <tr>
                        <td class="green"><?=$model->sb_shoparea.'㎡';?>,<?=$model->sb_sellorrent==1?$model->rentInfo->sr_rentprice."元/㎡·天":$model->sellInfo->ss_avgprice."元/㎡";?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</li>