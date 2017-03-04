<div class="clear5"></div>
<div class="view">
    <div style="width:720px;height:100px;">
        <table width="100%" height="100%" style="float:left;">
            <tr>
                <td width="6%"><?php echo CHtml::image(PIC_URL.$data->presentInfo['op_titlepicurl'],'标题图',array('height'=>'100px','width'=>'100px'));?></td>
                <td width="39%">
                    <div class="details" style="height:100px;">
                        <?php echo CHtml::link(CHtml::encode($data->presentInfo['op_officetitle']),array('/officebaseinfo/businessSummarize','opid'=>$data->ob_officeid)); ?><br/>
                        <p>所属楼盘<br/>
                            [<?=Region::model()->getNameById($data->ob_district)?>]<?=$data->ob_officeaddress?> [<?=Searchcondition::model()->getLoopName($data->ob_loop)?>]<br/>
                            等级：<?=Officebaseinfo::model()->getOfficeLevel($data->ob_officedegree)?>，装修：<?=Officebaseinfo::model()->getFitment($data->ob_adrondegree)?>，楼层：<?=Officebaseinfo::$ob_floortype[$data->ob_floortype]?><br/>
                            <?=date("Y-m-d",$data->ob_releasedate)?>发布 [<?=common::dealShowTime($data->ob_updatedate)?>更新]
                            <?=$data->user['user_name']?>
                        </p>
                    </div>
                </td>
                <td width="11%"><?=$data->ob_officearea?>㎡</td>
                <?php if($data->sellInfo['os_sumprice']>0) {?>
                <td width="13%"><h3 style="color:orange"><?=$data->sellInfo['os_avgprice']?>元/㎡</h3></td>
                <td width="18%" ><h3 style="color:orange">&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;</h3></td>
                <td width="13%"><h3 style="color:red"><?=$data->sellInfo['os_sumprice']?>万元</h3></td>
                    <?php }else {?>
                <td width="13%"><h3 style="color:orange">&nbsp;&nbsp;--&nbsp;&nbsp;</h3></td>
                <td width="18%" ><h3 style="color:orange"><?=$data->rentInfo['or_rentprice']?>元/月</h3></td>
                <td width="13%"><h3 style="color:red">&nbsp;&nbsp;--&nbsp;&nbsp;</h3></td>
                    <?php }?>
            </tr>
        </table>
    </div>
</div>
<hr style="border:1px dashed #cccccc; height:1px" width="720px"/>
<div class="clear5"></div>
