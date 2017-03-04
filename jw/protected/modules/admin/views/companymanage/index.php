<?php
$this->breadcrumbs=array(
        '公司管理',
);?>
<div style="float:right">
    <a href="<?php echo Yii::app()->createUrl("/admin/companymanage/create");?>">添加新公司</a>&nbsp;&nbsp;&nbsp;
    <a href="<?php echo Yii::app()->createUrl("/admin/companytype/index");?>">管理公司类型</a>
</div>
<table width="100%" class="bordertable">
    <tr>
        <th width="30px">序号</th>
        <th width="60px">行政区</th>
        <th width="60px">公司类型</th>
        <th width="60px">人均消费</th>
        <th>公司名称</th>
        <th width="300px">公司地址</th>
        <th width="80px">操作</th>
    </tr>
    <?php
    $page = isset($_GET["page"])&&$_GET["page"]?$_GET["page"]:1;
    $pageSize = $dataProvider->pagination->pageSize;
    foreach($dataProvider->getData() as $number=>$data) {
        $this->renderPartial('_view', array(
                'data'=>$data,
                "number"=>$number,
                "page"=>$page,
                "pageSize"=>$pageSize
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
<script type="text/javascript">
    $(document).ready(function(){
<?php if(Yii::app()->user->hasFlash('message')): ?>
        jw.pop.alert("<?=Yii::app()->user->getFlash('message')?>",{autoClose:1000})
<?php endif; ?>
    });
    function confirmDel(id){
        var href = "<?=Yii::app()->createUrl("/admin/companymanage/del")?>";
        jw.pop.alert(
        "确定删除此公司吗？",
        {
            ok: function(){
                window.location.href=href+"/id/"+id;
            },
            hasBtn_ok:true,
            ok_label:'确定',
            hasBtn_cancel:true,
            icon:4
        }
    );
    }
</script>
