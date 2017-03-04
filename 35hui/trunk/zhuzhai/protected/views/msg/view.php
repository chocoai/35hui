<?php
$this->temp=$menu;
if(Yii::app()->user->id == $model->msg_revid){
    $this->breadcrumbs=array(
        "我的新地标"=>array('/site/userindex'),
        '收件箱'=>array("/msg/receiveBoxIndex",'menu'=>$menu),
        '消息内容'
    );
}else{
    $this->breadcrumbs=array(
        "我的新地标"=>array('/site/userindex'),
        '发件箱'=>array("/msg/sendBoxIndex",'menu'=>$menu),
        '消息内容'
    );
}
?>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">消息内容</div>
    <div class="manage_rightboxthree">
        <table style="width:100%;table-layout:fixed;" class="manage_tabletwo">
        <!-- 收件 -->
        <?php if(Yii::app()->user->id == $model->msg_revid){?>
            <tr>
                <td width="20%">来自：</td>
                <td style="text-align: left"><?=$model->msg_sendid==0?"客服管理员":CHtml::encode(User::model()->getNamebyid($model->msg_sendid));?></td>
            </tr>
            <tr>
                <td>时间:</td>
                <td style="text-align: left"><?=common::showFormatDateTime($model->msg_time);?></td>
            </tr>
            <tr>
                <td>话题：</td>
                <td style="text-align: left"><?php echo CHtml::encode($model->msg_title);?></td>
            </tr>
            <tr>
                <td>内容：</td>
                <td style="text-align: left;word-break:break-all;word-wrap: break-word"><?php echo CHtml::encode($model->msg_content);?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td style="text-align:left;">
                    <input type="button" onclick="checkUser();" value="回复此邮件"/>
                </td>
            </tr>
        <!-- 发件 -->
        <?php }elseif(Yii::app()->user->id == $model->msg_sendid){?>
            <tr>
                <td width="20%">发往：</td>
                <td style="text-align: left"><?=$model->msg_revid==0?"客服管理员":User::model()->getNamebyid($model->msg_revid);?></td>
            </tr>
            <tr>
                <td>时间:</td>
                <td style="text-align: left"><?php echo date('Y-m-d H:i:s',$model->msg_time);?></td>
            </tr>
            <tr>
                <td>话题：</td>
                <td style="text-align: left"><?php echo CHtml::encode($model->msg_title);?></td>
            </tr>
            <tr>
                <td>内容：</td>
                <td style="text-align: left;word-break:break-all;word-wrap: break-word"><?php echo CHtml::encode($model->msg_content);?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
    <div class="manage_righttwoline"></div>
</div>
<?php if(Yii::app()->user->id == $model->msg_revid){ ?>
<script type="text/javascript" src="<?= Yii::app()->request->baseUrl; ?>/js/magicDiv.js"></script>
<?php echo $this->renderPartial('/msg/_form', array('toUserId' => $model->msg_sendid,'x'=>800,'y'=>350,'subject'=>'R：'.CHtml::encode($model->msg_title))); ?>
<?php } ?>