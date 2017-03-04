<?php
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.mousewheel-3.0.4.pack.js');
Yii::app()->clientScript->registerScriptFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.pack.js');
Yii::app()->clientScript->registerCssFile('/js/fancybox-1.3.4/jquery.fancybox-1.3.4.css');

$agentInfo = Uagent::model()->findByAttributes(array('ua_uid'=>$ownerInfo->user_id));
$sb_city = Region::model()->getNameById($shopModel['sb_city']);
$sb_district=Region::model()->getNameById($shopModel['sb_district']);
$sb_section=Region::model()->getNameById($shopModel->sb_section);
$sb_sellorrent=$shopModel->sb_sellorrent;
$sp_shoptitle=$shopModel->presentInfo->sp_shoptitle;
$description=$sb_city.$sb_district.','.$sb_section.'商铺';

if($sb_sellorrent==1) {
    if($shopModel->rentInfo->sr_renttype==1){
        $description='找'.$sb_city.'出租商铺,'.$sb_city.'360°全景找铺，就在新地标全景看房网。';
        $description .='出租，商铺租金：'.$shopModel->rentInfo->sr_monthrentprice.'元/月,';
    }else{
        $description='找'.$sb_city.'转让商铺,'.$sb_city.'360°全景找铺，就在新地标全景看房网。';
        $description .='转让，转让费：'.$shopModel->rentInfo->sr_transferprice.'万,';
    }
}else{
    $description='找'.$sb_city.'出售商铺,'.$sb_city.'360°全景找铺，就在新地标全景看房网。';
    $description .='出售，商铺售价：'.$shopModel->sellInfo->ss_sumprice.'万,';
}
$description.=$sb_city.$sb_district.$sb_section.'/'.$sp_shoptitle.'最新出售和出租商铺查询就上新地标。';
$keywords = $sb_city.$sp_shoptitle.','.$sp_shoptitle.'商铺,'.$sp_shoptitle.'商铺租售,360°全景看商铺';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $sp_shoptitle.',360°现场全景看商铺 – 新地标';
?>
 <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<em><?=$type?></em>&gt;<em>房源详细</em></div>
		<div class="rtspace">浏览次数：<?=$shopModel->sb_visit?></div>
	</div>
	<div class="sp_titmsg"><?=$shopModel->presentInfo->sp_shoptitle  ?></div>
	<div class="swucont">
		<div class="fdleft">
			<div class="fd_head">
				<div class="fd_pic"><?=CHtml::link(CHtml::image(User::model()->getUserHeadPic($ownerInfo->user_id),"",array("width"=>"100","height"=>"130")),array("/uagent/index",'id'=>$agentInfo->ua_id),array("target"=>"_blank"));?>
                </div>
				<div class="fd_txt">
					<p><?php echo CHtml::encode($agentInfo->ua_realname); ?> <?php echo User::model()->getUserLevelByUserId($ownerInfo->user_id),' ';
            if($agentInfo->ua_combo) echo Uagent::model()->getAgentComboIconUrl($agentInfo);
            ?></p       
					<p>
                        <?php
                //身份认证
                if(Uagent::model()->getIdentityCertification($ownerInfo->user_id)){
                    echo CHtml::image(IMAGE_URL."/icon/sf.gif","已通过身份证实名验证",array("title"=>"已通过身份证实名验证"));
                }else {
                    echo CHtml::image(IMAGE_URL."/icon/sf_gray.gif","未认证",array("title"=>"身份未认证"));
                }
                //名片认证
                if(Uagent::model()->getSeniorityCertification($ownerInfo->user_id)){
                    echo CHtml::image(IMAGE_URL."/icon/zy.gif","已提交经纪人证书",array("title"=>"已提交经纪人证书"));
                }else{
                    echo CHtml::image(IMAGE_URL."/icon/zy_gray.gif","未认证",array("title"=>"名片未认证"));
                }
                ?>
                    </p>
					<p> <?php echo CHtml::encode($agentInfo->ua_company); ?></p>
					<p><em><?=$ownerInfo->user_tel?></em></p>
				</div>
			</div>
			<div class="fd_descmain">
				<p>
                    <?if($shopModel->sb_sellorrent ==1){?>
					<span class="fd_01">月租：<em><?=$shopModel->rentInfo->sr_monthrentprice?></em>元
                        （
                           <?if($shopModel->rentInfo->sr_paytype){
                               $arr=array('0'=>"零",'1'=>"一",'2'=>"而",'3'=>"三",'6'=>"六",'12'=>"十二");
                               $pay=explode(",",$shopModel->rentInfo->sr_paytype);
                               echo "付".$arr[$pay[0]]."押".$arr[$pay[1]];
                           }else{
                               echo"面议";
                           }?>
                        ）</span>
                    <?}else if($shopModel->sb_sellorrent ==2){?>
                        <span class="fd_01">总价：<em><?=$shopModel->sellInfo->ss_sumprice?></em>万元</span>
                    <?}?>
					<span class="fd_01">面积：<em><?=$shopModel->sb_shoparea ?></em>㎡<?=$shopModel->sb_cancut?"（可分割）":"" ?></span>
				</p>
				<p>
                    <?if($shopModel->sb_sellorrent ==1&&$shopModel->rentInfo->sr_renttype==2){?>
					<span class="fd_01">转让费：
                           <?
                           if($shopModel->rentInfo->sr_transferprice>0){
                               echo "<em>{$shopModel->rentInfo->sr_transferprice}</em>万";
                           }else if($shopModel->rentInfo->sr_transferprice=="0"){
                               echo "无";
                           }else{
                                echo "面议";
                           }

                    ?></span>
                    <?}else if($shopModel->sb_sellorrent ==1&&$shopModel->rentInfo->sr_renttype==1){?>
                    <span class="fd_01">日租：<em><?=round($shopModel->rentInfo->sr_rentprice,1)?></em>元/㎡·日</span>
                    <?}elseif($shopModel->sb_sellorrent ==2){?>
                    <span class="fd_01">单价：<em><?=$shopModel->sellInfo->ss_avgprice ?></em>元/㎡</span>
                    <?}?>
					<span class="fd_01">物业费用：<?=$shopModel->sb_propertycost?$shopModel->sb_propertycost."元/月":"未提供"?> </span>
				</p>
				<p>
					<span class="fd_02">地址：<?=$shopModel->sb_shopaddress ?></span>
				</p>
				<p>
					<span class="fd_01">类型：<?=Shopbaseinfo::$sb_shoptype[$shopModel->sb_shoptype]?></span>
					<span class="fd_01">楼层：<?php 
					if($shopModel->sb_floor){
						$floor=explode(",",$shopModel->sb_floor);
						if($floor[0]==1)echo "第".$floor[1]."层";
						else if($floor[0]==2)echo "第".$floor[1]."-".$floor[2]."层";
						else if($floor[0]==3)echo "共".$floor[1]."层";
					}else{
						echo "未提供";
					}
					?></span>
				</p>
				<p>
					<span class="fd_01">推荐经营：<?=$shopModel->sb_businesstype!=3&&$shopModel->sb_recommendtrade?Shopbaseinfo::$sb_profession[$shopModel->sb_recommendtrade]:"未提供"?></span>
					<span class="fd_01">发布时间：<?=date("Y-m-d H:i:s",$shopModel->sb_releasedate)?></span>
				</p>
			</div>
		</div>
		<div class="swright" style="height: 317px;">
            <?php
                if(Panoxml::model()->checkHavePano($shopModel->sb_shopid, 4)){
                    $this->widget("PanoView",array("mainXml"=>Panoxml::model()->getPanoXml($shopModel->sb_shopid, 4),"width"=>"500px","height"=>"317px"));
                }elseif(Picture::model()->count(array('condition'=>'p_sourcetype=5 AND p_sourceid='.$shopModel->sb_shopid))){?>
                  <iframe width="500px;" height="310px" frameborder="0" scrolling="no" src="<?php echo $this->createUrl('shop/piclist',array('id'=>$shopModel->sb_shopid)) ?>"></iframe>
               <?}else{
                    echo '<img src="/images/default/default_loupan.jpg">';
                }?>
           
        </div>
	</div>
