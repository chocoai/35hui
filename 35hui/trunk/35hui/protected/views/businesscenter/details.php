    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->bc_name,array('view','id'=>$model->bc_id)) ?>&gt;<em>商务中心详细</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->bc_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->bc_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->bc_englishname) ?></div>
		</div>
	</div>
    <?php $this->renderPartial('_nav',array('model'=>$model)); ?>

<?php
$model = $sysModel;
?>
	<div class="detcont">
        <div class="dllcont">
			<table border="0" cellpadding="0" cellspacing="0" class="table_03">
				<tr>
					<td class="title" colspan="2">所在大楼参数</td>
				</tr>
                <tr>
					<td width="16%" class="tit">写字楼名称</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_buildingname); ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">写字楼地址</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_address); ?></td>
				</tr>
				<tr>
					<td width="16%" class="tit">写字楼等级</td>
					<td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_propertydegree?Systembuildinginfo::model()->propertyIntToDescribe($model->sbi_propertydegree):"暂无资料")?></td>
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
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
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
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">空调系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_aircon){
                    foreach(unserialize($model->sbi_aircon) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                    }}else{ echo '暂无资料';}
                    ?></td>
				</tr>
                <tr>
					<td width="16%" class="tit">安防系统</td>
					<td width="84%" class="txt"><?php
                    if($model->sbi_security){
                    foreach(unserialize($model->sbi_security) as $k=>$v){
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
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
                        echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
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
                            echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                        }
                    }}else{ echo '暂无资料';}
                    ?></pre></td>
				</tr>
		  </table>
		</div>
	</div>
<br />
