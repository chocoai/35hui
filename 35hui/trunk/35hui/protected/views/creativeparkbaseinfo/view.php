    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<em><?php echo CHtml::encode($model->cp_name) ?></em></div>
		<div class="rtspace">浏览次数：<?php echo $model->cp_visit ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->cp_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->cp_englishname) ?></div>
		</div>
        <div class="rtlou">
            <ul>
                <li class="iconlist share"><a  class="jiathis jiathis_txt" href="http://www.jiathis.com/share" target="_blank">分享</a></li>
                <li class="iconlist dayin"><a href="javascript:;" onclick="window.print()">打印</a></li>
            </ul>
        </div>
	</div>
	<div class="dlcont">
		<div class="dlleft">
			<div class="dllcont">
              
				<p>园区地址：[ <?=Region::model()->getNameById($model->cp_district)?> ]&nbsp;&nbsp;&nbsp;<?php echo CHtml::encode($model->cp_address)?>
                </p>
				<p><span class="dll_01">租金报价：<?php echo $model->cp_avgrentprice>0?'<em>'.CHtml::encode($model->cp_avgrentprice).'</em>元/平米.天':'暂无资料'?></span>
                    <span class="dll_01">在　　租：<?php echo Yii::app()->db->createCommand('SELECT COUNT(*) FROM {{creativesource}} WHERE `cr_cpid`='.$model->cp_id)->queryScalar() ?>套</span>
                    </p>
				<p><span class="dll_01">物业费用：<?php echo $model->cp_propertyprice?'<em>'.CHtml::encode($model->cp_propertyprice)."</em>元/平米.月":"暂无资料"?></span>
                    <span class="dll_01">物业管理：<?php echo $model->cp_propertyname?$model->cp_propertyname:"暂无资料"?></span></p>
			</div>
			<div class="dllcont">
				<p><span class="dll_01">改建年代：<?php echo $model->cp_openingtime?date('Y年m月',$model->cp_openingtime):"暂无资料";?></span>
                    <span class="dll_01">得 房 率：<?=$model->cp_defanglv>0?$model->cp_defanglv."%":"暂无资料"?></span></p>
				<p><span class="dll_01">分割面积：<?php echo $model->cp_fengearea?CHtml::encode($model->cp_fengearea):"暂无资料";?> 平米</span>
                    <span class="dll_01">楼层层高：<?php echo ($model->cp_floorheight?CHtml::encode($model->cp_floorheight):''),' ',($model->cp_form?CHtml::encode($model->cp_form):'') ?></span>
                </p>
			</div>
            <h2>新地标分析，他们对<?php echo CHtml::encode(trim($model->cp_name)) ?>最精通</h2>
			<div class="hotagent">
<?php
if($this->beginCache($model->cp_id, array('duration'=>600))) {
foreach($model->getAgentTop() as $uId){
    $_umodel=Uagent::model()->find('ua_uid='.$uId);
?>
				<div class="hamodel">
                    <a href="<?php echo $this->createUrl('uagent/index',array('id'=>$_umodel->ua_id)) ?>">
                    <?php echo CHtml::image(User::model()->getUserHeadPic($uId, "_large"),$_umodel->ua_realname,array('title'=>$_umodel->ua_realname));?>
                    </a>
                    <p><?php echo Uagent::model()->getCompanyByUaid($_umodel,12), ' ',User::model()->getUserShowLink($uId); ?></p>
                    <p>TEL:<em><?php
                    $userModel = User::model()->findByPk($uId);
                    echo $userModel->user_tel
                    ?></em></p>
                </div>
<?php }
$this->endCache(); } ?>
			</div>
			<div class="dldesc"><a href="<?php echo $this->createUrl('view',array('id'=>$model->cp_id,'tag'=>'agent')) ?>">不满意？ 点击查看更多</a>联系经纪人请说是在新地标上看到的，谢谢！</div>
		</div>
		<div class="dlright">
            <div class="dlqj" style="width:500px;height: 317px;">
                <?php if(Panoxml::model()->checkHavePano($model->cp_id, 7)) {
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->cp_id, 7),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=9 AND p_sourceid='.$model->cp_id))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('creativeparkbaseinfo/piclist',array('id'=>$model->cp_id)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                } ?>
            </div>
            <div class="dltxt">
                <?php echo common::strCut(CHtml::encode($model->cp_introduce), 200, '... <a href="javascript:;" onclick="$(this).parent().hide().next().show()">查看详细&gt;&gt;</a>'); ?>
            </div>
<?php if(strlen($model->cp_introduce)>200){ ?>
            <div class="dltxt" style="display:none">
                <?php echo CHtml::encode($model->cp_introduce);  ?>
                <a href="javascript:;" onclick="$(this).parent().hide().prev().show()">收起&lt;&lt;</a>
            </div>
<?php } ?>
		</div>
	</div>
