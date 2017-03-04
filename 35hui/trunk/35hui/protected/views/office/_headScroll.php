<?php $link = Yii::app()->createUrl("/office/view",array("id"=>$model->ob_officeid));?>
<li mainXml="<?=Panoxml::model()->getPanoXml($model->ob_officeid, 3)?>">
    <table width="287" border=0" cellpadding="0" cellspacing="0">
        <tr>
            <td rowspan="3" width="104px"><img src="<?=Picture::model()->getPicByTitleInt($model->presentInfo->op_titlepicurl,"_small");?>" width="100" height="66" border="0" class="pic" alt="<?=$model->ob_officename?>" />
                <div class="<?=$model->ob_sellorrent==1?"tag_zhu":"tag_sale"?>"></div>
            </td>
            <td valign="top">
                <table border="0" cellpadding="0" cellspacing="0" height="66px" id="msnr" style="width:100%; margin:0; padding: 0;">
                    <tr>
                        <td  style="width:170px;">
                            <?=CHtml::encode(Region::model()->getNameById($model->ob_district))?>&nbsp;-&nbsp;
                            <a class="blue" style="margin-left:5px; display:inline; text-decoration: none; word-break:break-all; " title="<?=$model->presentInfo->op_officetitle?>" href="<?=$link;?>"><span ><?php
                                    $op_officetitle=common::strCut($model->presentInfo->op_officetitle,21);
                                    echo CHtml::encode($op_officetitle); ?></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td class="green"><?=common::strCut(CHtml::encode($model->ob_officeaddress), 27);?></td>
                    </tr>
                    <tr>
                        <td class="green"><?=$model->ob_officearea.'平方米';?>,<?=$model->ob_sellorrent==1?$model->rentInfo->or_rentprice."元/平米·天":$model->sellInfo->os_avgprice."元/平米";?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</li>