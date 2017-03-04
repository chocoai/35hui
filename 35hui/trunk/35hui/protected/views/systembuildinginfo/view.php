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
		<div class="lfspace"><a href="/">首页</a>&gt;<em><?php echo CHtml::encode($model->sbi_buildingname) ?></em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
        <div class="rtlou">
            <ul>
                <?php if($model->sbi_loushu || $model->sbi_hetong) { ?>
                <li class="iconlist down" id="downloadinfo">
                    <a href="javascript:;">下载</a>
                    <div class="xzpos" style="display: none">
                        <?php
                        if($model->sbi_loushu){
                            echo CHtml::link('楼书下载',array('manage/manage/download','id'=>$model->sbi_loushu,'type'=>1,'atttype'=>1),array('class'=>'blue','id'=>'cf_loushu'));
                        }
                        if($model->sbi_hetong){
                            echo CHtml::link('租赁合同下载',array('manage/manage/download','id'=>$model->sbi_hetong,'type'=>1,'atttype'=>2),array('class'=>'blue','id'=>'cf_hetong'));
                        } ?>
                    </div>
                </li><?php } ?>
                <li class="iconlist share"><a  class="jiathis jiathis_txt" href="http://www.jiathis.com/share" target="_blank">分享</a></li>
                <li class="iconlist dayin"><a href="javascript:;" onclick="window.print()">打印</a></li>
                <li class="iconlist bianji"><a href="/manage?url=<?=Yii::app()->createUrl("manage/correction/index",array("type"=>1,"id"=>$model->sbi_buildingid));?>" target="_blank">编辑</a></li>
            </ul>
        </div>
	</div>
	<div class="dlcont">
		<div class="dlleft">
			<div class="dllcont">
				<p>楼盘地址：[<?php echo $sbi_district,' ',$sbi_section;  ?>]<?php echo CHtml::encode($model->sbi_address)?> <?php echo CHtml::link('查看地图',array('/map/map','id'=>'1-'.$model->sbi_buildingid)) ?>
                    <code style="display: none"><?php echo $model->sbi_district, ':', CHtml::encode(Region::model()->getNameById($model->sbi_district).Region::model()->getNameById($model->sbi_section))?></code>
                </p>
				<p><span class="dll_01">楼宇等级：<?php echo CHtml::encode($model->sbi_propertydegree?Systembuildinginfo::model()->propertyIntToDescribe($model->sbi_propertydegree):"暂无资料")?></span>
                    <span class="dll_01">得 房 率：<?php echo $model->sbi_defanglv?CHtml::encode($model->sbi_defanglv).'%':"暂无资料";?></span></p>
				<p><span class="dll_01">楼宇层数：<?php echo $model->sbi_floor?CHtml::encode($model->sbi_floor).'层':"暂无资料";?></span>
                    <span class="dll_01">竣工年月：<?php echo $model->sbi_openingtime?date('Y年',$model->sbi_openingtime):"暂无资料"?></span></p>
			</div>
			<div class="dllcont">
				<p><span class="dll_01">租金报价：<?php echo $model->sbi_avgrentprice>0?'<em>'.CHtml::encode($model->sbi_avgrentprice).'</em>元/平米.天':'暂无资料'?></span>
                    <span class="dll_01">出售报价：<?=$model->sbi_avgsellprice>0?'<em>'.$model->sbi_avgsellprice."</em>元/平米":"暂无资料"?></span></p>
				<p><span class="dll_01">在　　租：<?php echo Systembuildinginfo::model()->getRentNums($model->sbi_buildingid)?>套</span>
                    <span class="dll_01">在　　售：<?php echo Systembuildinginfo::model()->getSellNums($model->sbi_buildingid)?>套</span></p>
				<p><span class="dll_01">物业费用：<?php echo $model->sbi_propertyprice?'<em>'.CHtml::encode($model->sbi_propertyprice)."</em>元/平米.月":"暂无资料"?></span></p>
			</div>
			<div class="dllcont">
				<p>开发商：<?php echo $model->sbi_developer?CHtml::encode($model->sbi_developer):"暂无资料";?></p>
				<p>物业管理：<?php echo CHtml::encode($model->sbi_propertyname?$model->sbi_propertyname:'暂无资料')?></p>
			</div>
            <h2>新地标分析，他们对<?php echo CHtml::encode(trim($model->sbi_buildingname)) ?>最精通</h2>
			<div class="hotagent">
