<?php $this->breadcrumbs=array("管理首页");?>
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
        echo CHtml::image(User::model()->getUserHeadPic($userid, "_large"),Yii::app()->user->name,array('height'=>'130px','width'=>'100px'));
        ?>
    </div>
    <div class="inright">
        <div class="iname">欢迎<?php echo User::model()->getUserShowLink($userid,true) ?>，
            <?php echo CHtml::link('站内信[<font color="red">'.($noRead?$noRead:0).'</font>]',array("/manage/msg/receivebox"));
            echo CHtml::link('修改头像',array("/manage/user/changehead"));
            ?>
        </div>
        <div class="inline">
            <span class="in_01">我的积分：<?php echo Userproperty::model()->getUserPoint($userid),CHtml::link(" 如何获取？",array("/help/money"),array("target"=>"_blank"))?></span>
        </div>
        <div class="inline">
            <span class="in_01">注册时间：<?php echo date('Y-m-d',$model->user_regtime) ?></span><span class="in_01">上次登录：<?php echo date('Y-m-d',$model->user_lasttime) ?></span>
        </div>
    </div>
</div>
<div class="htit">Log记录</div>
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
<div class="intit"><span><?=CHtml::link("更多记录>>",array("/manage/manage/viewMoney"))?></span><strong>新币币记录</strong> （<?=CHtml::link("如何获取？",array("/help/money"),array("target"=>"_blank"))?>）</div>
<div class="rgcont">
    <?php if($moneyLogs){ ?>
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="24%" class="tit">日期</td>
            <td width="36%" class="tit">明细</td>
            <td width="40%" class="tit">说明</td>
        </tr>
            <?php foreach($moneyLogs as $value){ ?>
        <tr>
            <td width="24%"><?php echo date("Y-m-d H:i",$value->lg_recodetime) ?></td>
            <td width="36%"><em><?php echo $value->lg_score ?></em></td>
            <td width="40%"><?php echo $value->lg_description ?></td>
        </tr><?php } ?>
    </table><?php }else{ ?>
    <p>没有记录</p>
        <?php } ?>
</div>