<?php
if(count($pkbuilds)==3){
    $Pkcol = 'Pkcol3';
}else{
    $Pkcol = 'Pkcol2';
}
$keywords='';
$sysModels = array();
foreach($pkbuilds as $build) {
    $sysModels[$build->bc_id] = Systembuildinginfo::model()->findByPk($build->bc_sysid);
    //if(empty($sysModels[$build->bc_id])) $sysModels[$build->bc_id] = new Systembuildinginfo();
    $keywords .= CHtml::encode($build->bc_name).' - ';
}
$this->pageTitle = $keywords.'商务中心PK - 新地标';
?>

    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<em>商务中心PK</em></div>
	</div>
	<div class="scmain">
		<div class="PkWrap">
        <div class="PkTitle">商务中心PK</div>
            <div class="PkCont tac">
            <table width="100%">
                <tbody><tr class="">
                    <td width="90" class="Bg1 first BorderB topTitle">商务中心</td>
                    <?php foreach($pkbuilds as $build) {
                        $img = Picture::model()->getPicByTitleInt($build->bc_titlepic,"_large");
                    ?>
                    <td class="BorderB mtop <?php echo $Pkcol ?>" align="center">
                        <div class="pic none_border">
                            <a href="<?php echo $this->createUrl('view',array('id'=>$build->bc_id)) ?>"><img width="240" height="180" alt="<?php echo $build->bc_name ?>" src="<?php echo $img ?>"></a><br>
                            <?php echo CHtml::link($build->bc_name,array('view','id'=>$build->bc_id),
                                            array('title'=>$build->bc_name,'target'=>'_blank')) ?>
                        </div>
                    </td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">区 域</td>
                    <?php foreach($pkbuilds as $build) { ?>
                    <td><?php 
                    $temp = CHtml::encode(Region::model()->getNameById($build->bc_district));
                    echo $temp?$temp:'暂无资料';?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">地 址</td>
                    <?php foreach($pkbuilds as $build) {

                    ?>
                    <td><?php 
                    if($sysModels[$build->bc_id] && $sysModels[$build->bc_id]->sbi_buildingid){
                            echo '[',CHtml::link($sysModels[$build->bc_id]->sbi_buildingname,array('systembuildinginfo/view','id'=>$sysModels[$build->bc_id]->sbi_buildingid)),'] ',$build->bc_floor,'楼';
                    }
                    echo CHtml::encode($build->bc_address); ?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">租 金</td>
                    <?php foreach($pkbuilds as $model) {

                    ?>
                    <td><?php echo $model->bc_rentprice>0?'<em>'.CHtml::encode($model->bc_rentprice).'</em>元/月/工位':'暂无资料'?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">服务商品牌</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->bc_serverbrand?CHtml::encode($model->bc_serverbrand):"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr class="">
                    <td class="Bg2 first">服务语种</td>
                    <?php foreach($pkbuilds as $model) { ?>
                    <td><?php echo $model->bc_serverlanguage?CHtml::encode($model->bc_serverlanguage):"暂无资料"?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">公交线路</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->bc_traffic){
                        $temp = unserialize($model->bc_traffic);
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
                    if($model->bc_traffic){
                        $temp = unserialize($model->bc_traffic);
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
                    if($model->bc_traffic){
                        $temp = unserialize($model->bc_traffic);
                        echo $temp['高架']?$temp['高架']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">临近商街</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php
                    if($model->bc_peripheral){
                        $temp = unserialize($model->bc_peripheral);
                        echo $temp['临近商街']?$temp['临近商街']:'暂无资料';
                    }else{
                        echo '暂无资料';
                    }

                    ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">服务内容</td>
                    <?php
                    $bcServers = array();
                    foreach(Yii::app()->db->createCommand('select * from {{businessserverconfig}}')->queryAll() as $val)
                            $bcServers[$val['bs_id']]=$val['bs_name'];
                    foreach($pkbuilds as $model) {?>
                    <td>
				<p><b>免费服务：</b>
                   <?php if($model->bc_freeserver){
                       foreach(explode(',',$model->bc_freeserver) as $k){
                        if(isset($bcServers[$k]))
                            echo '<span>',$bcServers[$k],'</span>';
                   }}else echo '暂无'; ?>
				</p>
				<p><b>收费服务：</b>
                   <?php if($model->bc_payserver){
                    foreach(explode(',',$model->bc_payserver) as $k){
                        if(isset($bcServers[$k]))
                            echo '<span>',$bcServers[$k],'</span>';
                   }}else echo '暂无'; ?></p></td>
                    <?php } ?>
                </tr>
                <tr>
                    <td class="Bg2 first">项目简述</td>
                    <?php foreach($pkbuilds as $model) {?>
                    <td><?php echo $model->bc_introduce?CHtml::encode($model->bc_introduce):"暂无资料"?></td>
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
                        <td class="mtop <?php echo $Pkcol ?>"><?php echo CHtml::link($build->bc_name,array('view','id'=>$build->bc_id),
                                            array('title'=>$build->bc_name,'target'=>'_blank')) ?></td>
                    <?php } ?>
					</tr>
            	</tbody>
			</table>
        </div>
	</div>
