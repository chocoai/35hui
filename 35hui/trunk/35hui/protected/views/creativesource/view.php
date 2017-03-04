<?php
$ob_city = '上海';
$ob_ditrict=Region::model()->getNameById($sysModel->cp_district);
$ob_officename=$sysModel->cp_name;
$ob_officearea=$model->cr_area;

$or_rentprice=$model->cr_dayrentprice.'元';
$keywords=$ob_city.$ob_officename.'创意园区出租,面积'.$ob_officearea.'平方米,'.$or_rentprice;
$description=$ob_city.$ob_ditrict.','.$ob_officename.'租房,日租金：'.$or_rentprice.',面积'.$ob_officearea.'平方米,';
$this->pageTitle = $ob_officename.'出租,'.$ob_city.$ob_officename.'360°全景看房,'.$ob_officename.'租金'.$or_rentprice.'-新地标';


$description.='经纪人:'.$agentModel->ua_realname.',咨询电话:'.$agentModel->userInfo['user_tel'].'。';

Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');

//fancybox-1.3.4
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.mousewheel-3.0.4.pack.js');
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerCssFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.css');
?>
	<div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($sysModel->cp_name,array('creativeparkbaseinfo/view','id'=>$sysModel->cp_id)) ?>&gt;<em>房源详细</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->cr_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($sysModel->cp_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($sysModel->cp_englishname) ?></div>
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
                        <?php echo '租金：<em>',$model->cr_dayrentprice,'</em>元/平米·天';?>
                    </span>
                    <span class="fd_01">面积：<em><?php echo CHtml::encode($model->cr_area); ?></em>平方米</span>
				</p>
				<p style=" background: url(../images/botline.jpg) repeat-x scroll center bottom transparent;">
					<span class="fd_02">
                    <?php echo '月租：<em>',$model->cr_monthrentprice,'</em>元'; ?>
                    </span>
				</p>
				<p>
					<span class="fd_02">物业：<?php echo CHtml::encode($sysModel->cp_propertyname?$sysModel->cp_propertyname:'暂无资料')?></span>
				</p>
				<p>
                    <span class="fd_01">楼号：<?php echo $model->cr_dongname?CHtml::encode($model->cr_dongname):'暂无' ?></span>
					<span class="fd_01">楼层：<?php echo @Officebaseinfo::$ob_floortype[$model->cr_floortype] ?></span>
				</p>
				<p>
					<span class="fd_01">得房率：<?php echo $sysModel->cp_defanglv?CHtml::encode($sysModel->cp_defanglv).'%':"暂无资料";?></span>
					<span class="fd_01">发布时间：<?php echo date("Y-m-d",$model->cr_releasedate)?>(<?php echo common::dealShowTime($model->cr_updatedate)?>更新)</span>
				</p>
			</div>
		</div>
		<div class="swright" style="width:500px;height: 317px;">
            <?php
                if(Panoxml::model()->checkHavePano($model->cr_id, 8)){
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->cr_id, 8),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=9 AND p_sourceid='.$model->cr_cpid))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('creativeparkbaseinfo/piclist',array('id'=>$model->cr_cpid)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                } ?>
        </div>
	</div>
	<div class="dlmain">
		<div class="dlleft">
			<?php if($model->cr_introduce){?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">房源介绍</a></li>
				</ul>
            </div>
			<div class="lpline">
			<span><?=$model->cr_introduce ?></span>
			</div>
			<?php } ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">楼盘概况</a></li>
				</ul>
                <div class="dlmore"><a href="<?php echo $this->createUrl('creativeparkbaseinfo/view',array('id'=>$sysModel->cp_id)) ?>">更多&gt;&gt;</a></div>
			</div>
			<div class="lpline">
				<table cellpadding="0" cellspacing="0" border="0" class="table_03">
					<tr>
                        <td width="15%" class="tit">开发企业：</td><td width="85%"><?php echo $sysModel->cp_developer?CHtml::encode($sysModel->cp_developer):"暂无资料";?></td>
                    </tr>
					<tr>
                        <td width="15%" class="tit">物业公司：</td>
                        <td width="85%">
                    <?php echo CHtml::encode($sysModel->cp_propertyname?$sysModel->cp_propertyname:'暂无资料')?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tit">车位配置：</td>
                        <td width="85%">
                            <?php
                            $_str = '';
                            if($sysModel->cp_carport){
                                $temp = unserialize($sysModel->cp_carport);
                                if(!empty($temp['dishang']))
                                    $_str .= "地上：{$temp['dishang']}个 月租金：{$temp['dishangyue']}元/月/车位 时租金：{$temp['dishangshi']}元/车位<br/>";
                                if(!empty($temp['dixia']))
                                    $_str .= "地上：{$temp['dixia']}个 月租金：{$temp['dixiayue']}元/月/车位 时租金：{$temp['dixiashi']}元/车位<br/>";
                            }
                            echo $_str?$_str:'暂无资料';
                    ?></td>
					</tr>
					<tr>
                        <td width="15%" class="tit">园区配置：</td>
                        <td width="85%">
                    <?php
                                $_str = '';
                                if($sysModel->cp_roommating){
                                    foreach(explode(',',$sysModel->cp_roommating) as $k)
                                            $_str .= @ Creativeparkbaseinfo::$cp_roommating[$k].' ';
                                }
                                echo $_str?$_str:'暂无资料';
                                ?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="tit">物业服务：</td>
                        <td width="85%">
                    <?php
                                $_str = '';
                                if($sysModel->cp_propertyserver){
                                    foreach(explode(',',$sysModel->cp_propertyserver) as $k)
                                            $_str .= @ Creativeparkbaseinfo::$cp_propertyserver[$k].' ';
                                }
                                echo $_str?$_str:'暂无资料';
                                ?></td>
                    </tr>
				</table>
			</div>
<?php if($pictures){ ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">房源实景</a></li>
				</ul>
                <div class="dlmore"><a href="<?php echo $this->createUrl('creativeparkbaseinfo/view',array('id'=>$sysModel->cp_id,'tag'=>'album')) ?>">更多&gt;&gt;</a></div>
			</div>
			<div class="lpline">
         <?php 
             foreach($pictures as $pc){
                $picUrl=PIC_URL.Picture::showStandPic($pc->p_img,"_large");
         ?>
				<div class="sjmod">
                    <a href="<?php echo PIC_URL.$pc->p_img ?>" rel="fancybox_group"><img alt="" title="<?php echo @Picture::$typeDescription[$pc->p_type] ?>" src="<?php echo $picUrl ?>" /></a>
                    <p><?php echo $pc->p_title ?></p>
				</div>
         <?php } ?>
			</div><?php } ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">地理位置</a></li>
				</ul>

			</div>
			<div class="left_map">
				<?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$sysModel->cp_x ? $sysModel->cp_x:'121.47536873817444',
                        'y'=>$sysModel->cp_y ? $sysModel->cp_y:'31.232857675162947',
                        'name'=>$sysModel->cp_name ? $sysModel->cp_name:'人民广场',
                        'width'=>"720px",
                        'height'=>"268px",
                        'type'=>"all",
                ));
                ?>
			</div>
