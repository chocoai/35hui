<?php

$model = $data->data;
$_region = getRegions();
?>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->cp_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->cp_englishname) ?></div>
		</div>
	</div>
	<div class="dlcont">
		<div class="dlleft">
			<div class="dllcont">
				<p>园区地址：<?php echo CHtml::encode($model->cp_address)?>
                </p>
				<p><span class="dll_01">租金报价：<?php echo $model->cp_avgrentprice>0?'<em>'.CHtml::encode($model->cp_avgrentprice).'</em>元/平米.天':'暂无资料'?></span>
                    </p>
				<p><span class="dll_01">物业费用：<?php echo $model->cp_propertyprice?'<em>'.CHtml::encode($model->cp_propertyprice)."</em>元/平米.天":"暂无资料"?></span>
                    <span class="dll_01">物业管理：<?php echo $model->cp_propertyname?$model->cp_propertyname:"暂无资料"?></span></p>
			</div>
			<div class="dllcont">
				<p><span class="dll_01">改建年代：<?php echo $model->cp_openingtime?date('Y年m月',$model->cp_openingtime):"暂无资料";?></span>
                    <span class="dll_01">得 房 率：<?=$model->cp_defanglv>0?$model->cp_defanglv."%":"暂无资料"?></span></p>
				<p><span class="dll_01">分割面积：<?php echo $model->cp_fengearea?CHtml::encode($model->cp_fengearea):"暂无资料";?> 平米</span>
                    <span class="dll_01">楼层层高：<?php echo ($model->cp_floorheight?CHtml::encode($model->cp_floorheight):''),' ',($model->cp_form?CHtml::encode($model->cp_form):'') ?></span>
                </p>
			</div>
		</div>
		<div class="dlright">
            <div class="dlqj" style="width:500px;height: 317px;">
               <script type="text/javascript" src="<?php echo API_DIBIAO.'api/search/panorama?id='.$model->cp_id.'&type=6&size=500x317';?>"></script>
            </div>
            <div class="dltxt">
                <?php echo CHtml::encode($model->cp_introduce); ?>
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
			<div class="left_map">
                <div class="left_map" id="mapabc_box"  style="width: 720px;height: 268px">
                </div>
                <script type="text/javascript">_MAPxy = {name:"<?php echo $model->cp_name ?>",x:"<?php echo $model->cp_x?$model->cp_x:'121.47536873817444' ?>",y:"<?php echo $model->cp_y?$model->cp_y:'31.232857675162947' ?>"};</script>
            </div>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">详细参数</a></li>
				</ul>
			</div>
            <div class="dllcont">
                <table border="0" cellpadding="0" cellspacing="0" class="table_03">
                        <tr>
                            <td width="16%" class="tit">开发商</td>
                            <td width="84%" class="txt"><?php echo $model->cp_developer?CHtml::encode($model->cp_developer):'暂无资料' ?></td>
                        </tr>
                        <tr>
                            <td width="16%" class="tit">总建筑面积</td>
                            <td width="84%" class="txt"><?php echo $model->cp_area?CHtml::encode($model->cp_area).'平米':'暂无资料' ?></td>
                        </tr>
                        <tr>
                            <td width="16%" class="tit">办公区域高</td>
                            <td width="84%" class="txt"><?php echo $model->cp_floorheight?CHtml::encode($model->cp_floorheight).' 米':'暂无资料' ?></td>
                        </tr>
                        <tr>
                            <td width="16%" class="tit">车位配置</td>
                            <td width="84%" class="txt">
                                <?php
                                $_str = '';
                                if($model->cp_carport){
                                    $temp = unserialize($model->cp_carport);
                                    if(!empty($temp['dishang']))
                                        $_str .= "地上：{$temp['dishang']}个 月租金：{$temp['dishangyue']}元/月/车位 时租金：{$temp['dishangshi']}元/车位<br/>";
                                    if(!empty($temp['dixia']))
                                        $_str .= "地上：{$temp['dixia']}个 月租金：{$temp['dixiayue']}元/月/车位 时租金：{$temp['dixiashi']}元/车位<br/>";
                                }
                                echo $_str?$_str:'暂无资料';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="16%" class="tit">物业服务</td>
                            <td width="84%" class="txt">
                                <?php
                                $_str = '';
                                $data->cp_propertyserver = array($data->cp_propertyserver);
                                if($model->cp_propertyserver){
                                    foreach(explode(',',$model->cp_propertyserver) as $k)
                                            $_str .= @ $data->cp_propertyserver[$k].' ';
                                }
                                echo $_str?$_str:'暂无资料';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="16%" class="tit">园区配套</td>
                            <td width="84%" class="txt">
                                <?php
                                $_str = '';
                                $data->cp_roommating = array($data->cp_roommating);
                                if($model->cp_roommating){
                                    foreach(explode(',',$model->cp_roommating) as $k)
                                            $_str .= @ $data->cp_roommating[$k].' ';
                                }
                                echo $_str?$_str:'暂无资料';
                                ?>
                            </td>
                        </tr>
                    </table>
		</div>
		</div>
	</div>
