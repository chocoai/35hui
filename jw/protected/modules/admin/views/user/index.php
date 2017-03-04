<?php
$this->breadcrumbs=array(
        '用户管理',
);?>
<table width="100%" class="bordertable">
    <tr>
        <th>用户ID</th>
        <th>昵称</th>
        <th>登陆邮箱</th>
        <th>类型</th>
        <th>注册时间</th>
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