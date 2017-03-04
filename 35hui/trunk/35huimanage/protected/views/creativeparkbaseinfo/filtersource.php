<?php
$this->currentMenu = 18;
$this->breadcrumbs=array(
        '楼盘管理'=>array('index'),
        "创意园区房源过滤"
);
$this->menu=array(
        array('label'=>'新增创意园区', 'url'=>array('create')),
        array('label'=>'查看所有创意园区', 'url'=>array('admin')),
        array('label'=>'返回', 'url'=>array('view', 'id'=>$model->cp_id)),
);
?>

<h1>房源过滤</h1>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>
<form action="/creativeparkbaseinfo/changexieziloustate" method="post" id="source">
    <input type="hidden" name="id" value="<?=$model->cp_id?>" />
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
            <td><input name="chk[]" type="checkbox" value="<?php echo $data->cr_id; ?>" onclick='unselectall()'/></td>
            <td><?=$data->cr_userid?></td>
            <td><?=$data->cr_area?></td>
            <td><?=Officebaseinfo::$ob_floortype[$data->cr_floortype]?></td>
            <td><?=$data->cr_dayrentprice."元/平米·天"?></td>
            <td><?=$data->cr_ispanorama?"有":"无"?></td>
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