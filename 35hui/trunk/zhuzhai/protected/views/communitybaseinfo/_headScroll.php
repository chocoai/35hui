<?php $link = Yii::app()->createUrl("/communitybaseinfo/viewResidence",array("id"=>$model->rbi_id));?>
<li  sourceid="<?=$model->rbi_id;?>" mainXml="<?=Panoxml::model()->getPanoXml($model->rbi_id, 5)?>">
    <table width="287" border=0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td rowspan="3" width="104px"><img alt="<?=$model->community->comy_name?>" src="<?=Picture::model()->getPicByTitleInt($model->rbi_titlepicurl,"_small");?>" width="100" height="66" border="0" class="pic" />
                    <div class="tag_sale"></div>
                </td>
                <td valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" height="66px" id="msnr" style="width:100%">
                        <tr>
                            <td>
                                <?=CHtml::encode(Region::model()->getNameById($model->community->comy_district))?>&nbsp;-&nbsp; <a class="blue" title="<?=$model->rbi_title?>" href="<?=$link;?>"><?=common::strCut($model->rbi_title, 21);?></a>
                            </td>
                        </tr>
                        <tr>
                            <td class="green"><?=common::strCut(CHtml::encode($model->community->comy_address), 27);?></td>
                        </tr>
                        <tr>
                            <td class="green"><?=$model->rbi_area.'平方米';?>,<?=$model->rbi_rentorsell==1?$model->rentInfo->rr_rentprice."元/月":$model->sellInfo->rs_price."万元/套";?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</li>