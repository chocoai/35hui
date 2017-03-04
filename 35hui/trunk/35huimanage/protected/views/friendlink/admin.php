<?php
$this->breadcrumbs=array(
	'Friendlinks'=>array('index'),
	'Manage',
);
$this->menu=array(
	array('label'=>'友情链接列表', 'url'=>array('index')),
	array('label'=>'创建友情链接', 'url'=>array('create')),
);
?>
<style type="text/css">
.oneDiv{
    width: 200px;float: left;overflow: hidden;line-height: 30px;border: 1px gray solid;margin: 5px;height: 30px;cursor: pointer;
}
.select{border: 1px blue solid;background-color: gray}
</style>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>

<?php
    foreach($allLinks as $key=>$value){
?>
<div>
    <h3><b><?=Friendlink::$fl_type[$key]?></b></h3>
    <form action="" method="post">
    <?php
        foreach($value as $v){
        ?>
        <div class="oneDiv" <?=$key==Friendlink::PIC_TYPE?"style='width:100px'":""?>>
            <?php
            if($key==Friendlink::PIC_TYPE){
                echo CHtml::image($v->fl_picurl,$v->fl_value,array("width"=>"90px","height"=>"30px"));
            }else{
                echo $v->fl_value;
            }
            ?>
            <input type="hidden" name="id[]" value="<?=$v->fl_id?>" />
        </div>
        <?php
        }
    ?>
        <div style="clear: both"></div>
        <input type="button" onclick="move(1)" value="左移"/>
        <input type="button" onclick="move(2)" value="右移"/>
        <input type="submit" value="保存为当前排序" name="submit"/>
    </form>
</div>
<?php
    }
?>

<script type="text/javascript">
    $("form .oneDiv").click(
        function(){
            $("form .select").removeClass("select");
            $(this).addClass("select");
        }
    );
    $("form .oneDiv").eq(0).click();
    function move(type){
        var nowDom = $("form .select");
        var prevDom = $("form .select").prev(".oneDiv");
        var nextDom = $("form .select").next(".oneDiv");
        if(type==1){//左移
            var tmp = $(prevDom).html();
            if(tmp){//有左边
                $(prevDom).html($(nowDom).html());
                $(nowDom).html(tmp);
                $(nowDom).removeClass("select");
                $(prevDom).addClass("select");
            }
        }
        if(type==2){//右移
            var tmp = $(nextDom).html();
            if(tmp){//有右边
                $(nextDom).html($(nowDom).html());
                $(nowDom).html(tmp);
                $(nowDom).removeClass("select");
                $(nextDom).addClass("select");
            }
        }
    }
</script>