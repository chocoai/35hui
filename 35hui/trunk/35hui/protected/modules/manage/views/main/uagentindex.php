<?php
$this->breadcrumbs=array("管理首页");?>
<?php if($notice){ ?>
<div class="msg">
    <p><font color="red"><?=date("Y-m-d",$notice->post_time)."&nbsp;&nbsp;&nbsp;&nbsp;".$notice->post_title?></font></p>
    <p>　　<?=$notice->post_content?></p>
    <p><?=CHtml::link("查看更多>>",array('/manage/msg/gonggao'),array("style"=>"color:blue"))?></p>
</div>
    <?php } ?>
<div class="inmsg">
    <div class="inleft">
        <?php
        $userid = Yii::app()->user->id;
        $model=User::model()->findByPk($userid);
        $umodel = $model->agentinfo;
        if(!$umodel)
            $umodel=new Uagent();
        echo CHtml::link(CHtml::image(User::model()->getUserHeadPic($userid, "_large"),Yii::app()->user->name,array('height'=>'130px','width'=>'100px')),array("/manage/user/changehead"));
        ?>
    </div>
    <div class="inright">
        <div class="iname">欢迎<?php echo User::model()->getUserShowLink($userid,true) ?>，
            <?php echo CHtml::link('站内信['.($noRead?"<em style='color:red'>".$noRead."</em>":0).']',array("/manage/msg/receivebox"));
            echo CHtml::link('修改头像',array("/manage/user/changehead"));
            echo CHtml::link('查看店铺',array("/uagent/index",'id'=>$umodel->ua_id),array('target'=>'_blank'));
            echo CHtml::link('全景指导',array("/help/qjdevice"),array('target'=>'_blank'));

            ?>
        </div>
        <div class="inline">
            <span class="in_01">我的认证：<?php
                //身份认证
                if(Uagent::model()->getIdentityCertification(Yii::app()->user->id)){
                    echo CHtml::image(IMAGE_URL."/icon/sf.gif","已通过身份证实名验证",array("title"=>"已通过身份证实名验证"));
                }else {
                    echo CHtml::link(CHtml::image(IMAGE_URL."/icon/sf_gray.gif","未认证",array("title"=>"身份未认证"))."&nbsp;&nbsp;申请",array("/manage/user/shenfen"),array("style"=>"color:blue"));
                }
                //名片认证
                if(Uagent::model()->getSeniorityCertification(Yii::app()->user->id)){
                    echo CHtml::image(IMAGE_URL."/icon/zy.gif","已提交经纪人证书",array("title"=>"已提交经纪人证书"));
                }else{
                    echo CHtml::link(CHtml::image(IMAGE_URL."/icon/zy_gray.gif","未认证",array("title"=>"名片未认证"))."&nbsp;&nbsp;申请",array("/manage/user/mingpian"),array("style"=>"color:blue"));
                }
                ?>
            </span>
            <span class="in_01">主营物业：<?php echo Yii::app()->user->getState('mainbusinessname','写字楼'),' ',CHtml::link('修改',array("/manage/user/index")) ?></span>
        </div>
        <div class="inline">
            <span class="in_01">积分等级：<?=CHtml::link(User::model()->getUserLevelByUserId($userid),array("/manage/manage/viewIntegral"),array("style"=>"color:blue",
                "onclick"=>'parent.$("#leftmenu p").removeClass("clk");parent.$("#viewIntegral").parent("p").addClass("clk");'))?></span>
            <span class="in_01">推广方案：<?php
            $icon = Uagent::model()->getAgentComboIconUrl($umodel);
            if($icon){
               echo CHtml::link($icon,array("/manage/buycombo/index"),array("onclick"=>'parent.$("#leftmenu p").removeClass("clk");parent.$("#combo").parent("p").addClass("clk");'));
               echo "&nbsp;&nbsp;".date("Y-m-d",$umodel->ua_combotime)."到期";
            }else{
                echo "未购买".CHtml::link('查看',array("/manage/buycombo"),array("onclick"=>'parent.$("#leftmenu p").removeClass("clk");parent.$("#combo").parent("p").addClass("clk");'));
            }?></span>
        </div>
        <div class="inline">
            <span class="in_01">公司门店：<?php echo $umodel->ua_company ?></span>
            <span class="in_01">区域板块：<?=Region::model()->getNameById($umodel->ua_district)?>-<?=Region::model()->getNameById($umodel->ua_section)?> <?php echo CHtml::link('修改资料',array("/manage/user/index")) ?></span>
        </div>
        <div class="inline">
            <span class="in_01">注册时间：<?php echo date('Y-m-d',$model->user_regtime) ?></span><span class="in_01">上次登录：<?php echo date('Y-m-d',$model->user_lasttime) ?></span>
        </div>
        <div class="inline">
            <span class="in_01">业主委托：<?php echo CHtml::link(Quickrelease::model()->count(),array('quickrelease/index')); ?> 条</span>
            <span class='in_01'><?php echo Uagent::model()->getMangeUserById($userid)?"专属客服：".Uagent::model()->getMangeUserById($userid):"" ?></span>
       
        </div>
    </div>
