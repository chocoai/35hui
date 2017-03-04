<?php
$this->breadcrumbs=array("用户充值");
?>
<table width="100%" class="bordertable">
    <tr>
        <th>充值时间</th>
        <th>充值金额</th>
        <th>获得金币</th>
        <th>流水号</th>
        <th>充值用户</th>
        <th>支付宝交易号</th>
    </tr>
    <?php
    foreach($dataProvider->getData() as $data) {
        $this->renderPartial('_view', array(
                'data'=>$data,
        ));
    }
    ?>
</table>
<div style="height:65px">
<?php
$this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "cssFile"=>"/css/pager.css"
));
?>
</div>