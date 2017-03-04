	<div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<a href="">楼盘详细</a></div>
		<div class="rtspace">浏览次数：<?php echo $model->bc_visit ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo $model->bc_name ?></div>
			<div class="egtit"><?php echo $model->bc_englishname ?></div>
		</div>
		<div class="rtlou">
            <ul>
                <li class="iconlist share"><a  class="jiathis jiathis_txt" href="http://www.jiathis.com/share" target="_blank">分享</a></li>
                <li class="iconlist dayin"><a href="javascript:;" onclick="window.print()">打印</a></li>
            </ul>
        </div>
	</div>
	<div class="swucont">
		<div class="swleft">
			<p>租金报价：<em><?php echo $model->bc_rentprice ?></em>元/月/工位</p>
			<p>物业地址：[ <?=Region::model()->getNameById($model->bc_district)?> ]&nbsp;&nbsp;&nbsp;<?php  echo $model->bc_address,' '; echo CHtml::link($sysModel->sbi_buildingname,array('systembuildinginfo/view','id'=>$sysModel->sbi_buildingid)); echo $model->bc_floor?(' '.$model->bc_floor.' 楼'):''; ?>
            <?php if($model->bc_sysid){ echo CHtml::link('查看地图',array('/map/map','id'=>'1-'.$model->bc_sysid));} ?>
            </p>
			<p><span class="dll_02">服务品牌：<?php echo $model->bc_serverbrand?CHtml::encode($model->bc_serverbrand):'暂无资料' ?></span>
                <span class="dll_02">服务语种：<?php echo $model->bc_serverlanguage?CHtml::encode($model->bc_serverlanguage):'暂无资料' ?></span></p>
            <p><span class="dll_02">装修风格：<?php echo  $model->bc_decoratestyle?CHtml::encode($model->bc_decoratestyle):'暂无资料' ?></span>
                <span class="dll_02">竣工日期：<?php echo $model->bc_completetime?date('Y年', $model->bc_completetime):'暂无资料' ?></span></p>
			<div class="swkf">
				<div class="swkf_l">
                    <span style="color:#22468B; font-size:24px; font-weight:bold;">400-820-9181</span><br />
                    <span style="color:#999; font-size:12px;">周一至周五 8:00 - 20:00 </span>
                </div>
			</div>
			<div class="swdet"><?php echo CHtml::encode($model->bc_introduce) ?></div>
		</div>
		<div class="swright" style="width:500px;height: 317px;">
            <?php
                if(Panoxml::model()->checkHavePano($model->bc_sysid, 6)) {
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->bc_sysid, 6),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=3 AND p_sourceid='.$model->bc_id))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('businesscenter/piclist',array('id'=>$model->bc_id)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                } ?>
        </div>
	</div>
<?php $this->renderPartial('_nav',array('model'=>$model));
$bcServers = array();
foreach(Yii::app()->db->createCommand('select * from {{businessserverconfig}}')->queryAll() as $val)
        $bcServers[$val['bs_id']]=$val['bs_name'];
?>
	
	<div class="dlmain">
		<div class="dlleft">
            <div class="detcont">
		<div class="dllcont">
			<div class="swdetail">
                <h6>免费服务</h6>
				<p><?php if($model->bc_freeserver){
                    foreach(explode(',',$model->bc_freeserver) as $k){
                        if(isset($bcServers[$k]))
                            echo '<span class="sdt_01">',$bcServers[$k],'</span>';
                   }}else{ echo '暂无资料'; } ?>
				</p>
				<h6>收费服务</h6>
				<p><?php if($model->bc_payserver){
                    foreach(explode(',',$model->bc_payserver) as $k){
                        if(isset($bcServers[$k]))
                            echo '<span class="sdt_01">',$bcServers[$k],'</span>';
                   }}else{ echo '暂无资料'; } ?></p>
			</div>
		</div>
	</div>