<?php
if($this->beginCache($model->sbi_buildingid, array('duration'=>600))) {
foreach($model->getAgentTop() as $uId){
    $_umodel=Uagent::model()->find('ua_uid='.$uId);
?>
				<div class="hamodel">
                    <a href="<?php echo $this->createUrl('uagent/index',array('id'=>$_umodel->ua_id)) ?>">
                    <?php echo CHtml::image(User::model()->getUserHeadPic($uId, "_large"),$_umodel->ua_realname,array('title'=>$_umodel->ua_realname));?>
                    </a>
                    <p style="overflow:hidden"><?php echo Uagent::model()->getCompanyByUaid($_umodel,12), ' ',User::model()->getUserShowLink($uId); ?></p>
                    <p>TEL:<em><?php
                    $userModel = User::model()->findByPk($uId);
                    echo $userModel->user_tel
                    ?></em></p>
                </div>
<?php }
$this->endCache(); } ?>
			</div>
			<div class="dldesc"><a href="<?php echo $this->createUrl('view',array('id'=>$model->sbi_buildingid,'tag'=>'agent')) ?>">不满意？ 点击查看更多</a>联系经纪人请说是在新地标上看到的，谢谢！</div>
		</div>
		<div class="dlright">
            <div class="dlqj" style="width:500px;height: 317px;">
                <?php if(Panoxml::model()->checkHavePano($model->sbi_buildingid, 1)) {
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->sbi_buildingid, 1),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=1 AND p_sourceid='.$model->sbi_buildingid))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('systembuildinginfo/piclist',array('id'=>$model->sbi_buildingid)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                } ?>
            </div>
            <div class="dltxt">
                <?php echo common::strCut(CHtml::encode($model->sbi_buildingintroduce), 540, '... <a href="javascript:;" onclick="$(this).parent().hide().next().show()">查看详细&gt;&gt;</a>'); ?>
            </div>
<?php if(strlen($model->sbi_buildingintroduce)>540){ ?>
            <div class="dltxt" style="display:none">
                <?php echo CHtml::encode($model->sbi_buildingintroduce);  ?>
                <a href="javascript:;" onclick="$(this).parent().hide().prev().show()">收起&lt;&lt;</a>
            </div>
<?php } ?>
		</div>
	</div>