<a name="manview"></a>
	<?php 
    $this->renderPartial('_viewHead',array('model'=>$model));
    $dataProvider->getData();
    if(empty($request['order'])){//默认排序
            $criteria = clone $dataProvider->criteria;
            $all = Creativesource::model()->findAll($criteria);
            //按规则排序。分付费用户和非付费用户区
            $all = Creativesource::model()->orderSource($all);
            $offset = ((isset($_GET['page'])?(int)$_GET['page']:1)-1)*$dataProvider->pagination->pageSize;
            $dataProvider->setData(array_slice($all, $offset, $dataProvider->pagination->pageSize));
    }
    ?>
	<div class="detcont">
        <form method="POST" id="search-form" action="<?php echo $this->createUrl('view',array('id'=>$model->cp_id,'#'=>'manview')) ?>">
        <div class="detitl">
			<div class="detlf">共<em><?php echo $dataProvider->getTotalItemCount() ; ?></em>套</div>
            <div class="detrt">
                <div class="det_01" style="width:130px;">
                    <div class="dlpage">
					<?php
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
						<td class="titl">楼号</td>
                      <td class="titl">
							<div class="dltype listbg" id="mdselect_pos">
								<h6><?php  
                                if(isset($request['floor']) && isset(Officebaseinfo::$ob_floortype[$request['floor']])){
                                    echo Officebaseinfo::$ob_floortype[$request['floor']];
                                }else{ echo '位置'; } ?></h6>
								<div class="ul" style="display:none">
									<p><a href="#">底区</a></p>
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
                            <div class="zjpaixu smclk">
                                <a class="listbg <?php echo $css ?>" href="javascript:;" onclick="setOrderType('<?php echo $ordeType ?>');return false;">面积</a>
                            </div>
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
                            <span class="dwei">元/平米</span>
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
							<div class="zjpaixu longclk"><a class="listbg <?php echo $css ?>" href="javascript:;" onclick="setOrderType('<?php echo $ordeType ?>');return false;">月租金</a>
                            </div>
                            <span class="dwei">元</span>
						</td>
						<td class="titl">联系人</td>
						<td class="titl">联系方式</td>
						<td class="titl">看房</td>
					</tr>
<?php
        if($dataProvider->getData()){
            foreach($dataProvider->getData() as $data){
?>
                    <tr>
						<td class="txt"><?php echo $data->cr_dongname; ?></td>
						<td class="txt"><?php echo @ Officebaseinfo::$ob_floortype[$data->cr_floortype]; ?></td>
						<td class="txt"><?php echo $data->cr_area; ?></td>
						<td class="txt"><?php echo $data->cr_dayrentprice ?></td>
                        <td class="txt"><?php echo $data->cr_monthrentprice ?></td>
                        <td class="txt"><?php echo User::model()->getUserShowLink($data->cr_userid) ?></td>
						<td class="txt"><?php
                            $_t = User::model()->findByPk($data->cr_userid);
                            if($_t) echo CHtml::encode($_t->user_tel); else echo '暂无';
                        ?></td>
                        <td class="txt">
                            <a target="_blank" href="<?php echo $this->createUrl('creativesource/view',array('id'=>$data->cr_id)) ?>">详细</a>
                            <?php if($data->cr_ispanorama){ ?><img src="/images/ok_blue.png" title="全景房源" style=" vertical-align: middle;" /><?php } ?>
                        </td>
					</tr>
<?php
            }
        }else{ echo '<tr><td colspan="8">暂无创意园区出租</td</tr>';}
        
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
$albums = Picture::model()->findAll(array('limit'=>8,'condition'=>'p_sourcetype=9 AND p_sourceid='.$model->cp_id));
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
                    <a href="<?php echo $this->createUrl('view',array('id'=>$model->cp_id,'tag'=>'album')) ?>" title="<?php echo $typeDsc ?>" target="_blank">
					<?php echo CHtml::image($src,CHtml::encode($model->cp_name)) ?>
                    </a>
					<p><?php echo CHtml::encode($pic->p_title) ?></p>
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
                <?php
                $this->widget('ShowSmallMap',array(
                        'x'=>$model->cp_x ? $model->cp_x:'121.47536873817444',
                        'y'=>$model->cp_y ? $model->cp_y:'31.232857675162947',
                        'name'=>$model->cp_name ? $model->cp_name:'人民广场',
                        'width'=>"720px",
                        'height'=>"268px",
                        'type'=>"all",
                ));
                ?>
			</div>
