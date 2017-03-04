<?php
if(count($pkbuilds)==3){
    $Pkcol = 'Pkcol3';
}else{
    $Pkcol = 'Pkcol2';
}
$keywords='';
foreach($pkbuilds as $build) {
    $keywords .= CHtml::encode($build->sbi_buildingname).' - ';
}
$this->pageTitle = $keywords.'楼盘PK - 新地标';
?>

    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<em>楼盘PK</em></div>
	</div>
	<div class="scmain">
		<div class="PkWrap">
        <div class="PkTitle">写字楼PK</div>
            <div class="PkCont tac">
            <table width="100%">
                <tbody><tr class="">
                    <td width="90" class="Bg1 first BorderB topTitle">写字楼外立面</td>
                    <?php foreach($pkbuilds as $build) {
                        $img = Picture::model()->getPicByTitleInt($build->sbi_titlepic,"_normal");
                    ?>
                    <td class="BorderB mtop <?php echo $Pkcol ?>" align="center">
                        <div class="pic none_border">
                            <a href="<?php echo $this->createUrl('systembuildinginfo/view',array('id'=>$build->sbi_buildingid)) ?>"><img width="190" height="250" alt="<?php echo $build->sbi_buildingname ?>" src="<?php echo $img ?>"></a><br>
                            <?php echo CHtml::link($build->sbi_buildingname,array('systembuildinginfo/view','id'=>$build->sbi_buildingid),
                                            array('title'=>$build->sbi_buildingname,'target'=>'_blank')) ?>
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">区 域</td>
                    <?php foreach($pkbuilds as $build) {

                    ?>
                    <td><?php echo CHtml::encode(Region::model()->getNameById($build->sbi_district),' ',Region::model()->getNameById($build->sbi_section))?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">地 址</td>
                    <?php foreach($pkbuilds as $build) {

                    ?>
                    <td><?php echo CHtml::encode($build->sbi_address) ?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">租 金</td>
                    <?php foreach($pkbuilds as $model) {

                    ?>
                    <td><?php echo $model->sbi_avgrentprice>0?'<em>'.CHtml::encode($model->sbi_avgrentprice).'</em>元/平米.天':'暂无资料'?></td>
                    <?php } ?>
                </tr>
				  <tr class="">
                    <td class="Bg2 first">售 价</td>
                    <?php foreach($pkbuilds as $model) {

                    ?>
                    <td><?php echo $model->sbi_avgsellprice>0?'<em>'.CHtml::encode($model->sbi_avgsellprice).'</em>元/平米.天':'暂无资料'?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">物业管理费</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->sbi_propertyprice?'<em>'.CHtml::encode($model->sbi_propertyprice)."</em>元/平米.天":"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">公交线路</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->sbi_traffic){
                        $temp = unserialize($model->sbi_traffic);
                        echo $temp['公交车']?$temp['公交车']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">地铁线路</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->sbi_traffic){
                        $temp = unserialize($model->sbi_traffic);
                        echo $temp['轨道交通']?$temp['轨道交通']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">快速干道</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->sbi_traffic){
                        $temp = unserialize($model->sbi_traffic);
                        echo $temp['高架']?$temp['高架']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">开发商</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->sbi_developer?CHtml::encode($model->sbi_developer):"暂无资料";?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">物业管理公司</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->sbi_propertyname?CHtml::encode($model->sbi_propertyname):"暂无资料";?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">总层数</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->sbi_floor?CHtml::encode($model->sbi_floor):"暂无资料";?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">单层面积</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->sbi_floorarea?CHtml::encode($model->sbi_floorarea).'平米':"暂无资料";?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">净层高</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->sbi_floorinfo){
                        $temp = unserialize($model->sbi_floorinfo);
                        echo $temp['层高']?$temp['层高']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">得房率</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->sbi_defanglv?CHtml::encode($model->sbi_defanglv).'%':"暂无资料";?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">交屋标准</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                        $fuck=true;
                        if($model->sbi_biaozhun){
                        foreach(unserialize($model->sbi_biaozhun) as $k=>$v){
                            if(empty($v)) continue;
                            $fuck=false;
                            echo $k,'：',$v,' 　　';
                        }
                        }
                        if($fuck) echo '暂无资料'; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">电梯数量</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                        $fuck=true;
                        if($model->sbi_liftinfo){
                        foreach(unserialize($model->sbi_liftinfo) as $k=>$v){
                            if(empty($v) || $k!='客梯' || $k!='货梯') continue;
                            $fuck=false;
                            echo $k,'：',$v,'部';
                            echo ' ';
                        }
                        }
                        if($fuck) echo '暂无资料'; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">车位数量</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                        $fuck=true;
                        if($model->sbi_carport){
                        foreach(unserialize($model->sbi_carport) as $k=>$v){
                            if(empty($v) || $k!='地上' || $k!='地下') continue;
                            $fuck=false;
                            echo $k,'：',$v,'部';
                            echo ' ';
                        }
                        }
                        if($fuck) echo '暂无资料'; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">楼内配套</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php
                    $fuck = true;
                    if($model->sbi_roommating){
                    foreach(unserialize($model->sbi_roommating) as $k=>$v){
                        if($v){
                            $fuck=false;
                            echo $k,' ';
                        }
                    }
                    }
                    if($fuck) echo '暂无资料'; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">临近商街</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->sbi_peripheral){
                        $temp = unserialize($model->sbi_peripheral);
                        echo $temp['临近商街']?$temp['临近商街']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
            </tbody></table>
            </div>
       </div>
	   <div class="BottomNav tac no_print">
            <table width="100%" class="table_04">
                <tbody>
					<tr>
						<td width="110" class="first"><span><a onclick="window.print();" class="print" href="javascript:void(0)">打印</a></span></td>
                        <?php foreach($pkbuilds as $build) { ?>
                        <td class="mtop <?php echo $Pkcol ?>"><?php echo CHtml::link($build->sbi_buildingname,array('systembuildinginfo/view','id'=>$build->sbi_buildingid),
                                            array('title'=>$build->sbi_buildingname,'target'=>'_blank')) ?></td>
                    <?php } ?>
					</tr>
            	</tbody>
			</table>
        </div>
	</div>