<a name="manview"></a>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"view")); ?>
	<div class="detcont">
        <form method="POST" id="search-form" action="<?php echo $this->createUrl('systembuildinginfo/view',array('id'=>$model->sbi_buildingid,'#'=>'manview')) ?>">
        <div class="detitl">
			<div class="detlf">出租房源<em><?php echo Systembuildinginfo::model()->getRentNums($model->sbi_buildingid)?></em>套 |
                出售房源<em><?php echo Systembuildinginfo::model()->getSellNums($model->sbi_buildingid)?></em>套</div>
            <div class="detrt">
                <div class="det_01" style="width:130px;">
                    <div class="dlpage">
					<?php
                    $dataProvider->getData();
                    $_GET['#'] = 'manview';
                    $this->widget('CDibiaoLinkPager',array(
                        'pages'=>$dataProvider->pagination,
                        "htmlOptions"=>array("style"=>"float:right","class"=>"dibiaoPage",),
                        "nextPageLabel"=>"下一页",
                        "prevPageLabel"=>"上一页",
                        "cssFile"=>"/css/pager.css",
                ));
                    ?></div>
				</div>
				<div class="det_01">
					<div class="dlmoren listbg" id="mdselect_order">
						<h5><?php
                        $orders=array(
                            'arasc'  => '面积升序',
                            'ardesc' => '面积降序',
                            'prasc'  => '报价升序',
                            'prdesc' => '报价降序',
                            'aprasc'  => '总价升序',
                            'aprdesc' => '总价降序',
                        );
                        if(!empty($request['order'])){
                            echo $orders[$request['order']];
                        }else{
                            echo '默认排序';
                        }
                        ?></h5>
						<div style="display:none" class="ul">
                            <p><a name="arasc">面积升序</a></p>
							<p><a name="ardesc">面积降序</a></p>
                            <p><a name="prasc">报价升序</a></p>
							<p><a name="prdesc">报价降序</a></p>
                            <p><a name="aprasc">总价升序</a></p>
							<p><a name="aprdesc">总价降序</a></p>
                            <p><a name="">默认排序</a></p>
						</div>
					</div>
				</div>
				<div class="det_01">元</div>
				<div class="l_taobao">
					<div class="lt_cont" id="rank-price">
						<p>
                            <?php echo CHtml::textField('prst',!empty($request['prst'])?$request['prst']:'',array('class'=>'txt_3')) ?> -
                            <?php echo CHtml::textField('pred',!empty($request['pred'])?$request['pred']:'',array('class'=>'txt_3')) ?>
                        </p>
						<div class="p"><span><input type="submit" value="确定" /></span></div>
					</div>
				</div>
				<div class="det_01">报价：</div>

				<div class="det_01">|</div>
				<div class="det_01">平米</div>
				<div class="l_taobao">
					<div class="lt_cont" id="rank-area">
						<p>
                            <?php echo CHtml::textField('arst',!empty($request['arst'])?$request['arst']:'',array('class'=>'txt_3')) ?> -
                            <?php echo CHtml::textField('ared',!empty($request['ared'])?$request['ared']:'',array('class'=>'txt_3')) ?>
                        </p>
						<div class="p" id="mptb"><span><input type="submit" value="确定" /></span></div>
					</div>
				</div>
				<div class="det_01">面积：</div>
			</div>
            <p style="display: none">
                <input type="hidden" name="order" value="<?php echo $request['order'] ?>" id="search_order"/>
                <input type="hidden" name="srtp" value="<?php echo empty($request['srtp'])?'':$request['srtp'] ?>" id="search_srtp" />
                <input type="hidden" name="floor" value="<?php echo empty($request['floor'])?'':$request['floor'] ?>" id="search_floor" />
            </p>
		</div>
        </form>

		<div class="dllcont">
                    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
					<tr style="background:#E7F1FA;">
						<td class="titl">
							<div class="dltype listbg" id="mdselect_srtp">
								<h6><?php echo $srtp=='1'?'出租':'出售'  ?></h6>
								<div class="ul" style="display:none">
									<p><a href="#">出 租</a></p>
									<p><a href="#">出 售</a></p>
								</div>
							</div>
					  </td>
                      <td class="titl">
							<div class="dltype listbg" id="mdselect_pos">
								<h6><?php
                                if(isset($request['floor']) && isset(Officebaseinfo::$ob_floortype[$request['floor']])){
                                    echo Officebaseinfo::$ob_floortype[$request['floor']];
                                }else{ echo '位置'; }
                                ?></h6>
								<div class="ul" style="display:none">
									<p><a href="#">低区</a></p>
									<p><a href="#">中区</a></p>
									<p><a href="#">高区</a></p>
								</div>
							</div>
						</td>
						<td class="titl">
<?php
$css = 'mren';
$ordeType='arasc';
if($request['order']=='arasc'){
    $ordeType='ardesc';
    $css = 'mrenup';
}elseif($request['order']=='ardesc'){
    $css = 'mrendown';
}
?>
                            <div class="zjpaixu smclk"><a class="listbg <?php echo $css ?>" href="javascript:;" onclick="setOrderType('<?php echo $ordeType ?>');return false;">面积</a></div>
                            <span class="dwei">平米</span>
						</td>
						<td class="titl">
<?php
$css = 'mren';
$ordeType='prasc';
if($request['order']=='prasc'){
    $ordeType='prdesc';
    $css .= 'up';
}elseif($request['order']=='prdesc'){
    $css .= 'down';
}
?>
							<div class="zjpaixu smclk"><a class="listbg <?php echo $css ?>" href="javascript:;" onclick="setOrderType('<?php echo $ordeType ?>');return false;">报价</a></div>
                            <span class="dwei"><?php echo $srtp=='1'?'元':'元/平米' ?></span>
						</td>
						<td class="titl">
