<?php
$this->breadcrumbs=array(
	'站点公告',
);
?>
<div class="htit">站点公告</div>

<?php
if(!empty($stationPost)){
    foreach($stationPost as $key=>$value){
?>
<div class="liuycont">
    <h5><span><?php echo date("Y-m-d",$value->post_time); ?></span><?=$value->post_title;?> </h5>
    <div class="lycont">
        <?=$value->post_content; ?>
    </div>
</div>
<?php
    }
}