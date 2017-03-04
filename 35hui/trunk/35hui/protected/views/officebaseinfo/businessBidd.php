<?php
    if(!empty($list)){
        foreach($list as $value){
        ?>
            <div class="view" style="height: inherit;">
                <div style="float:left; padding-left: 15px" align="left">
                    <table width="220" border="0" cellspacing="4" cellpadding="0">
                        <tr>
                            <td width="200"><?php
                            $url = Picture::model()->getPicByTitleInt($value->baseoffice->presentInfo->op_titlepicurl,"_small");
                            echo CHtml::image($url,'标题图',array('height'=>'200px','width'=>'150px'));
                            ?></td>
                        </tr>
                        <tr>
                            <td><br/><b><?php //echo CHtml::link(CHtml::encode($value->presentInfo['op_officetitle']),array('/officebaseinfo/businessSummarize','opid'=>$value->ob_officeid)); ?></b></td>
                        </tr>
                        <tr>
                            <td><span style="color:red;font-weight: bolder;">价格：<?php
                            if($value->baseoffice->ob_sellorrent==1){
                                echo $value->baseoffice->rentInfo['or_rentprice'].'元/月';
                            }else{
                                echo $value->baseoffice->sellInfo['os_sumprice']."万元";
                            }
                                    ?></span></td>
                        </tr>
                        <tr>
                            <td>面积：<?=$value->baseoffice->ob_officearea?>㎡</td>
                        </tr>
                        <tr>
                            <td>
                                装修：<?=Officebaseinfo::model()->getFitment($value->baseoffice->ob_adrondegree)?>，楼层：<?=Officebaseinfo::$ob_floortype[$value->baseoffice->ob_floortype]?></td>
                        </tr>
                        <tr>
                            <td>发布人： <?=$value->baseoffice->user['user_name']?></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="border:solid gray 1px; padding-left: 5px;padding-top: 5px; padding-bottom: 5px; background-color: silver; width:200px;">录入时间：<?=date("Y-m-d",$value->baseoffice->ob_releasedate)?>&nbsp;<span style="color: red; font-weight: bolder"><?=date("h:i:s",$value->baseoffice->ob_releasedate)?></span></div></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
        }
    }
?>