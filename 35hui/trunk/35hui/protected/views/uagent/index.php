<?php
$ua_city = Region::model()->getNameById($model->ua_city);
$ua_district = Region::model()->getNameById($model->ua_district);
$ua_section = Region::model()->getNameById($model->ua_section);
$ua_name=$model->ua_realname;
$description=$ua_name.'的网上店铺为您提供最新的'.$ua_district.$ua_section.'房产信息，专业房产经纪人为您竭诚服务。';
Yii::app()->clientScript->registerMetaTag('','keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $ua_city.$ua_district.$ua_section.$ua_name.'的网店-新地标';
?>
    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<em><?php echo CHtml::encode($model->ua_realname); ?></em></div>
		<div class="rtspace">浏览次数：<?php echo $model->ua_visitnum ?></div>
	</div>
	<div class="jjr_detail">
		<div class="j_header">
            <?php echo CHtml::image(User::model()->getUserHeadPic($_userModel->user_id, "_large"),$model->ua_realname);?>
       </div>
		<div class="j_detail">
			<h3><em><?php echo CHtml::encode($model->ua_realname); ?></em>
            <?php echo User::model()->getUserLevelByUserId($_userModel->user_id),' ';
            if($model->ua_combo) echo Uagent::model()->getAgentComboIconUrl($model);
            ?>
            </h3>
			<p><strong>工作年限：</strong><?php echo $model->ua_congyeyear?(date('Y')-$model->ua_congyeyear).'年工作经验':'暂无资料' ?></p>
			<p><strong>所属公司：</strong>
            <?php echo CHtml::encode($model->ua_company); ?></p>
			<p><strong>简介：</strong>
                <?php echo common::strCut(CHtml::encode($model->ua_post), 186, '... <a href="javascript:;" onclick="$(this).parent().hide().next().show()">查看详细&gt;&gt;</a>'); ?>
            </p>
 <?php if(strlen($model->ua_post)){ ?>
            <p style="display: none"><strong>简介：</strong><?php echo CHtml::encode($model->ua_post); ?>
            <a href="javascript:;" onclick="$(this).parent().hide().prev().show()">收起&lt;&lt;</a>
            </p>
 <?php } ?>
		</div>
		<div class="j_desc">
			<h4><?php echo CHtml::encode($_userModel->user_tel);?></h4>
            <p>您好！我是<?php echo CHtml::encode($model->ua_realname); ?>，竭诚为您服务！</p>
			<div class="j_xun">
                <?php echo $medalstr ?>
			</div>
		</div>
	</div>
	<div class="dlmain">

		<div class="dlleft">
    <?if($model->ua_source){?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">经纪人资历</a></li>
				</ul>
			</div>
			<div class="jjr_fen">
				<div class="jjr_lfen"><p><em><?php echo CHtml::encode($model->ua_source); ?>分</em></p><p>综合排名：</p>
                    <p><?=Uagent::model()->formatUserOrder($model->ua_ordernew)?></p>
                </div>
				<div class="jjr_mfen">
                    <?php
                    $data = Exam::model()->getChartInfo($_userModel->user_id);
                    echo CHtml::image($this->createUrl('chart/radar',array('data'=>$data,'size'=>'240x160')));
                    ?>
                </div>
				<div class="jjr_rfen">
                <?php
                foreach(explode(',', $data) as $k=>$v){
                    echo '<p>',($k+1),'、';
                    echo Examdescribe::model()->getDescribtionByPointAndType($k+1, $v);
                    echo '</p>';
                } ?>
				</div>
			</div>
            <?}
			
 ?>
			   <?php
         if($_userModel->user_mainbusiness==2){
                if(Shopbaseinfo::model()->count("sb_check=4 and sb_uid =".$_userModel->user_id)){
                     $this->renderPartial('_shoplist', array('_userModel'=>$_userModel));
                }
                if($allNumes){
                    $this->renderPartial('_officelist', array('_userModel'=>$_userModel,"pieDate"=>$pieDate,"allNumes"=>$allNumes));
                }
               
         }else{
                if($allNumes){
                    $this->renderPartial('_officelist', array('_userModel'=>$_userModel,"pieDate"=>$pieDate,"allNumes"=>$allNumes));
                }
                if(Shopbaseinfo::model()->count("sb_check=4 and sb_uid =".$_userModel->user_id)){
                     $this->renderPartial('_shoplist', array('_userModel'=>$_userModel));
                }
         }

        ?>
<?
$sucInfo = Successinfo::model()->getRecentInfo($_userModel->user_id,5);
if($sucInfo){
?>
			<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">成功案例</a></li>
				</ul>
			</div>
			<div class="jjr_fen">
                <table cellspacing="0" cellpadding="0" border="0" class="table_01" id="infotable">
					<tr>
						<td class="titl">成交时间</td>
                        <td class="titl">公司名称</td>
                        <td class="titl">写字楼</td>
                        <td class="titl">位置</td>
                        <td class="titl">面积</td>
                    </tr>
<?php
foreach($sucInfo as $info){
?>
                    <tr>
                        <td class="txt"><?php echo date('Y-m-d',$info->si_successtime) ?></td>
                        <td class="txt"><?php echo CHtml::encode($info->si_companyname) ?></td>
                        <td class="txt"><?php echo CHtml::link($info->si_buildname,array('/systembuildinginfo/view','id'=>$info->si_buildid)) ?></td>
                        <td class="txt"><?php echo CHtml::encode(Successinfo::$si_floortype[$info->si_floortype]) ?></td>
                        <td class="txt"><?php echo CHtml::encode($info->si_area) ?>平米</td>
                    </tr>
<?php } ?>
                </table>
			</div>
            <div class="gemore" style="border:0px">
                <span style="display:block;" have="<?php echo count($sucInfo); ?>" onclick="readMore(this)">查看更多</span>
            </div>
<?php } ?>
<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">主营楼盘</a></li>
				</ul>
			</div>
<?php
if($model->ua_mainbuilds){
    $mainids = array();
    foreach(unserialize($model->ua_mainbuilds) as $val){
        $mainids[] = $val['id'];
    }
    $sql = 'SELECT t1.sbi_buildingid,t1.sbi_buildingname,t1.sbi_address,t2.p_img,t1.sbi_avgrentprice,t1.sbi_titlepic
        FROM {{systembuildinginfo}} t1 LEFT JOIN {{picture}} t2 ON t1.sbi_titlepic=t2.p_id
        WHERE t1.sbi_buildingid IN('.implode(',', $mainids).')';
    $mainbuilds = Yii::app()->db->createCommand($sql)->queryAll();

?>
			<div class="gzlou mg_10">
<?php
foreach($mainbuilds as $v) {
?>
                <div class="gzmodel">
                    <a href="<?php echo $this->createUrl('systembuildinginfo/view',array('id'=>$v['sbi_buildingid'])) ?>">
                    <img src="<?=Picture::model()->getPicByTitleInt($v['sbi_titlepic'],"_normal");?>" alt="" width="115" height="148">
                    </a>
                    <p><?php echo CHtml::link($v['sbi_buildingname'],array('/systembuildinginfo/view','id'=>$v['sbi_buildingid'])) ?></p>
                    <p><em><?php echo CHtml::encode($v['sbi_avgrentprice']) ?>元/平米.天</em></p>
                    <p><?php echo CHtml::encode($v['sbi_address']) ?></p>
                </div>
<?php } ?>
			</div>
<?php
}?>
		</div>
		<div class="dlright">
			<div class="jjr_anser">
				<h3>电话投诉</h3>
				<p>对经纪人服务不满意？请拨打投诉热线</p>
				<p><em>400-820-9181</em></p>
				<p>服务时间：8：00-20：00 周一至周日</p>
			</div>
		</div>
	</div>
<?php if($sucInfo){?>
<script type="text/javascript">
function readMore(Obj){
    var offset = $("#infotable tr").length-1;
    if($(Obj).attr('have')=='all'){
        alert('已经是全部案例了');
        return false;
    }
    $.get('/uagent/moreinfo/uid/344',{'offset':offset,'limit':5},function(data){
        if(data){
            $("#infotable").append(data);
        }else{
            alert('已经是全部案例了');
            $(Obj).attr('have','all');
        }
    });
}
$(document).ready(function(){
    $(".gemore span").bind("click", function(){
            var obj = $(this);
            var userId = $(obj).attr("attr");
            if(typeof(userId)=="undefined"){
                var table = $(this).parent().prev(".tabcont").find("table");
                for(var i=5;i>0;i--){
                    if($(table).find("tr").length>6){
                        $(table).find("tr").last().remove();
                    }
                }
                if($(table).find("tr").length<=6){//点击收起按钮
                    $(obj).css("display","none");
                }
                var maxNum = $(obj).prev("span").attr("max");
                if(($(table).find("tr").length-1)<maxNum){//查看更多按钮
                    $(obj).prev("span").css("display","block");
                }
            }else{
                $(obj).css("display","none");
                var table = $(obj).parent().prev(".tabcont").find("table");
                var start = $(table).find("tr").length-1;
                var loading = "<tr><td class='txt' colspan='10'><img src='/images/loading.gif' /></td></tr>";
                var condition = ""
                table.append(loading);
                $.ajax({
                    url:"/uagent/ajaxgetofficesource",
                    type:"GET",
                    data:{"start":start,"saleOrRent":"2","userId":userId,"condition":condition},
                    success:function (msg){
                        $(table).find("tr").last().remove();
                        $(obj).next("span").css("display","block");
                        var msg = eval(msg);
                        for(var i=0;i<msg.length;i++){
                            var html = "<tr>";
                            html +='<td class="txt"><a href="'+msg[i].namelink+'" target="_blank">'+msg[i].name+'</a></td>';
                            html +='<td class="txt">'+msg[i].floortype+'</td>';
                            html +='<td class="txt">'+msg[i].officearea+'平米</td>';
                            html +='<td class="txt">'+msg[i].price+'</td>';
                            html +='<td class="txt">'+msg[i].propertyprice+'</td>';
                            html +='<td class="txt"><a href="'+msg[i].link+'" target="_blank">详细</a></td>';
                            html +='</tr>';
                            table.append(html);
                        }
                        var maxNum = $(obj).attr("max");
                        if(($(table).find("tr").length-1)<maxNum){
                            $(obj).css("display","block");
                        }
                    }
                })
            }
        });
})
</script>
<?php } ?>
