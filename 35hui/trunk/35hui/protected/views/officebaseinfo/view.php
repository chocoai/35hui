<?php
$ob_city = Region::model()->getNameById($sysModel->sbi_city);
$ob_ditrict=Region::model()->getNameById($sysModel->sbi_district);
$ob_officename=$sysModel->sbi_buildingname;
$ob_officearea=$model->ob_officearea;
if($model->ob_sellorrent == '1'){
    $or_rentprice=$model->ob_rentprice.'元';
    $keywords=$ob_city.$ob_officename.'写字楼出租,面积'.$ob_officearea.'平方米,'.$or_rentprice;
    $description=$ob_city.$ob_ditrict.','.$ob_officename.'租房,日租金：'.$or_rentprice.',面积'.$ob_officearea.'平方米,';
    $this->pageTitle = $ob_officename.'出租,'.$ob_city.$ob_officename.'360°全景看房,'.$ob_officename.'租金'.$or_rentprice.'-新地标';
}else{
    $rs_price=$model->ob_sumprice.'元';
    $keywords=$ob_city.$ob_officename.'出售，售价'.$rs_price.'万，面积'.$ob_officearea.'平米';
    $description=$ob_city.$ob_ditrict.'售价'.$rs_price.'万，面积'.$ob_officearea.'平米，';
    $this->pageTitle = $ob_officename.'出售,'.$ob_city.$ob_officename.'360°全景看房,'.$ob_officename.'售价'.$rs_price.'万'.'-新地标';
}

$description.='经纪人:'.$agentModel->ua_realname.',咨询电话:'.$agentModel->userInfo['user_tel'].'。';

Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');

