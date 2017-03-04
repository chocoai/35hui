<?php
$this->breadcrumbs=array('身份认证',);
$unAllCertificate=Oprationconfig::model()->getConfigByName("uagentOpration_unAllCertificate");
$AllCertificate=Oprationconfig::model()->getConfigByName("uagentOpration_AllCertificate");
$num=Oprationconfig::model()->getConfigByName('ua_identify_audit');
?>

<?php $this->renderPartial('_head'); ?>
<div class="msg">
    通过上传身份证以核实经纪人的身份信息，正确绑定后奖励<?=$num[1]?>点积分。如果提供了身份认证或名片认证， 每类房源可发布<?=$unAllCertificate[0]?>条,每天可刷新<?=$unAllCertificate[2]?>次,每类房源可录入总数为<?=$unAllCertificate[1]?>条，如果两种认证都提供了，对应的数量为：<?=$AllCertificate[0]?>，<?=$AllCertificate[2]?>，<?=$AllCertificate[1]?>。
</div>
<div class="certmain">
    <div class="certlf"style="border:none;">

        <?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data',"onSubmit"=>"return changeToImage()")); ?>
        <table class="table_01" style="width:300px">
            <?php
            if($uagent->ua_scardurl!=""&&$uagent->ua_scardaudit==1){//已经上传，并且审核通过
                $time = date('Y-m-d H:i',$uagent->ua_scardtime);
            ?>
            <tr>
                <td>
                    <img src="<?=Picture::showStandPic(PIC_URL.$uagent->ua_scardurl,"_large"); ?>" style="width:297px;height:210px;"/>
                </td>
            </tr>
            <tr>
                <td><?="已认证于 ".$time; ?></td>
            </tr>

            <?php
                }else if($uagent->ua_scardurl!=""&&$uagent->ua_scardaudit=="2"){//已上传，审核未通过
            ?>
            <tr>
                <td><img src="<?=Picture::showStandPic(PIC_URL.$uagent->ua_scardurl,"_large"); ?>" style="width:297px;height:210px;"/></td>
            </tr>
            <tr>
                <td><span class="errorMessage">未通过审核</span></td>
            </tr>
            <tr id="uploadButton">
                <td><?php echo CHtml::activeFileField($model, 'logo'); ?></td>
            </tr>
            <tr>
                <td>头像文件小于2M，格式为jpg, gif, png<?php echo CHtml::error($model,'logo'); ?></td>
            </tr>
            <tr id="submitButton">
                <td align="center"><?php echo CHtml::submitButton('重新上传'); ?></td>
            </tr>
            <?php
                }else if($uagent->ua_scardurl!=""&&$uagent->ua_scardaudit=="0"){//未审核
            ?>
            <tr>
                <td>
                    <img src="<?=Picture::showStandPic(PIC_URL.$uagent->ua_scardurl,"_large"); ?>" style="width:297px;height:210px;" />
                </td>
            </tr>
            <tr>
                <td>未审核，审核过程将在2-3天内完成，请等待！</td>
            </tr>
            <?php
                }else{
            ?>
            <tr id="uploadButton">
                <td><?php echo CHtml::activeFileField($model, 'logo'); ?></td>
            </tr>
            <tr>
                <td>头像文件小于2M，格式为jpg, gif, png<?php echo CHtml::error($model,'logo'); ?></td>
            </tr>
            <tr id="submitButton">
                <td align="center"><?php echo CHtml::submitButton('上传'); ?></td>
            </tr>
            <?php
                }
            ?>
            <tr id="uploadPicLoad" style="display: none">
                <td><font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' /></td>
            </tr>
        </table>
        <?php echo CHtml::endForm(); ?>

    </div>
    <div class="certlf" >
        <p><strong class="red">合格身份证案例：</strong></p>
        <p>合格身份证要求</p>
        <p>1、确保身份证上的内容清晰可见</p>
        <p>2、确保身份证号码和注册时的身份证号码一致</p>
        <p>3、文件格式仅限jpg、gif、png文件，小于2M</p>
        <div class="certpic"><img src="/images/mc/sfz.png" /></div>
    </div>
</div>
<script type="text/javascript">
    function changeToImage(){
        $("#uploadPicLoad").css("display", "");
        $("#uploadButton").css("display", "none");//隐藏选择文件按钮
        $("#submitButton").css("display", "none");//隐藏上传按钮
    }
</script>