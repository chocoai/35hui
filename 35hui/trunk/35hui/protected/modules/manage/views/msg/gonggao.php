<?php
$this->breadcrumbs=array(
        '公告',
);
$this->renderPartial('_head');
?>

<?php
foreach($dataProvider->getData() as $data){
    $this->renderPartial('_gonggao', array('data'=>$data));
}
?>

<div class="thline">
    <div class="thpage" style="text-align:right;">
        <?php
        echo "<div style='clear:both; height:35px; padding-top:15px;'>";
        $this->widget('CLinkPager',array(
                'pages'=>$dataProvider->pagination,
                "htmlOptions"=>array("style"=>"float:right"),
        ));
        ?>
    </div>
</div>