<?php
$albums = Picture::model()->findAll(array('limit'=>8,'condition'=>'p_sourcetype=3 AND p_sourceid='.$model->bc_id));
if($albums){
?>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">相 册</a></li>
				</ul>

			</div>
			<div class="lpline">
                <?php
                foreach($albums as $pic){// /images/1.jpg
                    $src = PIC_URL.Picture::showStandPic($pic->p_img,"_large");
                    $typeDsc = isset(Picture::$typeDescription[$pic->p_type])?Picture::$typeDescription[$pic->p_type]:'';
                ?>
                <div class="sjmod">
                    <a href="<?php echo $this->createUrl('view',array('id'=>$model->bc_id,'tag'=>'album')) ?>" title="<?php echo $typeDsc ?>" target="_blank">
					<?php echo CHtml::image($src,CHtml::encode($model->bc_name)) ?>
                    </a>
					<p><?php echo CHtml::encode($pic->p_title) ?></p>
				</div>
                <?php } ?>
			</div>
<?php } ?>
			<div class="dlmtit" >
				<ul>
					<li class="clk"><a href="">地理位置</a></li>
				</ul>
			</div>
			<div class="left_map">
                    <?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$sysModel->sbi_x ? $sysModel->sbi_x:'121.47536873817444',
                        'y'=>$sysModel->sbi_y ? $sysModel->sbi_y:'31.232857675162947',
                        'name'=>$model->bc_name,
                        "searchAddress"=>$model->bc_sysid?"":$model->bc_address,
                        'width'=>"720px",
                        'height'=>"268px",
                        'type'=>"all",
                ));
                ?>
			</div>
<?php
if($model->bc_traffic){
?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">交通状况</a></li>
				</ul>
			</div>
			<div class="left_traffic">
<?php
$cssClass = array('ico_metro','ico_elevated','ico_airport','ico_bus','ico_railway');
$i = -1;
    foreach(unserialize($model->bc_traffic) as $k=>$v){
        ++$i;
?>
                <dl>
					<dt class="sidebg <?php echo $cssClass[$i] ?>"><?php echo CHtml::encode($k); ?></dt>
                    <dd><?php echo $v?CHtml::encode($v):'暂无资料'; ?></dd>
				</dl>
<?php } ?>
			</div><?php }
 if($model->getLikeBC()){ ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">关注<?php echo CHtml::encode($model->bc_name); ?>也关注了</a></li>
				</ul>
			</div>
			<div class="gzlou">
<?php foreach($model->getLikeBC() as $val){ ?>
				<div class="gzmodel">
                    <a href="<?php echo $this->createUrl('businesscenter/view',array('id'=>$val['bc_id'])) ?>">
                        <img src="<?=Picture::model()->getPicByTitleInt($val['bc_titlepic'],"_large");?>" style=" height: 88px;">
                    </a>
                    <p><?php echo CHtml::link(common::strCut($val['bc_name'], 30),array('businesscenter/view','id'=>$val['bc_id']),array('title'=>$val['bc_name'])) ?>
                        <br /><em><?php echo $val['bc_rentprice'] ?> 元/月/工位</em></p>
                    <p><?php echo CHtml::encode($val['bc_address']) ?></p>
                </div>
<?php } ?>
            </div>
<?php } ?>
		</div>
		<div class="dlright" style=" padding-top: 10px;">
			<div class="pkcont">
				<h2>商务中心比较</h2>
				<div class="addpk">
