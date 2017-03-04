<?php
$this->breadcrumbs=array(
	'DYFW全景图片下载',
);
$this->currentMenu = 92;
?>
<h1>DYFW全景图片下载</h1>
<div class="wide form">
    <form method="GET" action="<?=Yii::app()->createUrl($this->route)?>" id="searchform" onsubmit="return chekForm(this);">
	<div class="row">
        地址：
        <?php echo CHtml::textField('panourl','',array('size'=>40)); ?><span style="color: red">一个完整的URL地址</span>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('展示',array('id'=>'submitBut')); ?>
	</div>
</form>
</div><!-- search-form -->
<?php if($pano_arr){
    foreach($pano_arr as $value){
?>
<div class="view">
<?php 
    echo  $value['type'],'<br />' ;
    unset($value['type']);
    foreach($value as $val){
        echo CHtml::image($val['imgPath'],$val['name'],array('width'=>180,'height'=>180,'title'=>$val['name']));
        echo $val['name'];
//        echo CHtml::link('下载',array('/dyfw/download','panoid'=>$val['panoId'],'dname'=>$val['name']),array('target'=>'_blank'));
        echo CHtml::link('下载',array('/dyfw/preview','panoid'=>$val['panoId'],'dname'=>$val['name']),array('target'=>'_blank'));
    }
?>
</div>
<?php } 
} ?>
<script type="text/javascript">
function chekForm(obj){
    var agent = obj.panourl.value.replace(/\s/g,'');
    if( agent == '') {
        alert('请填写一个URL');
        return false;
    }
    $("#submitBut").attr("disabled","disabled");
    return true;
}
</script>

