<?php
$this->breadcrumbs=array(
	'SouFun数据采集',
);
/*
$this->menu=array(
	array('label'=>'管理站内信', 'url'=>array('admin')),
	array('label'=>'选择用户发送站内信', 'url'=>array('user/index')),
);
 */
?>
<?php if(Yii::app()->user->hasFlash('sendState')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('sendState'); ?>
    </div>
<?php endif; ?>
<h1>SouFun数据采集</h1>
<div class="wide form">
    <form method="GET" action="<?=Yii::app()->createUrl($this->route)?>" id="searchform" onsubmit="return chekForm(this);">
	<div class="row">
		<?php echo CHtml::dropDownList('rentorsell',empty($_GET['rentorsell'])?'':$_GET['rentorsell'],array('esf'=>'二手房','rent'=>'出 租',)); ?>
        用户名称：
        <?php echo CHtml::textField('agentname','',array('size'=>20,'maxlength'=>20)); ?>
        房源类型：
		<?php echo CHtml::dropDownList('type','',array('0'=>'不 限','7'=>'写字楼','6'=>'商 铺','3'=>'住 宅')); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('查找房源',array('id'=>'submitBut')); ?>
	</div>
</form>
</div><!-- search-form -->
<?php if($clinks_fenlei){ ?>
<div class="view">
    用户信息：<?php print_r($user_info); ?>
</div>
<div class="view">
    <form method="POST" action="<?=Yii::app()->createUrl('soufun/fetch')?>" id="fetchform" onsubmit="return fuckForm();">
        <?php echo '<b>'.CHtml::submitButton('收录房源',array('id'=>'fuckBut')).'</b><br />'; ?>
    <?php
    $funtype = array('3'=>'住宅房源','7'=>'写字楼房源','6'=>'商铺房源');//3,住宅 10,别墅 7,写字楼 6,商铺
    foreach($clinks_fenlei as $key=>$v){
        echo '<b> &nbsp; &nbsp; &nbsp;'.$funtype[$key].'（共查找到'.count($v).'条）</b><br />';
        foreach($v as $vv){
        echo '<b>'.$vv.'<input type="hidden" name="sfurl[]" value="'.$vv.'"</b><br />';
        }
    }
    ?>
        <input type="hidden" name="rentorsell" value="<?=$rentorsell?>">
        <input type="hidden" name="userid" value="<?=$user_info['user_id']?>">
    </form>
</div>
<?php }elseif(!empty($_GET['agentname'])){
    echo '<p>没有发现用户<b><a href="http://esf.sh.soufun.com/a/'.$_GET['agentname'].'" target="_blank">'.$_GET['agentname'].'</a></b>发布的房源！或者用户不存在。</p>';
    
    } ?>
<script type="text/javascript">
function chekForm(obj){
    var agent = obj.agentname.value.replace(/\s/g,'');
    if(agent) {
        changeSub($("#submitBut"));
        return true;
    }else{
        alert('请指定采集的注册经纪人');
    }
    return false;
}
function changeSub(Obj){
    Obj.val("正在搜索房源，请耐心等待...");
    Obj.attr("disabled","disabled");
}
function fuckForm(){
    $("#fuckBut").attr("disabled","disabled");
    return true;
}
</script>