//fancybox-1.3.4
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.mousewheel-3.0.4.pack.js');
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerCssFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.css');
?>
	<div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($sysModel->sbi_buildingname,array('systembuildinginfo/view','id'=>$sysModel->sbi_buildingid)) ?>&gt;<em>房源详细</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->ob_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($sysModel->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($sysModel->sbi_buildingenglishname) ?></div>
		</div>
    </div>
	<div class="swucont">
		<div class="fdleft">
			<div class="fd_head" style=" background: url(../images/botline.jpg) repeat-x scroll center bottom transparent;">
				<div class="fd_pic">
                    <a href="<?php echo $this->createUrl('uagent/index',array('id'=>$agentModel->ua_id)); ?>">
                    <?php echo CHtml::image(User::model()->getUserHeadPic($agentModel->ua_uid, "_large"),$agentModel->ua_realname);?>
                    </a>
                </div>
				<div class="fd_txt">
					<h6><?php
                    echo CHtml::link($agentModel->ua_realname,array('uagent/index','id'=>$agentModel->ua_id)),' ';
                    echo User::model()->getUserLevelByUserId($agentModel->ua_uid),' ';
                    if($agentModel->ua_combo) echo Uagent::model()->getAgentComboIconUrl($agentModel);
                    ?></h6>
					<p><?php
                //身份认证
                if(Uagent::model()->getIdentityCertification($agentModel->ua_uid)){
                    echo CHtml::image(IMAGE_URL."/icon/sf.gif","已通过身份证实名验证",array("title"=>"已通过身份证实名验证"));
                }else {
                    echo CHtml::image(IMAGE_URL."/icon/sf_gray.gif","未认证",array("title"=>"身份未认证"));
                }
                //名片认证
                if(Uagent::model()->getSeniorityCertification($agentModel->ua_uid)){
                    echo CHtml::image(IMAGE_URL."/icon/zy.gif","已提交经纪人证书",array("title"=>"已提交经纪人证书"));
                }else{
                    echo CHtml::image(IMAGE_URL."/icon/zy_gray.gif","未认证",array("title"=>"名片未认证"));
                }
                ?></p>
					<p><?php echo CHtml::encode($agentModel->ua_company); ?></p>
					<p><em><?php echo CHtml::encode($agentModel->userInfo->user_tel); ?></em></p>
				</div>
			</div>
			<div class="fd_descmain">
                <p>
					<span class="fd_01">
                        <?php if($model->ob_sellorrent == '1'){
                            echo '租金：<em>',$model->ob_rentprice,'</em>元/平米·天';
                        }else{
                            echo '单价：<em>',$model->ob_avgprice,'</em>元/平米';
                        }?>
                    </span>
                    <span class="fd_01">面积：<em><?php echo CHtml::encode($model->ob_officearea); ?></em>平方米</span>
				</p>
				<p style=" background: url(../images/botline.jpg) repeat-x scroll center bottom transparent;">
					<span class="fd_02">
                    <?php if($model->ob_sellorrent == '1'){
                            echo '月租：<em>',$model->ob_monthrentprice,'</em>元';
                        }else{
                            echo '总价：<em>',$model->ob_sumprice,'</em>万元';
                        }?>
                    </span>
				</p>
				<p>
					<span class="fd_02">物业：<?php echo CHtml::encode($sysModel->sbi_propertyname?$sysModel->sbi_propertyname:'暂无资料')?></span>
				</p>
				<p>
                    <span class="fd_01">装修：<?php echo @Officebaseinfo::$adrondegree[$model->ob_adrondegree] ?></span>
					<span class="fd_01">楼层：<?php echo @Officebaseinfo::$ob_floortype[$model->ob_floortype] ?></span>
				</p>
				<p>
					<span class="fd_01">得房率：<?php echo $sysModel->sbi_defanglv?CHtml::encode($sysModel->sbi_defanglv).'%':"暂无资料";?></span>
					<span class="fd_01">发布时间：<?php echo date("Y-m-d",$model->ob_releasedate)?>(<?php echo common::dealShowTime($model->ob_updatedate)?>更新)</span>
				</p>
			</div>
		</div>
		<div class="swright" style="width:500px;height: 317px;">
            <?php
                if(Panoxml::model()->checkHavePano($model->ob_officeid, 3)){
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->ob_officeid, 3),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=1 AND p_sourceid='.$model->ob_sysid))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('systembuildinginfo/piclist',array('id'=>$model->ob_sysid)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                }?>
        </div>
	</div>
	<div class="dlmain">
		<div class="dlleft">
		<?php  if($model->ob_introduce){?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">房源介绍</a></li>
				</ul>
			</div>
			<div class="lpline">
			<span><?=$model->ob_introduce?></span>
			</div>
		<?php } ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">楼盘概况</a></li>
				</ul>
                <div class="dlmore"><a href="<?=$this->createUrl('systembuildinginfo/view',array('id'=>$sysModel->sbi_buildingid,"tag"=>"details",)); ?>">更多&gt;&gt;</a></div>
			</div>
			<div class="lpline">
				<table cellpadding="0" cellspacing="0" border="0" class="table_03">
					<tr>
                        <td width="15%" class="tit">开发企业：</td><td width="85%"><?php echo $sysModel->sbi_developer?CHtml::encode($sysModel->sbi_developer):"暂无资料";?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tit">交房标准：</td>
                       <td>
                   <?php
                    $fuck=true;
                    if($sysModel->sbi_biaozhun){
                    foreach(unserialize($sysModel->sbi_biaozhun) as $k=>$v){
                        if(empty($v)) continue;
                        $fuck=false;
                        echo $k,'：',$v,' 　　';
                    }
                    }
                    if($fuck) echo '暂无资料';
                    ?></td>
					</tr>
					<tr>
                        <td width="15%" class="tit">物业公司：</td>
                        <td width="85%">
                    <?php echo CHtml::encode($sysModel->sbi_propertyname?$sysModel->sbi_propertyname:'暂无资料')?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tit">车位配置：</td>
                        <td width="85%">
                            <?php
                    $fuck=true;
                    $_unit=array('个','个','元/月','元/小时','','','','','');
                    $i=-1;
                    if($sysModel->sbi_carport){
                    foreach(unserialize($sysModel->sbi_carport) as $k=>$v){
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
                        <td width="15%" class="tit">楼内配置：</td>
                        <td width="85%">
                    <?php
                    if($sysModel->sbi_roommating){
                    foreach(unserialize($sysModel->sbi_roommating) as $k=>$v){
                        if($v) echo $k,'　　';
                    }} else { echo '暂无资料';}
                    ?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tit">电梯配置：</td>
                        <td width="85%">
                    <?php
                    $fuck=true;
                    $_unit=array('m/s','','部','部','s','s','','','','');
                    $i=-1;
                    if($sysModel->sbi_liftinfo){
                    foreach(unserialize($sysModel->sbi_liftinfo) as $k=>$v){
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
                        <td width="15%" class="tit" >楼层信息：</td>
                        <td width="85%">
                    <?php
                    $fuck=true;
                    $_unit=array('平米','米','米','mark','','','','','','');
                    $i=-1;
                    if($sysModel->sbi_floorinfo){
                    foreach(unserialize($sysModel->sbi_floorinfo) as $k=>$v){
                        $i++;
                        if(empty($v)) continue;
                        $fuck=false;
                        if($_unit[$i] == 'mark') {
                            echo $k;
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
				</table>
			</div>
		<?  if($pictures){?>
				<div class="dlmtit">
					<ul>
						<li class="clk"><a href="">房源实景</a></li>
					</ul>
					<div class="dlmore"><a href="<?=$this->createUrl('systembuildinginfo/view',array('id'=>$sysModel->sbi_buildingid,"tag"=>"album",)); ?>">更多&gt;&gt;</a></div>
				</div>
				<div class="lpline">
			 <?php
				 foreach($pictures as $pc){
					$picUrl=PIC_URL.Picture::showStandPic($pc->p_img,"_large");
			          ?>
					<div class="sjmod">
                        <a href="<?php echo PIC_URL.$pc->p_img ?>" rel="fancybox_group"><img alt="" title="<?php echo Picture::$typeDescription[$pc->p_type] ?>" src="<?php echo $picUrl ?>" /></a>
						<p><?php echo $pc->p_title ?></p>
					</div>
		  <?php } ?>
				</div>
		<?  }
		
		?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">地理位置</a></li>
				</ul>
                
			</div>
			<div class="left_map">
				<?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$sysModel->sbi_x ? $sysModel->sbi_x:'121.47536873817444',
                        'y'=>$sysModel->sbi_y ? $sysModel->sbi_y:'31.232857675162947',
                        'name'=>$sysModel->sbi_buildingname ? $sysModel->sbi_buildingname:'人民广场',
                        'width'=>"720px",
                        'height'=>"268px",
                        'type'=>"all",
                ));
                ?>
			</div>
			
<?php   

		if($sysModel->sbi_traffic){ ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">交通状况</a></li>
				</ul>
			</div>
			<div class="left_traffic">
				<?php
				$cssClass = array('ico_metro','ico_elevated','ico_airport','ico_bus','ico_railway');
				$i = -1;
				foreach(unserialize($sysModel->sbi_traffic) as $k => $v){
						$i++;
						if(empty($v)) continue;
					 ?>
					<dl>
						<dt class="sidebg <?php echo $cssClass[$i] ?>"><?php echo CHtml::encode($k) ?></dt>
					   <dd><?php echo CHtml::encode($v) ?></dd>
					</dl>
		<?php   } ?>
			</div>
<?php   }
if($sysModel->getLikeBuild()){?>			

			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">关注<?php echo trim($sysModel->sbi_buildingname) ?>也关注了</a></li>
				</ul>
			</div>
			<div class="gzlou">
				<?php
foreach($sysModel->getLikeBuild() as $val){
?>
				<div class="gzmodel">
                    <img src="<?=Picture::model()->getPicByTitleInt($val['sbi_titlepic'],"_normal");?>">
                    <p><?php echo CHtml::link(common::strCut($val['sbi_buildingname'], 21),array('systembuildinginfo/view','id'=>$val['sbi_buildingid']),array('title'=>$val['sbi_buildingname'])) ?>
                        <em><?php echo $val['sbi_avgrentprice'] ?>元/平米.天</em></p>
                    <p><?php echo CHtml::encode($val['sbi_address']) ?></p>
                </div>
<?php } ?>
            </div>
<?php 
} ?>			
		</div>
<?php

$likeOffices = $model->getLikeOffice(5,$sysModel->sbi_district );
if($likeOffices){
?>
		<div class="dlright">
			<div class="pkcont">
				<h2>看过该房源的还看过</h2>
				<div class="addpk">
					<div class="kgmain">
                        <?php
                        foreach($likeOffices as $loff){
                            $imgsrc = Picture::model()->getPicByTitleInt($loff['ob_titlepicurl'],"_large");
                        ?>
						<div class="kgline">
							<div class="kgpic">
                                <img src="<?php echo $imgsrc ?>" />
                            </div>
							<div class="kgtxt">
								<p><?php echo CHtml::link($loff['sbi_buildingname'],array('view','id'=>$loff['ob_officeid'])) ?></p>
                                <?php if($loff['ob_sellorrent']=='1'){ ?>
								<p><?php echo $loff['ob_officearea'] ?>平方 <?php echo $loff['ob_rentprice'] ?>元/米.天</p>
								<p><em><?php echo $loff['ob_monthrentprice'] ?>元/月</em></p>
                                <?php }else{ ?>
                                <p><?php echo $loff['ob_officearea'] ?>平方 <?php echo $loff['ob_avgprice'] ?>元/平米</p>
								<p><em><?php echo $loff['ob_sumprice'] ?>万元</em></p>
                                <?php } ?>
							</div>
						</div>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
<?php } ?>
	</div>
<script type="text/javascript">

$(document).ready(function() {
    //$("#fancybox_list a").fancybox({
    $("a[rel=fancybox_group]").fancybox({
        'transitionIn': 'none',
        'transitionOut': 'none',
        'titlePosition': 'over',
        'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
    });
});
</script>