</div>
<div class="htit">我发布的信息</div>
<?php
$allNum2=Uagent::model()->getAllOperateNum($userid, 2);
$allNum1=Uagent::model()->getAllOperateNum($userid, 1);
$allNum3=Uagent::model()->getAllOperateNum($userid, 3);
?>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td class="itit">类型</td>
            <td class="itit">已录入房源数<br />
					  (可录入<em><?php echo $allNum2;?></em>条)</td>
            <td class="itit">已发布房源数<br />
					  (可发布<em><?php echo $allNum1;?></em>条)</td>
            <td class="itit">本日已刷新数<br />
					  (可刷新<em><?php echo $allNum3;?></em>条)</td>
        </tr>
        <tr>
            <td class="txt">写字楼</td>
            <td class="txt"><?PHP
                $nowNum2=Uagent::model()->getNowOperateNum($userid, 2);

                if($nowNum2>=$allNum2) {
                    echo $nowNum2.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum2;
                }?></td>
            <td class="txt"><?php
                $nowNum1=Uagent::model()->getNowOperateNum($userid, 1);
                if($nowNum1>=$allNum1) {
                    echo $nowNum1.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum1;
                }
                ?></td>
            <td class="txt"><?php
                $nowNum3=Uagent::model()->getNowOperateNum($userid, 3);
                if($nowNum3>=$allNum3) {
                    echo $nowNum3.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum3;
                }
                ?></td>
        </tr>
        <tr>
            <td class="txt">商铺</td>
            <td class="txt"><?php
                $nowNum22=Uagent::model()->getNowOperateNum($userid, 2, 2);
                if($nowNum22>=$allNum2) {
                    echo $nowNum22.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum22;
                }?>
            </td>
            <td class="txt"><?php
                $nowNum12=Uagent::model()->getNowOperateNum($userid, 1, 2);
                if($nowNum12>=$allNum1) {
                    echo $nowNum12.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum12;
                }?>
            </td>
            <td class="txt"><?php
                $nowNum32=Uagent::model()->getNowOperateNum($userid, 3, 2);
                if($nowNum32>=$allNum3) {
                    echo $nowNum32.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum32;
                }?>
            </td>
        </tr>
        <tr>
            <td class="txt">住宅</td>
            <td class="txt"><?php
                $nowNum22=Uagent::model()->getNowOperateNum($userid, 2, 3);
                if($nowNum22>=$allNum2) {
                    echo $nowNum22.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum22;
                }?>
            </td>
            <td class="txt"><?php
                $nowNum12=Uagent::model()->getNowOperateNum($userid, 1, 3);
                if($nowNum12>=$allNum1) {
                    echo $nowNum12.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum12;
                }?>
            </td>
            <td class="txt"><?php
                $nowNum32=Uagent::model()->getNowOperateNum($userid, 3, 3);
                if($nowNum32>=$allNum3) {
                    echo $nowNum32.'（<font color="red">已达上限</font>）';
                }else {
                    echo $nowNum32;
                }?>
            </td>
        </tr>
    </table>
</div>
<div class="intit"><span><?=CHtml::link("更多记录>>",array("/manage/manage/viewIntegral"),array("style"=>"color:blue"))?></span><strong>积分记录</strong> （<?=CHtml::link("如何获取？",array("/help/money"),array("target"=>"_blank"))?>）</div>
<div class="rgcont">
    <?php if($pointLogs){ ?>
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="24%" class="tit">日期</td>
            <td width="36%" class="tit">明细</td>
            <td width="40%" class="tit">说明</td>
        </tr>
            <?php foreach($pointLogs as $value){ ?>
        <tr>
            <td width="24%"><?php echo date("Y-m-d H:i",$value->lg_recodetime) ?></td>
            <td width="36%"><em><?php echo $value->lg_score ?></em></td>
            <td width="40%"><?php echo $value->lg_description ?></td>
        </tr><?php } ?>
    </table><?php }else{ ?>
    <p>没有记录</p>
        <?php } ?>
</div>