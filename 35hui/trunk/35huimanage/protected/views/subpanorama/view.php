<?php
$this->currentMenu = 61;
$this->breadcrumbs=array(
	'Subpanorama'=>array('index'),
	$model->spn_id=>array('view','id'=>$model->spn_id),
	'view',
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
);
?>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>
<h1>处理全景<?php echo $model->spn_id; ?></h1>
<font color="red">注意：请使用软件对待处理的全景图进行一个简单的预处理，如亮度、清晰度等等。 </font><br />
房源标题：<?=$title?><br />
房源类型：<?=Subpanorama::$sourcetype[$model->spn_sourcetype];?> &nbsp;&nbsp;
录入时间：<?php echo date("Y-m-d H:i:s", $model->spn_releasetime); ?> &nbsp;&nbsp;
审核状态：<?=Subpanorama::$spn_state[$model->spn_state]?>&nbsp;&nbsp;<br />
全景名称：<?=$model->spn_panoramaname?$model->spn_panoramaname:"暂无"?><br />
<?php
if($model->spn_state!=0){
    echo "后台最后操作者：".Manageuser::model()->getNameById($model->spn_handler);
}
?>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/overlay.min.js"></script>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/toolbox.expose.min.js"></script>
<br /><br />

<?php
$pics = unserialize($model->spn_fisheyephoto);
foreach($pics as $value){
    $value = str_replace(".", Subpanorama::$standard[1]['suffix'].".", $value);
    echo CHtml::image(PIC_URL.$value,"",array("width"=>"100px","height"=>"75px"))."&nbsp;&nbsp;";
}
?>
<style type="text/css">
    #defaultContent span{ cursor: pointer}
</style>
<br /><br />
<div style="display: inline-block">
    <div style="float: left">
        <?php
        if($model->spn_state==0){//未审核
            echo  CHtml::link("开始处理",array("audit",'id'=>$model->spn_id));
        }elseif($model->spn_state==3){//处理失败
            echo CHtml::link("打包下载",array("download",'id'=>$model->spn_id),array("target"=>"_blank"))."&nbsp;&nbsp;&nbsp;&nbsp;";
        }elseif($model->spn_state==2){//处理完成
            echo CHtml::link("打包下载",array("download",'id'=>$model->spn_id),array("target"=>"_blank"))."&nbsp;&nbsp;&nbsp;&nbsp;";
            echo CHtml::link("修改全景",array("update",'id'=>$model->spn_id))."&nbsp;&nbsp;&nbsp;&nbsp;";
            echo CHtml::link("预览全景",array("preview",'id'=>$model->spn_id),array("target"=>"_blank"))."&nbsp;&nbsp;&nbsp;&nbsp;";
            if(!Panorama::model()->getNum($model->spn_panoramaurl)){
                echo CHtml::link("设为精品",array("add",'id'=>$model->spn_id))."&nbsp;&nbsp;&nbsp;&nbsp;";
            }
        }else{
            echo CHtml::link("打包下载",array("download",'id'=>$model->spn_id),array("target"=>"_blank"))."&nbsp;&nbsp;&nbsp;&nbsp;";
            echo CHtml::link("上传全景",array("upload",'id'=>$model->spn_id))."&nbsp;&nbsp;&nbsp;&nbsp;";
            echo CHtml::link("全景制作失败",'javascript:showtip()')."&nbsp;&nbsp;&nbsp;&nbsp;";
        }
        ?>
    </div>
</div>
<div style="display:none;position: fixed;width: 300px;height: 280px;border: 1px solid #860001;padding: 5px;background-color:#EFEFEF;" id="showTip">
    <form action="<?php echo $this->createUrl('subpanorama/audit',array('id'=>$model->spn_id));?>" method="post" onsubmit="return checkForm()" >
        <input type="hidden" name="unpass" value="1" />

        <div style="float:right"><img onClick="closetip('showTip')" src="http://my35mag.huihenet.com/images/3.gif"/></div>
        <table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo" style="margin-top:20px">
            <tr>
                <td>
                    处理失败通知：
                    <textarea name="msg_content" id="msg_content" cols="25" rows="3"></textarea>
                </td>
            </tr>
            <tr>
                <td id="defaultContent">
                    <i>单击发送下列文本：</i><br/>
                    1. <span>您上传的不是标准鱼眼图，请阅读全景图帮助了解详情。</span><br/>
                    2. <span>您拍摄的四张鱼眼图的两两之间衔接不够紧密，无法拼接。</span><br />
                    3. <span>您拍摄的4张鱼眼图，在转动拍摄的时候，手机高度不一致，全景图效果质量差。</span><br />
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
    function checkForm(){
        if($("#msg_content").html().length){
            return true;
        }else{
            alert("请填写通知内容");
            return false;
        }
    }
    $(function(){
        $("#defaultContent>span").click(function(){
            $("#msg_content").html($(this).html());
        });
    })
</script>