<a name="manview"></a>

	<div class="dlmain">
		<div class="dlleft">
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">房源描述</a></li>
				</ul>
               
			</div>
			<div class="sp_det_msg"><?=$shopModel->presentInfo->sp_shopdesc ?> </div>
            <?if($pictures){?>
            <div class="dlmtit">
				<ul>
					<li class="clk"><a href="">房源实景</a></li>
				</ul>
			</div>
			<div class="lpline">
                <?php
				 foreach($pictures as $pc){
					$picUrl=PIC_URL.Picture::showStandPic($pc->p_img,"_large");
			          ?>
					<div class="spmod">
                        <a href="<?php echo PIC_URL.$pc->p_img ?>" rel="fancybox_group"><img alt="" title="<?php echo Picture::$typeDescription[$pc->p_type] ?>" src="<?php echo $picUrl ?>" /></a>
						<p><?php echo $pc->p_title ?></p>
					</div>
                <?php } ?>
              </div>
            <? }?>
            <? if(@$likeShop=$shopModel->getLikeBuild()){
            ?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">相关商铺</a></li>
				</ul>
			</div>
			<div class="gzlou">
                <?php  foreach($likeShop as $val){?>
				<div class="spmodel">
                    <a href="<?=Yii::app()->createUrl("shop/view",array("id"=>$val->sb_shopid))?>">
                        <img src="<?=Picture::model()->getPicByTitleInt($val->presentInfo->sp_titlepicurl,"_large")?>">
                    </a>
                    <p><a title="<?=$val->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$val->sb_shopid))?>"><?=common::strCut($val->presentInfo->sp_shoptitle, 21)?></a></p>
					<p><em><?=$val->sb_sellorrent==2?$val->sellInfo->ss_avgprice:$val->rentInfo->sr_rentprice?></em><?=$val->sb_sellorrent==2?"元/㎡":"元/平㎡天"?></p>
                    <p><?=$val->sb_shopaddress?></p>
                </div>
                <? }?>
			</div>
		</div>
        <?}?>
		<div class="dlright">

		</div>
	</div>