<?php
if($model->cp_traffic){
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
foreach(unserialize($model->cp_traffic) as $k => $v){
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
					<li class="clk"><a href="">详细资料</a></li>
				</ul>
			</div>
            <div class="detcont">
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
                                if($model->cp_propertyserver){
                                    foreach(explode(',',$model->cp_propertyserver) as $k)
                                            $_str .= @ Creativeparkbaseinfo::$cp_propertyserver[$k].' ';
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
                                if($model->cp_roommating){
                                    foreach(explode(',',$model->cp_roommating) as $k)
                                            $_str .= @ Creativeparkbaseinfo::$cp_roommating[$k].' ';
                                }
                                echo $_str?$_str:'暂无资料';
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
<?php
$creativedongs = Yii::app()->db->createCommand('SELECT * FROM {{creativedong}} WHERE `cd_cpid`='.$model->cp_id.' ORDER BY `cd_id`; ')->queryAll();

if($creativedongs){
   

?>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">楼栋情况</a></li>
				</ul>
			</div>
            <div class="dllcont">
                <table cellspacing="0" cellpadding="0" border="0" class="table_01">
					<tr style="background:#E7F1FA;">
						<td class="titl">楼号</td>
                        <td class="titl">总面积</td>
                        <td class="titl">总层数</td>
                        <td class="titl">形态</td>
                        <td class="titl">单层面积</td>
                        <td class="titl">分割面积</td>
                        <td class="titl">层高</td>
                        <td class="titl">电梯数量</td>
                    </tr>
                    <?php foreach($creativedongs as $cd){ ?>
                    <tr>
						<td class="txt"><?php echo CHtml::encode($cd['cd_lounum']) ?></td>
                        <td class="txt"><?php echo $cd['cd_area']?CHtml::encode($cd['cd_area']):'暂无' ?></td>
                        <td class="txt"><?php echo $cd['cd_floornum']?CHtml::encode($cd['cd_floornum']):'暂无' ?></td>
                        <td class="txt"><?php echo $cd['cd_form']?CHtml::encode($cd['cd_form']):'暂无' ?></td>
                        <td class="txt"><?php echo $cd['cd_floorarea']?CHtml::encode($cd['cd_floorarea']):'暂无' ?></td>
                        <td class="txt"><?php echo $cd['cd_fengearea']?CHtml::encode($cd['cd_fengearea']):'暂无' ?></td>
                        <td class="txt"><?php echo $cd['cd_floorheight']?CHtml::encode($cd['cd_floorheight']):'暂无' ?></td>
                        <td class="txt"><?php echo $cd['cd_liftnum']?CHtml::encode($cd['cd_liftnum']):'暂无' ?></td>
                    </tr><?php } ?>
                </table>
            </div>
<?php }
if($model->getLikeBuild()){ ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">关注<?php echo trim($model->cp_name) ?>也关注了</a></li>
				</ul>
			</div>
			<div class="gzlou">
<?php

    foreach($model->getLikeBuild() as $val){
?>
				<div class="gzmodel">
                    <a href="<?php echo $this->createUrl('view',array('id'=>$val['cp_id'])) ?>">
                        <img style=" height: 88px;" src="<?=Picture::model()->getPicByTitleInt($val['cp_titlepic'],"_large");?>">
                    </a>
                    <p><?php echo CHtml::link(common::strCut($val['cp_name'], 21),array('view','id'=>$val['cp_id']),array('title'=>$val['cp_name'])) ?>
                        <em><?php echo $val['cp_avgrentprice'] ?>元/平米.天</em></p>
                    <p><?php echo CHtml::encode($val['cp_address']) ?></p>
                </div>
<?php   }  ?>
			</div>
<?php }  ?>
		</div>
		<div class="dlright">
            <div class="pkcont">
                <h2>创意园区比较</h2>
				<div class="addpk">
<?php

array_pop($viewedBuilds);
?>
					<table cellspacing="0" cellpadding="0" border="0" class="table_02">
						<tbody>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($model->cp_name, 21),array('view','id'=>$model->cp_id),
                                            array('title'=>$model->cp_name,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $model->cp_avgrentprice ?></em>元/平米.天</td>
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
                                            "extraParams"=>array('type'=>'5'),//表示是楼盘、商业广场还是小区
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild1','pkid'=>$model->cp_id),
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
    $pkbuild = Creativeparkbaseinfo::model()->find(array('select'=>'cp_id,cp_name,cp_avgrentprice','condition'=>'cp_id='.$pkid));
}
if($pkbuild){
?>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($pkbuild->cp_name, 21),array('view','id'=>$pkbuild->cp_id),
                                            array('title'=>$pkbuild->cp_name,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $pkbuild->cp_avgrentprice ?></em>元/平米.天</td>
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
                                            "extraParams"=>array('type'=>'5'),//表示是楼盘、商业广场还是小区
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild2','pkid'=>$pkbuild?$pkbuild->cp_id:''),
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
    $pkbuild = Creativeparkbaseinfo::model()->find(array('select'=>'cp_id,cp_name,cp_avgrentprice','condition'=>'cp_id='.$pkid));
}
if($pkbuild){
?>
							<tr>
								<td width="42%">
                                    <?php echo CHtml::link(common::strCut($pkbuild->cp_name, 21),array('view','id'=>$pkbuild->cp_id),
                                            array('title'=>$pkbuild->cp_name,'style'=>'background:none; padding:0;')) ?>
                                </td>
								<td width="32%"><em><?php echo $pkbuild->cp_avgrentprice ?></em>元/平米.天</td>
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
                                            "extraParams"=>array('type'=>'5'),
                                            'htmlOptions'=>array('class'=>'txt_4','id'=>'pkbuild3','pkid'=>$pkbuild?$pkbuild->cp_id:''),
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
</script>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" >
var jiathis_config={
	hideMore:false
}
</script>
<script type="text/javascript" src="http://v2.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->

