<?php
$sbi_city = Region::model()->getNameById($model->sbi_city);
$sbi_district = Region::model()->getNameById($model->sbi_district);
$sbi_section = Region::model()->getNameById($model->sbi_section);
$sbi_buildingname = $model->sbi_buildingname;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'写字楼,'.$sbi_buildingname.'写字楼租赁,360°全景看房';
$description='找'.$sbi_city.'出售房源和租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
?>


    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->sbi_buildingname,array('systembuildinginfo/view','id'=>$model->sbi_buildingid)) ?>&gt;<em>楼盘详细</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"details","type"=>$type)); ?>
	<div class="detcont">
        <div class="dllcont">
			<table border="0" cellpadding="0" cellspacing="0" class="table_03">
				<tr>
					<td class="title" colspan="2">产品参数</td>
				</tr><?if($model->sbi_address){?>
				<tr>
					<td width="16%" class="tit">地址</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_address); ?></td>
				</tr><?}if($model->sbi_propertydegree){?>
				<tr>
					<td width="16%" class="tit">写字楼等级</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_propertydegree?Systembuildinginfo::model()->propertyIntToDescribe($model->sbi_propertydegree):"暂无资料")?></td>
				</tr><?}if($model->sbi_openingtime){?>
				<tr>
					<td width="16%" class="tit">竣工年月</td>
					<td width="84%" class="txt"><?php echo $model->sbi_openingtime?date('Y年',$model->sbi_openingtime):"暂无资料"?></td>
				</tr><?}if($model->sbi_buildingarea){?>
				<tr>
					<td width="16%" class="tit">楼宇总建筑面积</td>
					<td width="84%" class="txt"><?php echo $model->sbi_buildingarea?$model->sbi_buildingarea.'平米':"暂无资料"?></td>
				</tr><?}if($model->sbi_dongnum){?>
				<tr>
					<td width="16%" class="tit">楼宇总楼数</td>
					<td width="84%" class="txt"><?php echo $model->sbi_dongnum;?>栋</td>
				</tr><?}if($model->sbi_floor){?>
				<tr>
					<td width="16%" class="tit">楼宇总层数</td>
					<td width="84%" class="txt"><?php echo $model->sbi_floor?$model->sbi_floor.'层':"暂无资料"?></td>
				</tr><?}?>
				<tr>
					<td class="title" colspan="2">相关企业</td>
				</tr><?if($model->sbi_developer){?>
				<tr>
					<td width="16%" class="tit">开发商</td>
					<td width="84%" class="txt"><?php echo $model->sbi_developer?CHtml::encode($model->sbi_developer):"暂无资料";?></td>
				</tr><?}if($model->sbi_propertyname){?>
				<tr>
					<td width="16%" class="tit">物业管理公司</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_propertyname?$model->sbi_propertyname:'暂无资料')?></td>
				</tr>
				<tr>
					<td class="title" colspan="2">硬件参数</td>
				</tr><?}if($model->sbi_wailimian){?>
				<tr>
					<td width="16%" class="tit">外立面</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_wailimian?$model->sbi_wailimian:'暂无资料'); ?></td>
				</tr><?}if($model->sbi_datang){?>
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
				</tr><?}if($model->sbi_zoulang){?>
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
				</tr><?}if($model->sbi_floorinfo){?>
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
                            echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k;
                        }else{
                            echo $k,'：',$v;
                            echo $_unit[$i];
                        }
                        echo ' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
				</tr><?}if($model->sbi_danyuanfenge){?>
				<tr>
					<td width="16%" class="tit">单元分割面积    </td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_danyuanfenge?$model->sbi_danyuanfenge.'平米':'暂无资料'); ?></td>
				</tr><?}if($model->sbi_biaozhun){?>
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
				</tr><?}if($model->sbi_toiletwater){?>
				<tr>
					<td width="16%" class="tit">卫生间供水</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_toiletwater){
                    foreach(unserialize($model->sbi_toiletwater) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr><?}if($model->sbi_liftinfo){?>
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
				</tr><?}if($model->sbi_communication){?>
                <tr>
					<td width="16%" class="tit">通讯系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_communication){
                    foreach(unserialize($model->sbi_communication) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr><?}if($model->sbi_aircon){?>
                <tr>
					<td width="16%" class="tit">空调系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_aircon){
                    foreach(unserialize($model->sbi_aircon) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr><?}if($model->sbi_security){?>
                <tr>
					<td width="16%" class="tit">安防系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_security){
                    foreach(unserialize($model->sbi_security) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr><?}if($model->sbi_carport){?>
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
				</tr><?}if($model->sbi_roommating){?>
                <tr>
					<td width="16%" class="tit">楼内配套</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_roommating){
                    foreach(unserialize($model->sbi_roommating) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr><?}if($model->sbi_propertyserver){?>
                <tr>
					<td width="16%" class="tit">物业服务</td>
					<td width="84%" class="txt"><pre><?php
                    if($model->sbi_propertyserver){
                    foreach(unserialize($model->sbi_propertyserver) as $k=>$v){
                        if($k=='卫生'){
                            echo '卫生：'.$v,'　　';
                        } else {
                            echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                        }
                    }}else{ echo '暂无资料';}
                    ?></pre></td>
				</tr><?}?>
		  </table>
		</div>
	</div>
<br />