<div id="albumform" style="display: none">
    <form method="post">
    <table width="300px">
        <tr>
            <td colspan="2" align="center"><input type="radio" checked="checked" value="1" name="loginType">普通用户登录<input type="radio" value="2" name="loginType">经纪人登录</td>
            <td>&nbsp;</td>
        </tr>
        <tr style="line-height: 35px;">
            <td width="60px">用户名：</td>
            <td align="left" width="180px"><input  type="text" style="border: 1px solid #D7D5D6;" id="LoginForm_username" name="LoginForm[username]" /></td>
            <td><a href="/site/personregister">注册</a></td>
        </tr>
        <tr>
            <td valign="top">密码：</td>
            <td align="left"><input type="password" style="border: 1px solid #D7D5D6" id="LoginForm_password"name="LoginForm[password]"></td>
            <td><a href="/site/findpwd">忘记密码？</a></td>
        </tr>
    </table>
</form></div>
<script type="text/javascript">


$(document).ready(function() {
    $("a[rel=fancybox_group]").fancybox({
        'transitionIn': 'none',
        'transitionOut': 'none',
        'titlePosition': 'over',
        'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
            return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
        }
    });
})
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
        var pkurl = "/systembuildinginfo/compare";
        location.href=pkurl+'?pk='+pkids.join("|");
    }
    function addCommentLog(id,obj){
        var chec = 1;
        if(chec){
            createAlbum();
            return false;
        }
        $.ajax({
            type:"post",
            url:"/systembuildinginfo/addcommentlog",
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
                     var url="/site/login"
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
                        url="/site/agentlogin";
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