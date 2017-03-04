<?php
$this->breadcrumbs=array(
    '店铺展示设置',
	'店铺公告',
);
?>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">更新店铺公告</div>
    <div class="manage_rightboxthree">
        <?php echo CHtml::beginForm('','post'); ?>
            <table class="manage_tabletwo" width="100%" border="0" cellpadding="5" cellspacing="5">
                <tr>
                    <td style="text-align: center;" valign="top"><?php echo CHtml::activeLabelEx($model,'ua_post'); ?>：</td>
                    <td style="text-align: left">
                        <?php echo CHtml::activeTextArea($model,'ua_post',array("rows"=>12,"cols"=>80)); ?>
                        <?php echo CHtml::error($model,'ua_post'); ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td style="text-align: left">
                        <?php echo CHtml::submitButton('发布公告',array("class"=>"manage_input_button")); ?>
                    </td>
                </tr>
            </table>
        <?php echo CHtml::endForm(); ?>
    </div>
    <div class="manage_righttwoline"></div>
</div>