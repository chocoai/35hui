<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
        '楼盘管理'=>array('index'),
        "房源过滤"
);
$this->menu=array(
        array('label'=>'新增楼盘', 'url'=>array('create')),
        array('label'=>'查看所有楼盘', 'url'=>array('index')),
        array('label'=>'返回', 'url'=>array('view', 'id'=>$model->sbi_buildingid)),
);
?>

<h1>房源过滤</h1>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>
<form action="" method="post" id="searchForm">
    <table width="100%" border="1" style="margin-bottom:0px">
        <tr>
            <td>
                <?php echo CHtml::radioButtonList('type',$type,Officebaseinfo::$rentorsell,array("separator"=>"&nbsp;","onchange"=>"$('#searchForm').submit()")); ?>
            </td>
        </tr>
    </table>
</form>

<form action="/systembuildinginfo/changexieziloustate" method="post" id="source">
    <input type="hidden" name="id" value="<?=$model->sbi_buildingid?>" />
    <table width="100%">
        <tr>
            <th width="50px">&nbsp;</th>
            <th>发布者</th>
            <th>面积</th>
            <th>楼层</th>
            <th>价格</th>
            <th>全景</th>
        </tr>
        <?php
        $all = $dataProvider->getData();
        if($all){
            foreach($all as $data){
                ?>
        <tr>
            <td><input name="chk[]" type="checkbox" value="<?php echo $data->ob_officeid; ?>" onclick='unselectall()'/></td>
            <td><?=$data->ob_uid?></td>
            <td><?=$data->ob_officearea?></td>
            <td><?=Officebaseinfo::$ob_floortype[$data->ob_floortype]?></td>
            <td><?=$data->ob_sellorrent==1?$data->ob_rentprice."元/平米·天":$data->ob_sumprice."万元/套"?></td>
            <td><?=$data->ob_ispanorama?"有":"无"?></td>
        </tr>
                <?php
            }
            ?>
        <tr>
            <td><input id="chkAll" name="chkAll" type="checkbox" onclick='checkAll(this.checked)' /><label for="chkAll">全选</label></td>
            <td colspan="10" ><input type="submit" value="下线" /></td>
        </tr>
            <?php
        }
        ?>

    </table>
</form>
<?php
$this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
));
?>
<script type="text/javascript">
    //全选
    function checkAll(t){
        $(":input[name=chk[]]").each(function(){
            $(this).attr("checked",t?"checked":"");
        });
    }
    //取消全选
    function unselectall(){
        $("#chkAll").attr("checked", '');
    }
</script>