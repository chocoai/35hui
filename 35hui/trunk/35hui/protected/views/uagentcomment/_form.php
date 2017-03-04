<?php if(isset($ifAllowComment) && !$ifAllowComment) {
    echo "您不是个人用户，不能进行评价！";
}else {
    echo CHtml::beginForm();
    ?>
<table border="0" cellpadding="0" cellspacing="0" width="720">
    <tbody>
        <tr>
            <td align="right" width="80">评价等级&nbsp;<font style="color:red">*</font>&nbsp;：</td>
            <td width="630px">
                <table border="0" cellpadding="0" cellspacing="0" width="630px">
                    <tr>
                        <td width="65px">房源质量</td>
                        <td width="150px" align="left">
                                <?php $this->widget('CStarRating',array(
                                    'model'=>$model,
                                    'attribute'=>'uac_quality',
                                    'allowEmpty' => false,
                                    'maxRating' => 100,
                                    'minRating' => 20,
                                    'ratingStepSize' => 20,
                                ));?>
                        </td>
                        <td width="50px">&nbsp;</td>
                        <td width="65px">服务质量</td>
                        <td width="120px" align="left">
                                <?php $this->widget('CStarRating',array(
                                    'model'=>$model,
                                    'attribute'=>'uac_service',
                                    'allowEmpty' => false,
                                    'maxRating' => 100,
                                    'minRating' => 20,
                                    'ratingStepSize' => 20,
                                ));?>
                        </td>
                        <td width="">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="right" valign="top" width="80">评论内容&nbsp;<font style="color:red">*</font>&nbsp;：</td>
            <td>
                    <?php echo CHtml::activeTextArea($model,'uac_comment',array('class'=>'f12px','id'=>'ucc_comment','size'=>60,'maxlength'=>200,'style'=>'width:600px','rows'=>5)); ?>
            </td>
        </tr>
        <tr><td></td><td align="left"><div><?php echo CHtml::errorSummary($model); ?></div></td></tr>
        <tr>
            <td></td>
            <td style="padding-top: 3px;">
                    <?php echo CHtml::submitButton('',array("class"=>"iptsubmit")); ?>
            </td>
        </tr>
    </tbody>
</table>
    <?php
    echo CHtml::endForm();
}?>