<?php
$this->breadcrumbs=array('已购买的可用位置');
?>
<div class="htit">已购买的可用位置</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="6%" class="ftit">&nbsp;</td>
            <td class="ftit">页面</td>
            <td class="ftit">模块</td>
            <td class="ftit">位置</td>
            <td class="ftit">购买价</td>
            <td class="ftit">购买天数</td>
            <td class="ftit">购买日期</td>
            <td class="ftit">&nbsp;</td>
        </tr>
        <?php
        if($allProduct){
            foreach($allProduct as $key=>$value) {
                ?>
        <tr>
            <td class="txt"><?=$key+1;?>、</td>
            <td class="txt"><?=Productgrid::model()->getPageName($value->productgrid->p_page)?></td>
            <td class="txt"><?=Productgrid::model()->getPositionName($value->productgrid->p_position)?></td>
            <td class="txt"><?=Productgrid::model()->getChineseIndexName($value->productgrid->p_index)?></td>
            <td class="txt"><?=$value->sp_buyprice?>&nbsp;点/天</td>
            <td class="txt"><?=$value->sp_buydays?>&nbsp;天</td>
            <td class="txt"><?=date("Y-m-d H:i", $value->sp_buytime)?></td>
            <td class="txt">
                <?php
                if($value->sp_sourceid){
                    if(Productgrid::model()->checkPositionCanUpdate($value->sp_positionid)){
                        echo CHtml::link("修改","#",array("onClick"=>"openTip(".$value->sp_id.")","style"=>"color:blue"))."&nbsp;&nbsp;";
                        echo CHtml::link("查看",array("/manage/buyproduct/viewsource","id"=>$value->sp_id),array("target"=>"_blank"));
                    }else{
                        echo "设置成功！";
                    }
                }else{
                    echo '<font style="color:red">未设置房源</font>&nbsp;'.CHtml::link("设置","#",array("onClick"=>"openTip(".$value->sp_id.")"));
                }
                ?>
            </td>
        </tr>
                <?php
            }
        }else{
            echo "<tr><td colspan='10'>暂无已经购买的位置！</td></tr>";
        }
        ?>
    </table>
</div>
<div class="helpline"><em>*</em><?=CHtml::link("历史购买记录","/manage/buyproduct/list")?></div>
<script type="text/javascript">
    function openTip(id){
        var url = "/manage/buyproduct/choosesource/id/"+id;
        var width = "640px";
        var height = "610px";
        parent.window.openTip(url,width,height);
    }
</script>