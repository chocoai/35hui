<?php
$this->breadcrumbs=array(
        'Attachments'=>array('index'),
        $model->id,
);
$this->currentMenu = 89;

$this->menu=array(
        array('label'=>'附件列表', 'url'=>array('index')),
        array('label'=>'下载查看', 'url'=>array('download', 'id'=>$model->id),'linkOptions'=>array('target'=>'_blank')),
        array('label'=>'不通过删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'确定删除本条记录？')),
        array('label'=>'审核通过', 'url'=>'javascript:showtip()'),
);
?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<h1>View Attachment #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
                'id',
                'buid_type',
                'buid_id',
                'att_type',
                'up_uid',
                'path',
                'isuse',
                'downloads',
                'money',
                'time'=>array(
                        'name'=>'上传时间',
                        'value'=>date('Y-m-d H:i', $model->time),
                ),
        ),
)); ?>

<div style="display:none;position: fixed;width: 240px;height: 150px;border: 1px solid #860001;padding: 5px;background-color:#EFEFEF;" id="showTip">
    <form action="/attachment/checked" method="post" >
        <input type="hidden" name="id" value="<?=$model->id ?>" />

        <div style="float:right"><img onClick="closetip('showTip')" src="http://my35mag.huihenet.com/images/3.gif"/></div>
        <table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo" style="margin-top:20px">
            <tr>
                <td>
                    下载扣除的商务币数量：<?php echo CHtml::textField('downloadmoney',10,array('size'=>4,'maxlength'=>3));?>
                </td>
            </tr>
            <tr>
                <td>
                    赠送上传者的商务币：<?php echo CHtml::textField('remoney','0',array('size'=>4,'maxlength'=>3));?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="确定"/>
                </td>
            </tr>
        </table>
    </form>
</div>

<script type="text/javascript">
    $("#showTip").overlay({
        top:'center',
        mask: {
            color: '#111111',
            loadSpeed: 200,
            opacity: 0.5
        },
        closeOnClick: false
    });

    function showtip(){
        $("#showTip").overlay().load();
        if($("#showTip").css('display')=='none'){
            $("#showTip").css('display','block');
        }
    }
    function closetip(id){
        $("#"+id).overlay().close();
        if($("#"+id).css('display')=='block'){
            $("#"+id).css('display','none');
        }
    }
</script>

