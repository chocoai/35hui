<div class="schcont">
    <div class="schdes">
        <div class="cypic"><a href="<?=Yii::app()->createUrl("businesscenter/view",array("id"=>$data->bc_id))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($data->bc_titlepic,"_large");?>" /></a></div>
        <div class="cytxt">
            <h2><a href="<?=Yii::app()->createUrl("businesscenter/view",array("id"=>$data->bc_id))?>" target="_blank"><?=$data->bc_name?></a></h2>
            <p>[ <?=Region::model()->getNameById($data->bc_district)?> ]&nbsp;&nbsp;&nbsp;<?=$data->bc_address?>&nbsp;&nbsp;&nbsp;<?=$data->bc_sysid?CHtml::link(Systembuildinginfo::model()->getBuildNameById($data->bc_sysid),array("systembuildinginfo/view","id"=>$data->bc_sysid),array("target"=>"_blank")):""?> &nbsp;&nbsp;&nbsp;<?=$data->bc_floor?$data->bc_floor."楼":""?></p>
            <p style="overflow:hidden"><span class="cy_1" >服务品牌：<?=$data->bc_serverbrand?$data->bc_serverbrand:"暂无资料"?></span><span class="cy_2">装修风格：<?=$data->bc_decoratestyle?></span></p>
            <p><span class="cy_1">竣工时间：<?=$data->bc_completetime?date("Y年",$data->bc_completetime):"暂无资料"?></span><span class="cy_2">服务语言：<?=$data->bc_serverlanguage?></span></p>
            <p>咨询热线：<span style='color:#82B937;font-weight:bold;'>400-820-9181</span></p>
        </div>
        <div class="schpk" style="position: relative;">
            <div style=" position: absolute;left:-58px; width: 190px;">
                <div class="pkt"><?=$data->bc_rentprice?"<code style=' color: #808080;'>参考租金：</code><em>".$data->bc_rentprice."</em>元/工位.月":""?></div>
            <div class="pkb"><input type="checkbox" id="build_<?=$data->bc_id?>" value="<?=$data->bc_id?>" attrprice="<?=$data->bc_rentprice?$data->bc_rentprice:"0"?>" attrname="<?=common::strCut($data->bc_name,24)?>"/> <label for="build_<?=$data->bc_id?>">加入比较</label></div>
        </div>
            </div>
        <div class="schtan"  style="display:none;">
            <div class="schbord">
                <div class="swdcont" style="display:none">
                    <a href="<?=Yii::app()->createUrl("businesscenter/view",array("id"=>$data->bc_id))?>" target="_blank"><img src="<?=Picture::model()->getOnePicExceptTitleInt($data->bc_id,3,$data->bc_titlepic,"_large");?>" width="286px" height="200px"/></a>
                    <table cellpadding="0" cellspacing="0"  border="0" class="table_06">
                        <tr>
                            <td colspan="2" class="tit">免费服务：</td>
                        </tr>
                        <tr>
                        <?php
                        $freeServer = Businessserverconfig::model()->getInfo($data->bc_freeserver);
                        foreach($freeServer as $key=>$value){
                            echo "<td>".$value->bs_name."</td>";
                            echo ($key%2)==1?"</tr><tr>":"";
                        }
                        ?>
                        </tr>
                        <tr>
                            <td colspan="2" class="tit">收费服务：</td>
                        </tr>
                        <tr>
                        <?php
                        $freeServer = Businessserverconfig::model()->getInfo($data->bc_payserver);
                        foreach($freeServer as $key=>$value){
                            echo "<td>".$value->bs_name."</td>";
                            echo ($key%2)==1?"</tr><tr>":"";
                        }
                        ?>
                        </tr>
                    </table>
                </div>
                <img src="/images/ltip.jpg" />
            </div>
        </div>
    </div>
</div>	