<?php
$css = 'longren';
$ordeType='aprasc';
if($request['order']=='aprasc'){
    $ordeType='aprdesc';
    $css .= 'up';
}elseif($request['order']=='aprdesc'){
    $css .= 'down';
}
?>
							<div class="zjpaixu longclk"><a class="listbg <?php echo $css ?>" href="javascript:;" onclick="setOrderType('<?php echo $ordeType ?>');return false;"><?php echo $srtp=='1'?'月租金':'总售价' ?></a>
                            </div>
                            <span class="dwei"><?php echo $srtp=='1'?'元/平米.月':'万元' ?></span>
						</td>
						<td class="titl">联系人</td>
						<td class="titl">联系方式</td>
						<td class="titl">看房</td>
					</tr>
<?php
        if(empty($request['order'])){//默认排序
            $criteria = clone $dataProvider->criteria;
            $all = Officebaseinfo::model()->findAll($criteria);
            //按规则排序。分付费用户和非付费用户区
            $all = Officebaseinfo::model()->orderSource($all);
            $offset = ((isset($_GET['page'])?(int)$_GET['page']:1)-1)*$dataProvider->pagination->pageSize;
            $dataProvider->setData(array_slice($all, $offset, $dataProvider->pagination->pageSize));
        }
        if($dataProvider->getData()){
            foreach($dataProvider->getData() as $data){
?>
                    <tr>
                        <td class="txt"><?php echo $data->ob_sellorrent=='1'?'出租':'出售'; ?></td>
						<td class="txt"><?php echo @ Officebaseinfo::$ob_floortype[$data->ob_floortype]; ?></td>
						<td class="txt"><?php echo $data->ob_officearea ?></td>
						<td class="txt"><?php if($data->ob_sellorrent=='1'){
                            echo $data->ob_rentprice;
                            $total = $data->ob_monthrentprice;
                        }else{
                            echo $data->ob_avgprice;
                            $total = $data->ob_sumprice;
                        } ?></td>
						<td class="txt"><?php echo $total ?></td>
                        <td class="txt"><?php echo User::model()->getUserShowLink($data->ob_uid) ?></td>
						<td class="txt"><?php
                            $_t = User::model()->findByPk($data->ob_uid);
                            if($_t) echo CHtml::encode($_t->user_tel); else echo '暂无';
                        ?></td>
                        <td class="txt">
                            <a target="_blank" href="<?php echo $this->createUrl('officebaseinfo/view',array('id'=>$data->ob_officeid)) ?>">详细</a>
                            <?php if($data->ob_ispanorama){ ?><img src="/images/ok_blue.png" title="全景房源" style=" vertical-align: middle;" /><?php } ?>
                        </td>
					</tr>
<?php
            }
        }else{ 
            $str=$srtp=='1'?'出租':'出售';
            echo '<tr><td colspan="8">暂无房源'.$str.'</td</tr>';}
?>
			  </table>
<?php
            $_GET['#'] = 'manview';
            $this->widget('CLinkPager',array(
                    'cssFile'=>'/css/pager.css',
                    'pages'=>$dataProvider->pagination,
            ));
?>
		</div>
	</div>
	<div class="dlmain">
		<div class="dlleft">
