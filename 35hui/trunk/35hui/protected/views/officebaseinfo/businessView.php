<div>
    <!----------------------------------------------------------------------------------------------------------------->
    <!--商务中心精选开始-->
    <table width="720px" border="0" cellspacing="4" cellpadding="0">
        <tr>
            <td width="190" rowspan="4" valign="top"><a href="#"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/007.jpg" border="0" /></a> </td>
            <td colspan="2"  align="left"><?php echo CHtml::link(($data->op_traffice),array('/officebaseinfo/businessSummarize','opid'=>$data->op_id));?></td>
            <td width="50" rowspan="4">地图</td>
        </tr>
        <tr>
            <td colspan="2" align="left"><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>">RMB:联系我们</a></td>
        </tr>
        <tr>
            <td colspan="2" align="left"><?php echo CHtml::link($data->op_officedesc,array('/officebaseinfo/businessSummarize','opid'=>$data->op_id)); ?> </td>
        </tr>
        <tr>
            <td width="202" align="right"><?php echo CHtml::link('GOOGLE地图');?>|<?php echo CHtml::link('图片',array('/officebaseinfo/businessSummarize','opid'=>$data->op_id));?> </td>
            <td width="218"  align="right"><?php echo CHtml::link('要求参观办公室');?> </td>
        </tr>
    </table>
    <hr style="border:1px dashed #cccccc; height:1px" width="720px"/>
    <!--商务中心精选结束-->
    <!----------------------------------------------------------------------------------------------------------------->
</div>        
