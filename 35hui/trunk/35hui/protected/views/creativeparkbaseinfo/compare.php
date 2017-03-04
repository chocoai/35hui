<?php
if(count($pkbuilds)==3){
    $Pkcol = 'Pkcol3';
}else{
    $Pkcol = 'Pkcol2';
}
$keywords='';
foreach($pkbuilds as $build) {
    $keywords .= CHtml::encode($build->cp_name).' - ';
}
$this->pageTitle = $keywords.'创意园区PK - 新地标';
?>

    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<em>创意园区比较</em></div>
	</div>
	<div class="scmain">
		<div class="PkWrap">
        <div class="PkTitle">创意园区比较</div>
            <div class="PkCont tac">
            <table width="100%">
                <tbody><tr class="">
                    <td width="90" class="Bg1 first BorderB topTitle">创意园区外立面</td>
                    <?php foreach($pkbuilds as $build) {
                        $img = Picture::model()->getPicByTitleInt($build->cp_titlepic,"_large");
                    ?>
                    <td class="BorderB mtop <?php echo $Pkcol ?>" align="center">
                        <div class="pic none_border">
                            <a href="<?php echo $this->createUrl('view',array('id'=>$build->cp_id)) ?>"><img width="240" height="180" alt="<?php echo $build->cp_name ?>" src="<?php echo $img ?>"></a><br>
                            <?php echo CHtml::link($build->cp_name,array('view','id'=>$build->cp_id),
                                            array('title'=>$build->cp_name,'target'=>'_blank')) ?>
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">区 域</td>
                    <?php foreach($pkbuilds as $build) { ?>
                    <td><?php echo CHtml::encode(Region::model()->getNameById($build->cp_district))?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">地 址</td>
                    <?php foreach($pkbuilds as $build) {

                    ?>
                    <td><?php echo CHtml::encode($build->cp_address) ?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">租 金</td>
                    <?php foreach($pkbuilds as $model) {

                    ?>
                    <td><?php echo $model->cp_avgrentprice>0?'<em>'.CHtml::encode($model->cp_avgrentprice).'</em>元/平米.天':'暂无资料'?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">物业管理费</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->cp_propertyprice?'<em>'.CHtml::encode($model->cp_propertyprice)."</em>元/平米.天":"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">得房率</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->cp_defanglv?CHtml::encode($model->cp_defanglv).'%':"暂无资料";?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">园区形态</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->cp_form?CHtml::encode($model->cp_form):"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">改建年代</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->cp_openingtime?date('Y年m月',$model->cp_openingtime):"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">总建筑面积</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->cp_area?'<em>'.CHtml::encode($model->cp_area).'</em>平米':"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">办公区域高</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->cp_floorheight?'<em>'.CHtml::encode($model->cp_floorheight).'</em>米':"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">车位数量</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    $_str = '';
                    if($model->cp_carport){
                        $temp = unserialize($model->cp_carport);
                        if(!empty($temp['dishang']))
                            $_str .= "地上：{$temp['dishang']}个 月租金：{$temp['dishangyue']}元/月/车位 时租金：{$temp['dishangshi']}元/车位<br/>";
                        if(!empty($temp['dixia']))
                            $_str .= "地上：{$temp['dixia']}个 月租金：{$temp['dixiayue']}元/月/车位 时租金：{$temp['dixiashi']}元/车位<br/>";
                    }
                    echo $_str?$_str:'暂无资料';

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">园区配套</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    $_str = '';
                    if($model->cp_roommating){
                        foreach(explode(',',$model->cp_roommating) as $k)
                                $_str .= @ Creativeparkbaseinfo::$cp_roommating[$k].' ';
                    }
                    echo $_str?$_str:'暂无资料';

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">公交线路</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->cp_traffic){
                        $temp = unserialize($model->cp_traffic);
                        echo !empty($temp['gongjiao'])?$temp['gongjiao']:'暂无资料';
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
                    if($model->cp_traffic){
                        $temp = unserialize($model->cp_traffic);
                        echo !empty($temp['guidao'])?$temp['guidao']:'暂无资料';
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
                    if($model->cp_traffic){
                        $temp = unserialize($model->cp_traffic);
                        echo !empty($temp['gaojia'])?$temp['gaojia']:'暂无资料';
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
                        <td class="mtop <?php echo $Pkcol ?>"><?php echo CHtml::link($build->cp_name,array('view','id'=>$build->cp_id),
                                            array('title'=>$build->cp_name,'target'=>'_blank')) ?></td>
                    <?php } ?>
					</tr>
            	</tbody>
			</table>
        </div>
	</div>