<?php if($sysModel->cp_traffic){ ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">交通状况</a></li>
				</ul>
			</div>
			<div class="left_traffic">
<?php
$cssClass = array('ico_metro','ico_elevated','ico_airport','ico_bus','ico_railway');
$i = -1;
foreach(unserialize($sysModel->cp_traffic) as $k => $v){
    $i++;
    if(empty($v)) continue;
?>
            	<dl>
					<dt class="sidebg <?php echo $cssClass[$i] ?>"><?php echo CHtml::encode($k) ?></dt>
                   <dd><?php echo CHtml::encode($v) ?></dd>
				</dl>
<?php } ?>
			</div><?php } ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">关注<?php echo trim($sysModel->cp_name) ?>也关注了</a></li>
				</ul>
			</div>
			<div class="gzlou">
				<?php
foreach($sysModel->getLikeBuild() as $val){
?>
				<div class="gzmodel">
                    <img src="<?=Picture::model()->getPicByTitleInt($val['cp_titlepic'],"_large");?>">
                    <p><?php echo CHtml::link(common::strCut($val['cp_name'], 21),array('creativeparkbaseinfo/view','id'=>$val['cp_id']),array('title'=>$val['cp_name'])) ?>
                        <em><?php echo $val['cp_avgrentprice'] ?>元/平米.天</em></p>
                    <p><?php echo CHtml::encode($val['cp_address']) ?></p>
                </div>
<?php } ?>
            </div>
		</div>
<?php
$likeOffices = $model->getLikes();
if($likeOffices){
?>
		<div class="dlright">
			<div class="pkcont">
				<h2>看过该房源的还看过</h2>
				<div class="addpk">
					<div class="kgmain">
                        <?php
                        foreach($likeOffices as $loff){
                            $imgsrc = Picture::model()->getPicByTitleInt($loff['cr_titlepicurl'],"_large");
                        ?>
						<div class="kgline">
							<div class="kgpic">
                                <img src="<?php echo $imgsrc ?>" />
                            </div>
							<div class="kgtxt">
								<p><?php echo CHtml::link($loff['cp_name'],array('view','id'=>$loff['cr_id'])) ?></p>
								<p><?php echo $loff['cr_area'] ?>平方 <?php echo $loff['cr_dayrentprice'] ?>元/米.天</p>
								<p><em><?php echo $loff['cr_monthrentprice'] ?>元/月</em></p>
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