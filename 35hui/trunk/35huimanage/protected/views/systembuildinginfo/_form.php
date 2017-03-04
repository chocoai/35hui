<script src="<?=Yii::app()->request->baseUrl;?>/js/dateinput.min.js"></script>
<style type="text/css">
    table td{margin: 1px;border: 1px gray solid;}
    .row table td label{display: inline;font-weight: normal}
    .row table th{background-color: #6FACCF;color:white}
</style>
<link rel="stylesheet" type="text/css" href="<?=Yii::app()->request->baseUrl;?>/css/dateinput.css"/>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'systembuildinginfo-form',
            'enableAjaxValidation'=>true,
    )); ?>

    <p class="note">标注 <span class="required">*</span> 号的为必填项.</p>
    <div class="row">
        <?php echo $form->labelEx($model,'sbi_buildingname'); ?>
        <?php echo $form->textField($model,'sbi_buildingname',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($model,'sbi_buildingname'); ?>
    </div>
    
    <? 
    $newbuild="";
    if($model->sbi_buildingid){
        $newbuild=Newbuild::model()->find("nb_sid=".$model->sbi_buildingid);
    }?>
    <label><input type="checkbox" name="newbuildinfo" <?php echo $newbuild?"checked":""; ?>  onchange="shownew(this)">是否新盘</label>
    <div class="row" id="newbuildop" <?if(!$newbuild)echo 'style="display:none"';?> >
            <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/js/kindeditor/kindeditor.js"></script>
            <script type="text/javascript">
            KE.show({
                id : 'yingxiao',
                resizeMode : 1,
                allowUpload : false,
                width : "70%",
                height : "100px",
                items : [
                'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'link']
            });

            </script>
            <label>优势</label>
            <textarea style="width:69%;height:50px;" id="youshi" name="newbuild[nb_youshi]"/><?=$newbuild?$newbuild->nb_youshi:""?></textarea>
            <label>特色</label><font style="font-size:10px;color:#808080">特色字段之间以<font style="color:#ff0000;">，(中文)</font>分割 。例子 每个特色字段将只显示<font style="color:#ff0000;">5</font>个中文字符剩余的以提示信息显示</font>
            <textarea style="width:69%;height:50px;" id="youshi" name="newbuild[nb_characteristic]"/><?=$newbuild?$newbuild->nb_characteristic:""?></textarea>
            <label>营销手段</label>
            <textarea style="width:70%;height:50px;" id="yingxiao"name="newbuild[nb_yingxiao]" /><?=$newbuild?$newbuild->nb_yingxiao:""?></textarea>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'sbi_buildtype'); ?>
        <?php echo $form->radioButtonList($model,'sbi_buildtype',Systembuildinginfo::$sbi_buildtype,array("style"=>"display:inline","separator"=>"&nbsp;","labelOptions"=>array("style"=>"display:inline"),"onClick"=>"changeTags(this)")); ?>
        <?php echo $form->error($model,'sbi_buildtype'); ?>
    </div>
    <div class="row" id="buildTag">
        <?php echo $form->labelEx($model,'sbi_tag'); ?>
        <div id="tags_systemBuilding" style="display: <?=$model->sbi_buildtype==1?"":"none"?>">
            <?php
            $tags = Tags::model()->getTagsByTypeAndMarke(Tags::systemBuildings,Tags::all,12);
            $tagsarr = array();
            if(!empty($model->sbi_tag)){
                $tagsarr = split(",", $model->sbi_tag);
            }
            if(!empty($tags)){
                foreach($tags as $key=>$value){
                    ?>
            <input type="checkbox" name="tag[]" value="<?=$value->tag_name;?>" <?php if(in_array($value->tag_name,$tagsarr))echo "checked"; ?> onclick="checkTagNum(this)" /><?=$value->tag_name?>&nbsp;&nbsp;
                    <?php
                }
            }
            ?>
        </div>
        <div id="tags_systemBuildingshop" style="display: <?=$model->sbi_buildtype==2?"":"none"?>">
            <?php
            $tags = Tags::model()->getTagsByTypeAndMarke(Tags::systemBuildingsShop,Tags::all,12);
            $tagsarr = array();
            if(!empty($model->sbi_tag)){
                $tagsarr = split(",", $model->sbi_tag);
            }
            if(!empty($tags)){
                foreach($tags as $key=>$value){
                    ?>
            <input type="checkbox" name="tag[]" value="<?=$value->tag_name;?>" <?php if(in_array($value->tag_name,$tagsarr))echo "checked"; ?> onclick="checkTagNum(this)" /><?=$value->tag_name?>&nbsp;&nbsp;
                    <?php
                }
            }
            ?>
        </div>

    </div>
    <div class="row">
        <?php echo $form->dropDownList($model,'sbi_district',Region::model()->getTarafUnits($model->sbi_district?$model->sbi_district:37),array("empty"=>"--请选择--",'onChange'=>"changeChildren('district')")); ?>
        <?php echo $form->dropDownList($model,'sbi_section',$model->sbi_section!=0?Region::model()->getTarafUnits($model->sbi_section):array(),array("empty"=>"--请选择--",'onChange'=>"changeChildren('section')")); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sbi_loop'); ?>
        <?php echo $form->dropDownList($model,'sbi_loop',Searchcondition::model()->getAllLoops()); ?>
        <?php echo $form->error($model,'sbi_loop'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sbi_busway'); ?>
        <?php
        $sbi_busway = array();
        if($model->sbi_busway!=""){
            $sbi_busway = split(",", $model->sbi_busway);
        }
        ?>
        <input type="checkbox" id="sbi_busway_1" name="sbi_busway[]" value="1" <?php if(in_array(1, $sbi_busway))echo "checked"; ?>/>1号线
        <input type="checkbox" id="sbi_busway_2" name="sbi_busway[]" value="2" <?php if(in_array(2, $sbi_busway))echo "checked"; ?>/>2号线
        <input type="checkbox" id="sbi_busway_3" name="sbi_busway[]" value="3" <?php if(in_array(3, $sbi_busway))echo "checked"; ?>/>3号线
        <input type="checkbox" id="sbi_busway_4" name="sbi_busway[]" value="4" <?php if(in_array(4, $sbi_busway))echo "checked"; ?>/>4号线
        <input type="checkbox" id="sbi_busway_5" name="sbi_busway[]" value="5" <?php if(in_array(5, $sbi_busway))echo "checked"; ?>/>5号线
        <input type="checkbox" id="sbi_busway_6" name="sbi_busway[]" value="6" <?php if(in_array(6, $sbi_busway))echo "checked"; ?>/>6号线
        <input type="checkbox" id="sbi_busway_7" name="sbi_busway[]" value="7" <?php if(in_array(7, $sbi_busway))echo "checked"; ?>/>7号线
        <input type="checkbox" id="sbi_busway_8" name="sbi_busway[]" value="8" <?php if(in_array(8, $sbi_busway))echo "checked"; ?>/>8号线
        <input type="checkbox" id="sbi_busway_9" name="sbi_busway[]" value="9" <?php if(in_array(9, $sbi_busway))echo "checked"; ?>/>9号线
        <input type="checkbox" id="sbi_busway_10" name="sbi_busway[]" value="10" <?php if(in_array(10, $sbi_busway))echo "checked"; ?>/>10号线
        <input type="checkbox" id="sbi_busway_11" name="sbi_busway[]" value="11" <?php if(in_array(11, $sbi_busway))echo "checked"; ?> />11号线
        <input type="checkbox" id="sbi_busway_12" name="sbi_busway[]" value="12" <?php if(in_array(12, $sbi_busway))echo "checked"; ?>/>12号线
        <input type="checkbox" id="sbi_busway_13" name="sbi_busway[]" value="13" <?php if(in_array(13, $sbi_busway))echo "checked"; ?>/>13号线
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'sbi_address'); ?>
        <?php echo $form->textField($model,'sbi_address',array('size'=>60,'maxlength'=>200)); ?>
        <?php echo $form->error($model,'sbi_address'); ?>
        <input type="button" value="获得坐标" onClick="window.frames['framemap'].geocodeSearch($('#Systembuildinginfo_sbi_address').val())"/>
    </div>

    <div class="row">
        <?php
        $array = array();
        if(!$model->isNewRecord){
            $array = array(
                    "name"=>urlencode("人民广场"),
            );
            $model->sbi_x?$array["x"] = urlencode($model->sbi_x):"";
            $model->sbi_y?$array["y"] = urlencode($model->sbi_y):"";
        }
        $frameurl = Yii::app()->createUrl("/map/framemap",$array);
        ?>
        <iframe id="framemap" name="framemap" src="<?=$frameurl;?>" width="100%" height="400px" frameborder="0" scrolling="no"></iframe>
    </div>

    <div class="row">
        <table width="100%" >
            <th colspan="2">基本信息</th>
            <tr>
                <td width="50%">
                    <?php echo $form->labelEx($model,'sbi_x'); ?>
                    <?php echo $form->textField($model,'sbi_x',array('size'=>30,'maxlength'=>200,'readonly'=>"true")); ?>
                    <?php echo $form->error($model,'sbi_x'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_y'); ?>
                    <?php echo $form->textField($model,'sbi_y',array('size'=>30,'maxlength'=>200,'readonly'=>"true")); ?>
                    <?php echo $form->error($model,'sbi_y'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_buildingenglishname'); ?>
                    <?php echo $form->textField($model,'sbi_buildingenglishname',array('size'=>30)); ?>
                    <?php echo $form->error($model,'sbi_buildingenglishname'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_defanglv'); ?>
                    <?php echo $form->textField($model,'sbi_defanglv',array('size'=>20)); ?> %
                    <?php echo $form->error($model,'sbi_defanglv'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_foreign'); ?>
                    <?php echo $form->dropDownList($model,'sbi_foreign',array(0=>'否',1=>'是')); ?>
                    <?php echo $form->error($model,'sbi_foreign'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_openingtime'); ?>
                    <input type="date" name="Systembuildinginfo[sbi_openingtime]" <?if($model->sbi_openingtime){ ?> value="<?=date("Y-m-d",$model->sbi_openingtime);?>" <? } ?> min="1949-01-01" max="2099-12-30">
                    <?php echo $form->error($model,'sbi_openingtime'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_propertyname'); ?>
                    <?php echo $form->textField($model,'sbi_propertyname',array('size'=>30,'maxlength'=>50)); ?>
                    <?php echo $form->error($model,'sbi_propertyname'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_propertytel'); ?>
                    <?php echo $form->textField($model,'sbi_propertytel',array('size'=>20,'maxlength'=>20)); ?>
                    <?php echo $form->error($model,'sbi_propertytel'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_developer'); ?>
                    <?php echo $form->textField($model,'sbi_developer',array('size'=>30,'maxlength'=>60)); ?>
                    <?php echo $form->error($model,'sbi_developer'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_propertyprice'); ?>
                    <?php echo $form->textField($model,'sbi_propertyprice'); ?>(元/平米•月)
                    <?php echo $form->error($model,'sbi_propertyprice'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_propertydegree'); ?>
                    <?php echo $form->dropDownList($model,'sbi_propertydegree',Systembuildinginfo::$propertyDegree); ?>
                    <?php echo $form->error($model,'sbi_propertydegree'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_floor'); ?>
                    <?php echo $form->textField($model,'sbi_floor'); ?>
                    <?php echo $form->error($model,'sbi_floor'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_buildingarea'); ?>
                    <?php echo $form->textField($model,'sbi_buildingarea'); ?>㎡
                    <?php echo $form->error($model,'sbi_buildingarea'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_floorarea'); ?>
                    <?php echo $form->textField($model,'sbi_floorarea'); ?>㎡
                    <?php echo $form->error($model,'sbi_floorarea'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_avgrentprice'); ?>
                    <?php echo $form->textField($model,'sbi_avgrentprice',array('size'=>10,'maxlength'=>60)); ?>元/平米•天（没有请填0）
                    <?php echo $form->error($model,'sbi_avgrentprice'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_avgsellprice'); ?>
                    <?php echo $form->textField($model,'sbi_avgsellprice',array('size'=>10,'maxlength'=>60)); ?>元/平米（没有请填0）
                    <?php echo $form->error($model,'sbi_avgsellprice'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_isnew'); ?>
                    <?php echo $form->dropDownList($model,'sbi_isnew',array(0=>'否',1=>'是')); ?>
                    <?php echo $form->error($model,'sbi_isnew'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_tel'); ?>
                    <?php echo $form->textField($model,'sbi_tel'); ?>
                    <?php echo $form->error($model,'sbi_tel'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_dongnum'); ?>
                    <?php echo $form->textField($model,'sbi_dongnum',array('size'=>10,'maxlength'=>60)); ?>
                    <?php echo $form->error($model,'sbi_dongnum'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_wailimian'); ?>
                    <?php echo $form->textField($model,'sbi_wailimian',array('size'=>30,'maxlength'=>60)); ?>
                    <?php echo $form->error($model,'sbi_wailimian'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelEx($model,'sbi_danyuanfenge'); ?>
                    <?php echo $form->textField($model,'sbi_danyuanfenge',array('size'=>30,'maxlength'=>60)); ?>㎡
                    <?php echo $form->error($model,'sbi_danyuanfenge'); ?>
                </td>
                <td>
                    <?php echo $form->labelEx($model,'sbi_toiletwater'); $sbi_toiletwater = unserialize($model->sbi_toiletwater);?>

                    <input name="sbi_toiletwater[冷水]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("冷水", $sbi_toiletwater)=="1"?"checked":""?>/>冷水
                    <input name="sbi_toiletwater[冷热水]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("冷热水", $sbi_toiletwater)=="1"?"checked":""?>/>冷热水
                    <input name="sbi_toiletwater[恒温水]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("恒温水", $sbi_toiletwater)=="1"?"checked":""?>/>恒温水
                </td>
            </tr>
        </table>
        <table width="100%">
            <?php
            $sbi_datang = unserialize($model->sbi_datang);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_datang'); ?></th>
            <tr>
                <td width="50%"><label>层高</label><input name="sbi_datang[层高]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("层高", $sbi_datang)?>" type="text" />m</td>
                <td><label>地面</label><input name="sbi_datang[地面]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("地面", $sbi_datang)?>" type="text"/></td>
            </tr>
            <tr>
                <td><label>墙面</label><input name="sbi_datang[墙面]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("墙面", $sbi_datang)?>" type="text"/></td>
                <td><label>天花</label><input name="sbi_datang[天花]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("天花", $sbi_datang)?>" type="text"/></td>
            </tr>
            <?php
            $sbi_zoulang = unserialize($model->sbi_zoulang);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_zoulang'); ?></th>
            <tr>
                <td><label>宽度</label><input name="sbi_zoulang[宽度]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("宽度", $sbi_zoulang)?>"  type="text"/>m</td>
                <td><label>地面</label><input name="sbi_zoulang[地面]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("地面", $sbi_zoulang)?>" type="text"/></td>
            </tr>
            <tr>
                <td><label>墙面</label><input name="sbi_zoulang[墙面]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("墙面", $sbi_zoulang)?>" type="text"/></td>
                <td><label>天花</label><input name="sbi_zoulang[天花]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("天花", $sbi_zoulang)?>" type="text"/></td>
            </tr>
            <?php
            $sbi_floorinfo = unserialize($model->sbi_floorinfo);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_floorinfo'); ?></th>
            <tr>
                <td><label>面积</label><input name="sbi_floorinfo[面积]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("面积", $sbi_floorinfo)?>"  type="text"/>㎡</td>
                <td><label>层高</label><input name="sbi_floorinfo[层高]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("层高", $sbi_floorinfo)?>" type="text"/>m</td>
            </tr>
            <tr>
                <td><label>净层高</label><input name="sbi_floorinfo[净层高]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("净层高", $sbi_floorinfo)?>" type="text"/>m</td>
                <td><label>有架空地板</label>
                    <input name="sbi_floorinfo[有架空地板]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("有架空地板", $sbi_floorinfo)=="1"?"checked":""?>/>
                </td>
            </tr>
            <?php
            $sbi_biaozhun = unserialize($model->sbi_biaozhun);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_biaozhun'); ?></th>
            <tr>
                <td><label>地面</label><input name="sbi_biaozhun[地面]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("地面", $sbi_biaozhun)?>"  type="text"/></td>
                <td><label>墙面</label><input name="sbi_biaozhun[墙面]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("墙面", $sbi_biaozhun)?>" type="text"/></td>
            </tr>
            <tr>
                <td><label>天花</label><input name="sbi_biaozhun[天花]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("天花", $sbi_biaozhun)?>" type="text"/></td>
                <td></td>
            </tr>

            <?php
            $sbi_liftinfo = unserialize($model->sbi_liftinfo);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_liftinfo'); ?></th>
            <tr>
                <td><label>速度</label><input name="sbi_liftinfo[速度]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("速度", $sbi_liftinfo)?>"  type="text"/>m/s</td>
                <td><label>品牌</label><input name="sbi_liftinfo[品牌]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("品牌", $sbi_liftinfo)?>" type="text"/></td>
            </tr>
            <tr>
                <td><label>客梯</label><input name="sbi_liftinfo[客梯]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("客梯", $sbi_liftinfo)?>" type="text"/>部</td>
                <td><label>货梯</label><input name="sbi_liftinfo[货梯]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("货梯", $sbi_liftinfo)?>" type="text"/>部</td>
            </tr>
            <tr>
                <td><label>平均等候时间</label><input name="sbi_liftinfo[平均等候时间]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("平均等候时间", $sbi_liftinfo)?>" type="text"/> 秒</td>
                <td><label>忙时等候时间</label><input name="sbi_liftinfo[忙时等候时间]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("忙时等候时间", $sbi_liftinfo)?>" type="text"/> 秒</td>
            </tr>

            <?php
            $sbi_carport = unserialize($model->sbi_carport);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_carport'); ?></th>
            <tr>
                <td><label>地下</label><input name="sbi_carport[地下]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("地下", $sbi_carport)?>"  type="text"/>个</td>
                <td><label>地上</label><input name="sbi_carport[地上]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("地上", $sbi_carport)?>" type="text"/>个</td>
            </tr>
            <tr>
                <td><label>月租金</label><input name="sbi_carport[月租金]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("月租金", $sbi_carport)?>" type="text"/>元/月</td>
                <td><label>时租金</label><input name="sbi_carport[时租金]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("时租金", $sbi_carport)?>" type="text"/>元/小时</td>
            </tr>
        </table>
        <table width="100%">
            <th colspan="2">其他</th>
            <tr>
                <td width="20%"><?php echo $form->labelEx($model,'sbi_communication'); ?></td>
                <td>
                    <?php
                    $sbi_communication = unserialize($model->sbi_communication);
                    ?>
                    <input name="sbi_communication[光纤]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("光纤", $sbi_communication)=="1"?"checked":""?>/>光纤
                    <input name="sbi_communication[ADSL]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("ADSL", $sbi_communication)=="1"?"checked":""?>/>ADSL
                    <input name="sbi_communication[无线网络]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("无线网络", $sbi_communication)=="1"?"checked":""?>/>无线网络
                    <input name="sbi_communication[卫星系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("卫星系统", $sbi_communication)=="1"?"checked":""?>/>卫星系统
                    <input name="sbi_communication[微波系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("微波系统", $sbi_communication)=="1"?"checked":""?>/>微波系统
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'sbi_aircon'); ?></td>
                <td>
                    <?php
                    $sbi_aircon = unserialize($model->sbi_aircon);
                    ?>
                    <input name="sbi_aircon[集中式中央空调]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("集中式中央空调", $sbi_aircon)=="1"?"checked":""?>/>集中式中央空调
                    <input name="sbi_aircon[半集中式中央空调]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("半集中式中央空调", $sbi_aircon)=="1"?"checked":""?>/>半集中式中央空调
                    <input name="sbi_aircon[分体空调]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("分体空调", $sbi_aircon)=="1"?"checked":""?>/>分体空调
                    <input name="sbi_aircon[新风系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("新风系统", $sbi_aircon)=="1"?"checked":""?>/>新风系统
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'sbi_security'); ?></td>
                <td>
                    <?php
                    $sbi_security = unserialize($model->sbi_security);
                    ?>
                    <input name="sbi_security[IC一卡通控制系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("IC一卡通控制系统", $sbi_security)=="1"?"checked":""?>/>IC一卡通控制系统
                    <input name="sbi_security[闭路电视监视系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("闭路电视监视系统", $sbi_security)=="1"?"checked":""?>/>闭路电视监视系统
                    <input name="sbi_security[应急电源,照明和扩音系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("应急电源,照明和扩音系统", $sbi_security)=="1"?"checked":""?>/>应急电源,照明和扩音系统
                    <input name="sbi_security[24小时巡逻系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("24小时巡逻系统", $sbi_security)=="1"?"checked":""?>/>24小时巡逻系统<br />
                    <input name="sbi_security[门传感器监视系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("门传感器监视系统", $sbi_security)=="1"?"checked":""?>/>门传感器监视系统
                    <input name="sbi_security[停车控制及车牌识别系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("停车控制及车牌识别系统", $sbi_security)=="1"?"checked":""?>/>停车控制及车牌识别系统
                    <input name="sbi_security[智能自动火警检测系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("智能自动火警检测系统", $sbi_security)=="1"?"checked":""?>/>智能自动火警检测系统
                    <input name="sbi_security[自动喷水灭火系统]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("自动喷水灭火系统", $sbi_security)=="1"?"checked":""?>/>自动喷水灭火系统
                </td>
            </tr>
            <tr>
                <td><?php echo $form->labelEx($model,'sbi_roommating'); ?></td>
                <td>
                    <?php
                    $sbi_roommating = unserialize($model->sbi_roommating);
                    ?>
                    <input name="sbi_roommating[银行]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("银行", $sbi_roommating)=="1"?"checked":""?>/>银行
                    <input name="sbi_roommating[ATM]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("ATM", $sbi_roommating)=="1"?"checked":""?>/>ATM
                    <input name="sbi_roommating[餐饮]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("餐饮", $sbi_roommating)=="1"?"checked":""?>/>餐饮
                    <input name="sbi_roommating[便利店]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("便利店", $sbi_roommating)=="1"?"checked":""?>/>便利店
                    <input name="sbi_roommating[食堂]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("食堂", $sbi_roommating)=="1"?"checked":""?>/>食堂
                    <input name="sbi_roommating[干洗店]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("干洗店", $sbi_roommating)=="1"?"checked":""?>/>干洗店
                    <input name="sbi_roommating[商务中心]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("商务中心", $sbi_roommating)=="1"?"checked":""?>/>商务中心
                    <input name="sbi_roommating[会议室]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("会议室", $sbi_roommating)=="1"?"checked":""?>/>会议室
                    <input name="sbi_roommating[会展中心]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("会展中心", $sbi_roommating)=="1"?"checked":""?>/>会展中心
                </td>
            </tr>

            <tr>
                <td><?php echo $form->labelEx($model,'sbi_propertyserver'); ?></td>
                <td>
                    <?php
                    $sbi_propertyserver = unserialize($model->sbi_propertyserver);
                    ?>
                    卫生:<input name="sbi_propertyserver[卫生]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("卫生", $sbi_propertyserver)?>" type="text"/>
                    <input name="sbi_propertyserver[收发邮件]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("收发邮件", $sbi_propertyserver)=="1"?"checked":""?>/>收发邮件
                    <input name="sbi_propertyserver[订阅报刊]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("订阅报刊", $sbi_propertyserver)=="1"?"checked":""?>/>订阅报刊
                    <input name="sbi_propertyserver[订阅机票酒店]" value="1" type="checkbox" <?=Systembuildinginfo::model()->getSerializeValueByName("订阅机票酒店", $sbi_propertyserver)=="1"?"checked":""?>/>订阅机票酒店
                </td>
            </tr>
        </table>

        <table width="100%">
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_buildingintroduce'); ?></th>
            <tr>
                <td colspan="2">
                    <?php echo $form->textArea($model,'sbi_buildingintroduce',array('rows'=>6, 'cols'=>80)); ?>
                    <?php echo $form->error($model,'sbi_buildingintroduce'); ?>
                </td>
            </tr>
            <?php
            $sbi_peripheral = unserialize($model->sbi_peripheral);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_peripheral'); ?></th>
            <tr>
                <td width="20%">临近商街</td>
                <td>
                    <input name="sbi_peripheral[临近商街]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("临近商街", $sbi_peripheral)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td>商场</td>
                <td>
                    <input name="sbi_peripheral[商场]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("商场", $sbi_peripheral)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td>酒店</td>
                <td>
                    <input name="sbi_peripheral[酒店]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("酒店", $sbi_peripheral)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td>银行</td>
                <td>
                    <input name="sbi_peripheral[银行]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("银行", $sbi_peripheral)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td>餐饮</td>
                <td>
                    <input name="sbi_peripheral[餐饮]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("餐饮", $sbi_peripheral)?>" type="text" size="60"/>
                </td>
            </tr>

            <?php
            $sbi_traffic = unserialize($model->sbi_traffic);
            ?>
            <th colspan="2"><?php echo $form->labelEx($model,'sbi_traffic'); ?></th>
            <tr>
                <td width="20%">轨道交通</td>
                <td>
                    <input name="sbi_traffic[轨道交通]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("轨道交通", $sbi_traffic)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td width="20%">高架</td>
                <td>
                    <input name="sbi_traffic[高架]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("高架", $sbi_traffic)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td width="20%">机场</td>
                <td>
                    <input name="sbi_traffic[机场]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("机场", $sbi_traffic)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td width="20%">公交车</td>
                <td>
                    <input name="sbi_traffic[公交车]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("公交车", $sbi_traffic)?>" type="text" size="60"/>
                </td>
            </tr>
            <tr>
                <td width="20%">火车站</td>
                <td>
                    <input name="sbi_traffic[火车站]" value="<?=Systembuildinginfo::model()->getSerializeValueByName("火车站", $sbi_traffic)?>" type="text" size="60"/>
                </td>
            </tr>

        </table>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">
    function checkTagNum(obj){
        var num = $("#buildTag input:checked").length;
        if(num>6){
            alert("很遗憾，最多只能选择六个标签！")
            $(obj).get(0).checked = 0;
        }
    }
    function changeChildren(type){
        var childrenHtml = "";
        var prefixStr = "Systembuildinginfo_sbi_";
        var regionArray = {
            'province':{
                'parent':'province',
                'child':'city'
            },
            'city':{
                'parent':'city',
                'child':'district'
            },
            'district':{
                'parent':'district',
                'child':'section'
            },
            'section':{
                'parent':'section',
                'child':'tradecircle'
            }
        };
        var parentEle = prefixStr+regionArray[type]['parent'];
        var childEle = prefixStr+regionArray[type]['child'];
        var parentId = $('#'+parentEle).val();
        if(parentId!=""&&parentId!=null){
            $.ajax({
                type: "GET",
                url: "<?=Yii::app()->createUrl('region/ajaxGetChildren');?>",
                data: type+"="+parentId,
                success: function(childrenData){
                    if(childrenData!="[]"){
                        eval("var childrenData = " + childrenData + ";");
                        for(key in childrenData){
                            childrenHtml += "<option value="+key+">"+childrenData[key]+"</option>";
                        }
                        $("#"+childEle).html(childrenHtml);
                    }else{
                        $("#"+childEle).html("");
                    }
                    //把之后的所有选择框都去除
                    var nextnode = regionArray[type]['child'];
                    while(nextnode!="tradecircle"){
                        var id = prefixStr+regionArray[nextnode]['child'];
                        $("#"+id).html("");
                        nextnode = regionArray[nextnode]['child'];
                    }
                }
            });
        }else{
            $("#"+childEle).html('<option value="">--请选择--</option>');
        }
    }
    $.tools.dateinput.localize("fr",  {
        months:        '一月,二月,三月,四月,五月,六月,七月,八月,' +
            '九月,十月,十一月,十二月',
        shortMonths:   '一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月',
        days:          '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
        shortDays:     '周日,周一,周二,周三,周四,周五,周六'
    });
    $(":date").dateinput({
        selectors: true,
        lang: 'fr',
        format: 'yyyy-mm-dd'
    });
    function changeTags(obj){
        //先把所有的选择都去除
        for (var i=0;i<$("#buildTag input").length;i++){
            $("#buildTag input").eq(i).get(0).checked = 0;
        }
        var value = $(obj).val();
        if(value==1){//写字楼
            $("#tags_systemBuilding").css("display","");
            $("#tags_systemBuildingshop").css("display","none")
        }else{//商业广场
            $("#tags_systemBuilding").css("display","none");
            $("#tags_systemBuildingshop").css("display","")
        }
    }
    if('<?=$model->sbi_district?>' == ''){//新增楼盘时，默认显示37编号区，显示完后，要加载该区的所有版块
        changeChildren('district');
        changeChildren('section');
    }
    function setLocalXY(x,y){
        $("#Systembuildinginfo_sbi_x").val(x);
        $("#Systembuildinginfo_sbi_y").val(y);
    }
    function shownew(obj){
        if(obj.checked){
            $("#newbuildop").show()
        }else{
            $("#newbuildop").hide()
        }
    }
</script>