<?php
array_pop($viewedBuilds);
?>
					<table cellspacing="0" cellpadding="0" border="0" class="table_02">
						<tbody>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($model->bc_name, 21),array('view','id'=>$model->bc_id),
                                            array('title'=>$model->bc_name,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $model->bc_rentprice ?></em>元/月/工位</td>
                                <td width="26%" align="right"><a href="javascript:;" onclick="delPkItem(this)">删除</a></td>
							</tr>
                            <tr style="display: none">
								<td colspan="3">
                                    <?php $this->widget('CAutoComplete',
                                            array(
                                            'name'=>'buidname',
                                            'url'=>array('/site/ajaxautocomplete'),
                                            'max'=>10,//显示最大数
                                            'minChars'=>1,//最小输入多少开始匹配
                                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                                            'mustMatch'=>1,
                                            'scrollHeight'=>200,
                                            "extraParams"=>array('type'=>'4'),
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild1','pkid'=>$model->bc_id),
                                            "methodChain"=>".result(function(event,item){setBuid('pkbuild1',item)})",
                                    ));?>
                                </td>
							</tr>
							<tr>
								<td colspan="3" align="center"><img src="/images/vs.jpg" /></td>
							</tr>
<?php
$pkid = array_pop($viewedBuilds);
$pkbuild = '';
if($pkid){
    $pkbuild = Businesscenter::model()->findByPk($pkid);
}
if($pkbuild){
?>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($pkbuild->bc_name, 21),array('view','id'=>$pkbuild->bc_id),
                                            array('title'=>$pkbuild->bc_name,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $pkbuild->bc_rentprice ?></em>元/平米.天</td>
                                <td width="26%" align="right"><a href="javascript:;" onclick="delPkItem(this)">删除</a></td>
							</tr>
<?php } ?>
							<tr<?php echo $pkbuild?'  style="display: none"':'' ?>>
								<td colspan="3">
                                    <?php $this->widget('CAutoComplete',
                                            array(
                                            'name'=>'buidname',
                                            'url'=>array('/site/ajaxautocomplete'),
                                            'max'=>10,//显示最大数
                                            'minChars'=>1,//最小输入多少开始匹配
                                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                                            'mustMatch'=>1,
                                            'scrollHeight'=>200,
                                            "extraParams"=>array('type'=>'4'),
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild2','pkid'=>$pkbuild?$pkbuild->bc_id:''),
                                            "methodChain"=>".result(function(event,item){setBuid('pkbuild2',item)})",
                                    ));?>
                                </td>
							</tr>
							<tr>
								<td colspan="3" align="center"><img src="/images/vs.jpg" /></td>
							</tr>
<?php
$pkid = array_pop($viewedBuilds);
$pkbuild = '';
if($pkid){
    $pkbuild = Businesscenter::model()->findByPk($pkid);
}
if($pkbuild){
?>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($pkbuild->bc_name, 21),array('view','id'=>$pkbuild->bc_id),
                                            array('title'=>$pkbuild->bc_name,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $pkbuild->bc_rentprice ?></em>元/平米.天</td>
                                <td width="26%" align="right"><a href="javascript:;" onclick="delPkItem(this)">删除</a></td>
							</tr>
<?php } ?>
							<tr<?php echo $pkbuild?'  style="display: none"':'' ?>>
								<td colspan="3">
                                    <?php $this->widget('CAutoComplete',
                                            array(
                                            'name'=>'buidname',
                                            'url'=>array('/site/ajaxautocomplete'),
                                            'max'=>10,//显示最大数
                                            'minChars'=>1,//最小输入多少开始匹配
                                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                                            'mustMatch'=>1,
                                            'scrollHeight'=>200,
                                            "extraParams"=>array('type'=>'4'),
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild3','pkid'=>$pkbuild?$pkbuild->bc_id:''),
                                            "methodChain"=>".result(function(event,item){setBuid('pkbuild3',item)})",
                                    ));?>
                                </td>
							</tr>
						</tbody>
		 			 </table>
				</div>
                <div class="addpkbtn"><a href="#" onclick="return gotoPkNow();"><img src="/images/btnpk.jpg"></a></div>
			</div>
		</div>
	</div>

<script type="text/javascript" >
    function setBuid(id,Data){
        $("#"+id).attr('pkid',Data[1]);
    }
    function delPkItem(Obj){
        $(Obj).parent().parent().hide().next().show().find(':input').attr('pkid','');
    }
    function gotoPkNow(){
        var pkids = [];
        var id=0,error='';
        for(var i=1;i<4;i++){
            id = $("#pkbuild"+i).attr('pkid');
            if(id) pkids.push(id);
        }
        var len = pkids.length;
        if(len<2){
            alert("至少要两个楼盘才能比较比较");return false;
        }
        var pkurl = "<?php echo $this->createUrl('compare') ?>";
        location.href=pkurl+'?pk='+pkids.join("|");
        return false;
    }

    
var jiathis_config={
	hideMore:false
}
</script>
<script type="text/javascript" src="http://v2.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
