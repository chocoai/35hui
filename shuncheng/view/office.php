<?php

$model = $data->data;
$_region = getRegions();
?>
<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo $model->sbi_buildingname  ?></div>
			<div class="egtit"><?php echo $model->sbi_buildingenglishname  ?></div>
		</div>
	</div>

    <div class="dlcont">
		<div class="dlleft">
			<div class="dllcont">
				<p>楼盘地址：[<?php echo @$_region[$model->sbi_district]  ?>] <?php echo $model->sbi_address ?>
                </p>
				<p><span class="dll_01">楼宇等级：<?php echo $model->sbi_propertydegree?$model->sbi_propertydegree:"暂无资料";?></span>
                    <span class="dll_01">得 房 率：<?php echo $model->sbi_defanglv?$model->sbi_defanglv.'%':"暂无资料";?></span></p>
				<p><span class="dll_01">楼宇层数：<?php echo $model->sbi_floor?$model->sbi_floor.'层':"暂无资料";?></span>
                    <span class="dll_01">竣工年月：<?php echo $model->sbi_openingtime?date('Y年',$model->sbi_openingtime):"暂无资料"?></span></p>
			</div>
			<div class="dllcont">
				<p><span class="dll_01">租金报价：<?php echo $model->sbi_avgrentprice>0?'<em>'.$model->sbi_avgrentprice.'</em>元/平米.天':'暂无资料'?></span>
                    <span class="dll_01">出售报价：<?=$model->sbi_avgsellprice>0?'<em>'.$model->sbi_avgsellprice."</em>元/平米":"暂无资料"?></span></p>
				<p><span class="dll_01">物业费用：<?php echo $model->sbi_propertyprice?'<em>'.$model->sbi_propertyprice."</em>元/平米.天":"暂无资料"?></span></p>
			</div>
			<div class="dllcont">
				<p>开发商户：<?php echo $model->sbi_developer?$model->sbi_developer:"暂无资料";?></p>
				<p>物业管理：<?php echo $model->sbi_propertyname?$model->sbi_propertyname:'暂无资料'?></p>
			</div>
		</div>
		<div class="dlright">
            <div style="width:500px;height: 317px;" class="dlqj">
               <script type="text/javascript" src="<?php echo API_DIBIAO.'api/search/panorama?id='.$model->sbi_buildingid.'&type=1&size=500x317';?>"></script>
            </div>
            <div class="dltxt">
                <?php echo $model->sbi_buildingintroduce ?>
            </div>
		</div>
	</div>
<div class="dlmain">
		<div class="dlleft">
