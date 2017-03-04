<?php
$urlIndex= '';
$showName= '';
$buildId= '';
if($type == 1){
    $urlIndex = array('buildIndex');
    $showName=$pmodel->sbi_buildingname;
    $buildId = $pmodel->sbi_buildingid;
}else{
    $urlIndex = array('communityIndex');
    $showName=$pmodel->comy_name;
    $buildId = $pmodel->comy_id;
}
$this->breadcrumbs=array(
	'微博管理'=>$urlIndex,
	$showName=>array('twittersuggest/suggestIndex','buildingId'=>$buildId),
    '自行录入微博信息'
);
$this->currentMenu = 49;
//$this->menu=array(
//	array('label'=>'List Twittersuggest', 'url'=>array('index')),
//	array('label'=>'Manage Twittersuggest', 'url'=>array('admin')),
//);
?>

<h1>自行录入微博信息</h1>

<?php echo $this->renderPartial('_twitterForm', array('model'=>$model)); ?>