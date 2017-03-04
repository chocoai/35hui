<?php
if(Yii::app()->user->id == $model->msg_revid){
    $this->breadcrumbs=array('收件箱','消息内容');
}else{
    $this->breadcrumbs=array('发件箱','消息内容');
}
?>
<style type="text/css">
    .txtlou a{color:blue}
</style>
<div class="htit">消息详细</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <!-- 收件 -->
        <?php if(Yii::app()->user->id == $model->msg_revid){?>
            <tr>
                <td width="14%" class="tit">来自：</td>
                <td class="txtlou"><?=$model->msg_sendid==0?"客服管理员":CHtml::encode(User::model()->getNamebyid($model->msg_sendid));?></td>
            </tr>
            <tr>
                <td class="tit">时间：</td>
                <td class="txtlou"><?=common::showFormatDateTime($model->msg_time);?></td>
            </tr>
            <tr>
                <td class="tit">标题：</td>
                <td class="txtlou"><?php echo CHtml::encode($model->msg_title);?></td>
            </tr>
            <tr>
                <td class="tit">内容：</td>
                <td class="txtlou">
                <?php 
                echo $model->msg_content;
                $search = stripos($model->msg_content,"写字楼房源ID:");
                if($search!== false){
                    $id = substr($model->msg_content, $search+strlen("写字楼房源ID:"),-1);
                    echo "&nbsp;&nbsp;".CHtml::link("查看详细",array("subpanorama/index","id"=>$id,"type"=>1),array("style"=>"color:blue"));
                }
                ?>
                </td>
            </tr>
            <tr>
                <td class="tit">&nbsp;</td>
                <td class="txtlou">
                    <input type="button" onclick="huifu();" value="回复此邮件"/>
                </td>
            </tr>
        <!-- 发件 -->
        <?php }elseif(Yii::app()->user->id == $model->msg_sendid){?>
            <tr>
                <td width="14%" class="tit">发往：</td>
                <td class="txtlou"><?=$model->msg_revid==0?"客服管理员":User::model()->getNamebyid($model->msg_revid);?></td>
            </tr>
            <tr>
                <td class="tit">时间：</td>
                <td class="txtlou"><?php echo date('Y-m-d H:i:s',$model->msg_time);?></td>
            </tr>
            <tr>
                <td class="tit">标题：</td>
                <td class="txtlou"><?php echo CHtml::encode($model->msg_title);?></td>
            </tr>
            <tr>
                <td class="tit">内容：</td>
                <td class="txtlou"><?php echo CHtml::encode($model->msg_content);?></td>
            </tr>
        <?php } ?>
        
    </table>
</div>
<script type="text/javascript">
function huifu(){
    var url = "<?php echo Yii::app()->createUrl('/manage/msg/huifu',array("id"=>$model->msg_id));?>";
    window.location.href = url;
}
</script>