<?php
if(!empty($data->picture)){
?>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">相 册</a></li>
				</ul>
			</div>
			<div class="lpline">
            <?php
                foreach($data->picture as $pic){
                    $src = PIC_URL.fImage($pic->p_img,"_large");
                    $typeDsc = $pic->p_type;
                ?>
                <div class="sjmod">
                    <a href="<?php echo PIC_URL.$pic->p_img ?>" title="<?php echo $typeDsc ?>" target="_blank">
                        <img alt="" src="<?php echo $src ?>">
                    </a>
					<p><?php echo $pic->p_title ?></p>
				</div>
                <?php } ?>
            </div>
<?php } ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">地理位置</a></li>
				</ul>
			</div>
			<div class="left_map" id="mapabc_box"  style="width: 720px;height: 268px">
            </div>
            <script type="text/javascript">_MAPxy = {name:"<?php echo $model->sbi_buildingname ?>",x:"<?php echo $model->sbi_x?$model->sbi_x:'121.47536873817444' ?>",y:"<?php echo $model->sbi_y?$model->sbi_y:'31.232857675162947' ?>"};</script>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">详细参数</a></li>
				</ul>
			</div>
            <div class="dllcont">
			<table cellspacing="0" cellpadding="0" border="0" class="table_03">
				<tr>
					<td class="title" colspan="2">产品参数</td>
				</tr>
				<tr>
					<td width="16%" class="tit">地址</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_address); ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">竣工年月</td>
					<td width="84%" class="txt"><?php echo $model->sbi_openingtime?date('Y年',$model->sbi_openingtime):"暂无资料"?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">楼宇总建筑面积</td>
					<td width="84%" class="txt"><?php echo $model->sbi_buildingarea?$model->sbi_buildingarea.'平米':"暂无资料"?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">楼宇总楼数</td>
					<td width="84%" class="txt"><?php echo $model->sbi_dongnum;?>栋</td>
				</tr>
				<tr>
					<td width="16%" class="tit">楼宇总层数</td>
					<td width="84%" class="txt"><?php echo $model->sbi_floor?$model->sbi_floor.'层':"暂无资料"?></td>
				</tr>
				<tr>
					<td class="title" colspan="2">相关企业</td>
				</tr>
				<tr>
					<td width="16%" class="tit">开发商</td>
					<td width="84%" class="txt"><?php echo $model->sbi_developer?CHtml::encode($model->sbi_developer):"暂无资料";?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">物业管理公司</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_propertyname?$model->sbi_propertyname:'暂无资料')?></td>
				</tr>
				<tr>
					<td class="title" colspan="2">硬件参数</td>
				</tr>
				<tr>
					<td width="16%" class="tit">外立面</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_wailimian?$model->sbi_wailimian:'暂无资料'); ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">大堂</td>
					<td width="84%" class="txt"><?php
                    $fuck=true;
                    if($model->sbi_datang){
                        foreach(unserialize($model->sbi_datang) as $k=>$v){
                            if(empty($v)) continue;
                            $fuck=false;
                            echo $k,'：',$v;
                            if($k=='层高') echo 'm';
                            echo ' 　　';
                        }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">公共走廊    </td>
					<td width="84%" class="txt"><?php
                    $fuck=true;
                    if($model->sbi_zoulang){
                    foreach(unserialize($model->sbi_zoulang) as $k=>$v){
                        if(empty($v)) continue;
                        echo $k,'：',$v,' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">楼层信息    </td>
					<td width="84%" class="txt"><?php
                    $fuck=true;
                    $_unit=array('平米','米','米','mark','','','','','','');
                    $i=-1;
                    if($model->sbi_floorinfo){
                    foreach(unserialize($model->sbi_floorinfo) as $k=>$v){
                        $i++;
                        if(empty($v)) continue;
                        $fuck=false;
                        if($_unit[$i] == 'mark') {
                            echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k;
                        }else{
                            echo $k,'：',$v;
                            echo $_unit[$i];
                        }
                        echo ' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">单元分割面积    </td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_danyuanfenge?$model->sbi_danyuanfenge.'平米':'暂无资料'); ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">交屋标准    </td>
					<td width="84%" class="txt"><?php
                    $fuck=true;
                    if($model->sbi_biaozhun){
                    foreach(unserialize($model->sbi_biaozhun) as $k=>$v){
                        if(empty($v)) continue;
                        $fuck=false;
                        echo $k,'：',$v,' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">卫生间供水</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_toiletwater){
                    foreach(unserialize($model->sbi_toiletwater) as $k=>$v){
                        echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">电梯配置</td>
					<td width="84%" class="txt"><?php
                    $fuck=true;
                    $_unit=array('m/s','','部','部','s','s','','','','');
                    $i=-1;
                    if($model->sbi_liftinfo){
                    foreach(unserialize($model->sbi_liftinfo) as $k=>$v){
                        $i++;
                        if(empty($v)) continue;
                        $fuck=false;
                        echo $k,'：',$v;
                        echo $_unit[$i];
                        echo ' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">通讯系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_communication){
                    foreach(unserialize($model->sbi_communication) as $k=>$v){
                        echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">空调系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_aircon){
                    foreach(unserialize($model->sbi_aircon) as $k=>$v){
                        echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">安防系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_security){
                    foreach(unserialize($model->sbi_security) as $k=>$v){
                        echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">车位配置</td>
					<td width="84%" class="txt"><?php
                    $fuck=true;
                    $_unit=array('个','个','元/月','元/小时','','','','','');
                    $i=-1;
                    if($model->sbi_carport){
                    foreach(unserialize($model->sbi_carport) as $k=>$v){
                        $i++;
                        if(empty($v)) continue;
                        $fuck=false;
                        echo $k,'：',$v;
                        echo $_unit[$i];
                        echo ' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">楼内配套</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_roommating){
                    foreach(unserialize($model->sbi_roommating) as $k=>$v){
                        echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">物业服务</td>
					<td width="84%" class="txt"><pre><?php
                    if($model->sbi_propertyserver){
                    foreach(unserialize($model->sbi_propertyserver) as $k=>$v){
                        if($k=='卫生'){
                            echo '卫生：'.$v,'　　';
                        } else {
                            echo '<img src="images/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                        }
                    }}else{ echo '暂无资料';}
                    ?></pre></td>
				</tr>
                <tr>
					<td class="title" colspan="2">交通</td>
				</tr>
<?php
if($model->sbi_traffic){
foreach( unserialize($model->sbi_traffic) as $k=>$v ) {
    if(empty($v)) continue;
?>
                <tr>
                    <td width="16%" class="tit"><?php echo CHtml::encode($k); ?>:</td>
                    <td width="84%" class="txt"><?php echo CHtml::encode($v); ?></td>
                </tr>
<?php }
} ?>
                <tr>
                    <td class="title" colspan="2">周边商业配套</td>
                </tr>
<?php
if($model->sbi_peripheral){
foreach( unserialize($model->sbi_peripheral) as $k=>$v ) {
    if(empty($v)) continue;
?>
                <tr>
                    <td width="16%" class="tit"><?php echo CHtml::encode($k); ?>:</td>
                    <td width="84%" class="txt"><?php echo CHtml::encode($v); ?></td>
                </tr>
<?php }
} ?>
            </table>
		</div>
		</div>
	</div>

