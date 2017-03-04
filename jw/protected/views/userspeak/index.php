<?php
$this->topbreadcrumbs = array(
    "展示"=>array("/member/list"),
    $userModel->u_nickname=>array("/user/view","id"=>$userModel->u_id),
    "我的动态"
);
?>
<div class="hyleft">
    <?php
    foreach($dataProvider->getData() as $value) {
        $this->renderPartial('_view',array("value"=>$value));
    }
    $this->widget('CLinkPager',array(
            'pages'=>$dataProvider->pagination,
            "cssFile"=>"/css/pager.css"
    ));
    ?>
</div>
<?php
$this->renderPartial('_boardorder');
?>
