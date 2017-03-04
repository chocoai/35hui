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
		<div class="xlflou">
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
<div class="swucont" style="border:1px solid #B42B2F;">
		<div class="fdleft">
			<div class="fd_descmain">
				<p>楼盘地址：[<?php echo $sbi_district,' ',$sbi_section;  ?>]<?php echo CHtml::encode($model->sbi_address)?> <?php echo CHtml::link('查看地图',array('/map/map','id'=>'1-'.$model->sbi_buildingid)) ?>
                    <code style="display: none"><?php echo $model->sbi_district, ':', CHtml::encode(Region::model()->getNameById($model->sbi_district).Region::model()->getNameById($model->sbi_section))?></code>
                </p>
				<p>
					<span class="fd_01">租金报价：<?php echo $model->sbi_avgrentprice>0?'<em>'.CHtml::encode($model->sbi_avgrentprice).'</em>元/㎡.天':'暂无资料'?></span>
					<span class="fd_01">出售报价：<?=$model->sbi_avgsellprice>0?'<em>'.$model->sbi_avgsellprice."</em>元/㎡":"暂无资料"?></span>
				</p>
				<p style="border-bottom:1px dotted #d2d2d2; margin-bottom:7px; padding-bottom:3px;">
                    <?php
                    $tmp="";
                    if($model->sbi_danyuanfenge){
                        $arr=explode(",",$model->sbi_danyuanfenge);
                        if(is_array($arr)&&count($arr)>1){
                            sort($arr);
                            $tmp=$arr[0]."-".$arr[count($arr)-1];
                        }else{
                            $tmp=$model->sbi_danyuanfenge;
                        }
                    }?>
					<span class="fd_01">分割面积：<? echo '<em>'.$tmp."</em>㎡";?></span>
					<span class="fd_01">楼层楼宇：25层</span>
				</p>
				<p>
					<span class="fd_01">开盘时间：<?php echo $model->sbi_openingtime?date('Y-m',$model->sbi_openingtime):"暂无资料"?></span>
					<span class="fd_01">得房率：<?php echo $model->sbi_defanglv?CHtml::encode($model->sbi_defanglv).'%':"暂无资料";?></span>
				</p>
				<p style="border-bottom:1px dotted #d2d2d2; margin-bottom:3px; padding-bottom:3px;">
					<span class="fd_03">开发商：<?php echo $model->sbi_developer?CHtml::encode($model->sbi_developer):"暂无资料";?></span>
				</p>
			</div>
			<div class="xp_xmts"style="font-size: 12px;font-weight:normal;padding-left:5px;">新盘特色</div>
			<div class="xp_des"><?
                    if($model->new->nb_characteristic){
                    $characteristic=explode("，",$model->new->nb_characteristic);
                    shuffle($characteristic);
                    foreach($characteristic as $key=>$val){
                        if($key>7)break;
                    ?><span href="" title="<?=$val?>" class="cl_0<?=$key+1?>"><?=common::strCut($val, 15)?></span>
                    <?}}?>
            </div>
            <div class="xpphone">
				<p>售楼处免费咨询电话（周一至周五：8:00 - 20:00）</p>
				<div class="p"><em>400-820-9181</em></div>
			</div>
		</div>
		<div class="swright">
            <div class="dlqj" style="width:500px;height: 317px;">
                <?php if(Panoxml::model()->checkHavePano($model->sbi_buildingid, 1)) {
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($model->sbi_buildingid, 1),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=1 AND p_sourceid='.$model->sbi_buildingid))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('systembuildinginfo/piclist',array('id'=>$model->sbi_buildingid)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                } ?>
            </div>
        </div>
	</div>

	
	
	<div class="dlmain">
		<div class="dlleft">
            <?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"view","type"=>$type)); ?>
            <div class="xpline"><?=CHtml::encode($model->sbi_buildingintroduce)?></div>
			<div class="xp_bet"><?=$model->new->nb_youshi?></div>
<?if($model->new->nb_characteristic){?>
            <div class="xpmtit">
				<ul>
					<li class="clk"><a href="">最新活动</a></li>
				</ul>
			</div>
			<div class="lpline">
				<?=$model->new->nb_yingxiao?>
			</div>
<?php
}
$albums = Picture::model()->findAll(array('limit'=>8,'condition'=>'p_sourcetype=1 AND p_sourceid='.$model->sbi_buildingid));
if($albums){
?>
            <div class="xpmtit">
				<ul>
					<li class="clk"><a href="">房源实景</a></li>
				</ul>
                <a style="float:right;padding-right:11px;line-height:30px" href="<?=Yii::app()->createUrl("/newsystembuildinfo/view/id/{$_GET['id']}/tag/album");?>">查看更多</a>
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
<?php }
$val="";
foreach(unserialize($model->sbi_peripheral) as $k=>$v){
    $val.=$v;
}
if($val){ ?>
            <div class="xpmtit">
				<ul>
					<li class="clk"><a href="">周边配置</a></li>
				</ul>
			</div>
            <div class="lpline">
				<table cellspacing="0" cellpadding="0" border="0" class="table_3">
				<tbody>
                    <? foreach(unserialize($model->sbi_peripheral) as $k=>$v){
                                    if(empty($v)) continue;
                                ?>
				<tr>
					<td width="16%" class="tit"><?=$k?></td>
					<td width="84%" class="txt"><?=$v?></td>
				</tr>
                <?}?>
		  </tbody></table>
			</div>
            <?}?>
            <div class="xpmtit">
				<ul>
					<li class="clk"><a href="">楼盘详细</a></li>
				</ul>
			</div>
            <div class="lpline">
                    <table border="0" cellpadding="0" cellspacing="0" class="table_3">
                             <?if($model->sbi_danyuanfenge){?>
                            <tr>
                                <td width="16%" class="tit">单元分割面积    </td>
                                <td width="84%" class="txt"><?php echo CHtml::encode($model->sbi_danyuanfenge?$model->sbi_danyuanfenge.'㎡':'暂无资料'); ?></td>
                            </tr><?}if($model->sbi_floorinfo){?><tr>
                                <td width="16%" class="tit">楼层信息    </td>
                                <td width="84%" class="txt"><?php
                                $fuck=true;
                                $_unit=array('㎡','米','米','mark','','','','','','');
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




			 <div class="xpmtit">
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
    $val="";
    foreach(unserialize($model->sbi_traffic) as $k => $v){
        @$val.=$v;
        }
    if(!empty($val)){
?>
			 <div class="xpmtit">
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
             <div class="xpmtit">
				<ul>
					<li class="clk"><a href="">用户评论</a></li>
				</ul>
			</div>
			<div class="gzlou">
          
            <?php
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$comments,
                'itemView'=>'_systembuildingcomment',
                'summaryText'=>'',
                'summaryCssClass'=>'',
                'emptyText'=>'最近点评',
            ));
            ?>
            <div style="background-color:#ffffff;width:100%;height:30px;position:relative;bottom: 25px;">
            </div>
            </div><?php
            }
if($model->getLikeBuild()){            ?>
			<div class="xpmtit">
				<ul>
					<li class="clk"><a href="">附近楼盘</a></li>
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
                        <em><?php echo $val['sbi_avgrentprice'] ?>元/㎡.天</em></p>
                    <p><?php echo CHtml::encode($val['sbi_address']) ?></p>
                </div>
<?php } ?>
			</div>
<?php } ?>
		</div>
        <div class="spright">
			<img src="/images/zsdh.jpg" />
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