<?php
$albums = Picture::model()->findAll(array('limit'=>8,'condition'=>'p_sourcetype=1 AND p_sourceid='.$model->sbi_buildingid));
if($albums){
?>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">相 册</a></li>
				</ul>
                <a style="float:right;padding-right:11px;line-height:30px" href="<?=Yii::app()->createUrl("/systembuildinginfo/view/id/{$_GET['id']}/tag/album");?>">查看更多</a>
			</div>
			<div class="lpline">
                <?php
                foreach($albums as $pic){// /images/1.jpg
                    $src = PIC_URL.Picture::showStandPic($pic->p_img,"_large");
                    $typeDsc = isset(Picture::$typeDescription[$pic->p_type])?Picture::$typeDescription[$pic->p_type]:'';
                ?>
                <div class="sjmod">
                    <a href="<?php echo $this->createUrl('systembuildinginfo/view',array('id'=>$model->sbi_buildingid,'tag'=>'album')) ?>" title="<?php echo $typeDsc ?>" target="_blank">
					<?php echo CHtml::image($src,CHtml::encode($model->sbi_buildingname)) ?>
                    </a>
					<p><?php echo CHtml::encode($pic->p_title) ?></p>
				</div>
                <?php } ?>
			</div>
<?php } ?>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">详细资料</a></li>
				</ul>
                <a style="float:right;padding-right:11px;line-height:30px" href="<?=Yii::app()->createUrl("/systembuildinginfo/view/id/{$_GET['id']}/tag/details");?>">查看更多</a>
			</div>
            <div class="detcont">
                <div class="dllcont">
                    <table border="0" cellpadding="0" cellspacing="0" class="table_03">
                             <?if($model->sbi_danyuanfenge){?>
                            <tr>
                                <td width="16%" class="tit">单元分割面积    </td>
                                <td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_danyuanfenge?$model->sbi_danyuanfenge.'平米':'暂无资料'); ?></td>
                            </tr><?}if($model->sbi_floorinfo){?><tr>
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
                            </tr><?}if($model->sbi_roommating){?>
                            <tr>
                                <td width="16%" class="tit">楼内配套</td>
                                <td width="84%" class="txt"><?php
                                if($model->sbi_roommating){
                                foreach(unserialize($model->sbi_roommating) as $k=>$v){
                                    echo '<img src="/images/icon/'.($v?'marky.gif':'markn.gif').'">',$k,'　　';
                                }}else{ echo '暂无资料';}
                                ?></td>
                            </tr>
                           <?}?>
                      </table>
                </div>
            </div>




			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">地理位置</a></li>
				</ul>
			</div>
			<div class="left_map">
                <?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$model->sbi_x ? $model->sbi_x:'121.47536873817444',
                        'y'=>$model->sbi_y ? $model->sbi_y:'31.232857675162947',
                        'name'=>$model->sbi_buildingname ? $model->sbi_buildingname:'人民广场',
                        'width'=>"720px",
                        'height'=>"268px",
                        'type'=>"all",
                ));
                ?>
			</div>
            
<?php
if(unserialize($model->sbi_traffic)){
    foreach(unserialize($model->sbi_traffic) as $k => $v){
        @$val.=$v;
        }
    if(!empty($val)){
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
foreach(unserialize($model->sbi_traffic) as $k => $v){
    $i++;
    if(empty($v)) continue;
?>
            	<dl>
					<dt class="sidebg <?php echo $cssClass[$i] ?>"><?php echo CHtml::encode($k) ?></dt>
                   <dd><?php echo CHtml::encode($v) ?></dd>
				</dl>
<?php } ?>
			</div><?php }}
            
            $all=Systembuildingcomment::model()->findAllByAttributes(array("sbc_buildingid"=>$_GET['id']));
            if($all){
                ?>

            <div class="dlmtit" >
				<ul>
					<li class="clk"><a href="<?=Yii::app()->createUrl("/systembuildinginfo/view/id/{$_GET['id']}/tag/comment");?>">用户评论</a></li>
				</ul>
                
			</div>
			<div >
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$comments,
                'itemView'=>'_systembuildingcomment',
                'summaryText'=>'',
                'summaryCssClass'=>'',
                'emptyText'=>'最近点评',
            ));
            ?>
            <div style="background-color:#ffffff;width:720px;height:30px;position:relative"></div>
            </div><?php
            }
if($model->getLikeBuild()){            ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">关注<?php echo trim($model->sbi_buildingname) ?>也关注了</a></li>
				</ul>
			</div>
			<div class="gzlou">
<?php
foreach($model->getLikeBuild() as $val){
?>
				<div class="gzmodel">
                    <a href="<?php echo $this->createUrl('systembuildinginfo/view',array('id'=>$val['sbi_buildingid'])) ?>">
                        <img src="<?=Picture::model()->getPicByTitleInt($val['sbi_titlepic'],"_normal");?>">
                    </a>
                    <p><?php echo CHtml::link(common::strCut($val['sbi_buildingname'], 21),array('systembuildinginfo/view','id'=>$val['sbi_buildingid']),array('title'=>$val['sbi_buildingname'])) ?>
                        <em><?php echo $val['sbi_avgrentprice'] ?>元/平米.天</em></p>
                    <p><?php echo CHtml::encode($val['sbi_address']) ?></p>
                </div>
<?php } ?>
			</div>
<?php } ?>
		</div>
		<div class="dlright">
			<div class="pkcont">
                <h2>写字楼比较</h2>
				<div class="addpk">
<?php
array_pop($viewedBuilds);
?>
					<table cellspacing="0" cellpadding="0" border="0" class="table_02">
						<tbody>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($model->sbi_buildingname, 21),array('systembuildinginfo/view','id'=>$model->sbi_buildingid),
                                            array('title'=>$model->sbi_buildingname,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $model->sbi_avgrentprice ?></em>元/平米.天</td>
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
                                            "extraParams"=>array('type'=>'1'),//表示是楼盘、商业广场还是小区
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild1','pkid'=>$model->sbi_buildingid),
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
    $pkbuild = Systembuildinginfo::model()->find(array('select'=>'sbi_buildingid,sbi_buildingname,sbi_avgrentprice','condition'=>'sbi_buildingid='.$pkid));
}
if($pkbuild){
?>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($pkbuild->sbi_buildingname, 21),array('systembuildinginfo/view','id'=>$pkbuild->sbi_buildingid),
                                            array('title'=>$pkbuild->sbi_buildingname,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $pkbuild->sbi_avgrentprice ?></em>元/平米.天</td>
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
                                            "extraParams"=>array('type'=>'1'),//表示是楼盘、商业广场还是小区
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild2','pkid'=>$pkbuild?$pkbuild->sbi_buildingid:''),
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
    $pkbuild = Systembuildinginfo::model()->find(array('select'=>'sbi_buildingid,sbi_buildingname,sbi_avgrentprice','condition'=>'sbi_buildingid='.$pkid));
}
if($pkbuild){
?>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($pkbuild->sbi_buildingname, 21),array('systembuildinginfo/view','id'=>$pkbuild->sbi_buildingid),
                                            array('title'=>$pkbuild->sbi_buildingname,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $pkbuild->sbi_avgrentprice ?></em>元/平米.天</td>
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
                                            "extraParams"=>array('type'=>'1'),//表示是楼盘、商业广场还是小区
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild3','pkid'=>$pkbuild?$pkbuild->sbi_buildingid:''),
                                            "methodChain"=>".result(function(event,item){setBuid('pkbuild3',item)})",
                                    ));?>
                                </td>
							</tr>
						</tbody>
		 			 </table>
				</div>
                <div class="addpkbtn"><a href="#" onclick="gotoPkNow();"><img src="/images/btnpk.jpg"></a></div>
			</div>
		</div>
	</div>
<div id="albumform" style="display: none">
    <?=$this->renderPartial('_albumform');?>
</div>
<?
Yii::app()->clientScript->registerCssFile("/js/common/common.css");
Yii::app()->clientScript->registerScriptFile("/js/common/common.js",CClientScript::POS_BEGIN);
//Yii::app()->clientScript->registerScriptFile("/js/jquery.js");?>
<script type="text/javascript">
    $(function(){
        $('#mdselect_srtp').bind('mouseover',function(){
            $(this).find('div').show();
        }).bind('mouseout',function(){
            $(this).find('div').hide();
        }).find('p').click(function(){
            $('#search_srtp').val($(this).index()+1);
            $('#mdselect_srtp h5').html($(this).text());
            $('#mdselect_srtp div').hide();
            formSubmit();
            return false;
        });
        $('#mdselect_pos').bind('mouseover',function(){
            $(this).find('div').show();
        }).bind('mouseout',function(){
            $(this).find('div').hide();
        }).find('p').click(function(){
            $('#search_floor').val($(this).index()+1);
            $('#mdselect_pos h5').html($(this).text());
            $('#mdselect_pos div').hide();
            formSubmit();
            return false;
        });
        $('#mdselect_order').bind('mouseover',function(){
            $(this).find('div').show();
        }).bind('mouseout',function(){
            $(this).find('div').hide();
        }).find('p').click(function(){
            setOrderType($(this).find('a').attr('name'));
            $('#mdselect_order h5').html($(this).text());
            $('#mdselect_order div').hide();
            return false;
        });
        var closeRank1,closeRank2;
        $('#rank-price :text').focusin(function(){
            rankSwitch("#rank-price",1);
            clearTimeout(closeRank1);
        }).focusout(function(){
            closeRank1=setTimeout(function(){
                rankSwitch("#rank-price",0);
            },500);
        });
        $('#rank-area :text').focusin(function(){
            rankSwitch("#rank-area",1);
            clearTimeout(closeRank2);
        }).focusout(function(){
            closeRank2=setTimeout(function(){
                rankSwitch("#rank-area",0);
            },200);
        });
        $("table.table_01 tr:gt(0)").hover(
        function(){
            $(this).addClass('trbg');
        },
        function(){
            $(this).removeClass('trbg');
        });
        $("#downloadinfo").hover(
        function(){
            $(this).addClass("xzborder").find("div").show();
        },
        function(){
            $(this).removeClass("xzborder").find("div").hide();
        });
    });
    function rankSwitch(id,f){
        if(f){
            $(id).addClass('tbbg').find('span').addClass('lthidden');
        }else{
            $(id).removeClass('tbbg').find('span').removeClass('lthidden');
        }
    }
    function setOrderType(t){
        $("#search_order").val(t);
        formSubmit();
    }
    function formSubmit(){
        $("#search-form").submit();
    }
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
    }
    function addCommentLog(id,obj){
        var chec = <?=Yii::app()->user->isGuest?"1":"0" ?>;
        if(chec){
            createAlbum();
            return false;
        }
        $.ajax({
            type:"post",
            url:"<?=Yii::app()->createUrl('/systembuildinginfo/addcommentlog')?>",
            data: {"sbcl_cid":id},
            success: function(Msg){
                if(!Msg){
                   $(obj).parent("div").find("span").html( $(obj).parent("div").find("span").html()/1+1);
                }else{
                     jw.pop.alert(Msg,{
                            zIndex:10001,
                            icon:2,
                            window_drag:false
                        });
                }
            }
        });
    }
    function createAlbum(){
    
           var content = "<div id='alertform'>"+$("#albumform").html()+"</div>";
            jw.pop.customtip(
            "用户登录",
            content,
            {
                window_drag:false,
                hasBtn_ok:true,
                hasBtn_cancel:true,
                zIndex:10000,
                ok: function(){
                    var username = $.trim($("#alertform form input[name='LoginForm[username]']").val());
                    var password = $.trim($("#alertform form input[name='LoginForm[password]']").val());
                    var loginType = $("#alertform form input[name='loginType']:checked").val();
                     var url="<?=Yii::app()->createUrl("/site/login");?>"
                    if(username==""){
                        jw.pop.alert("请输入用户名！",{
                            zIndex:10001,
                            icon:2,
                            window_drag:false
                        });
                        return false;
                    }
                    if(password==""){
                        jw.pop.alert("请输入密码！",{
                            zIndex:10001,
                            icon:2,
                            window_drag:false
                        });
                        return false;
                    }
                    if(loginType==2){
                        url="<?=Yii::app()->createUrl("/site/agentlogin");?>";
                    }
                    $.post(url,$("#alertform form").serialize(),function(msg){
                        jw.pop.alert(msg,{
                            zIndex:10001,
                            icon:2,
                            window_drag:false
                        });
                        if(msg=="账户名或密码错误"){
                           createAlbum();
                        }
                        if(msg=="登录成功"){
                            window.location.reload();
                        }
                    },"html")
                },
                btn_float:"center"
            }
        );
    }
</script>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" >
var jiathis_config={
	hideMore:false
}
</script>
<script type="text/javascript" src="http://v2.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->

