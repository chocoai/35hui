<?php
$this->breadcrumbs=array('预约刷新详细');
?>
<div class="htit">预约刷新详细</div>
<div class="jifentit" style="height:auto">
    <em class="red"><?=$title;?></em><br />
    此房源设置预约时间为<font style="color:#F60"><?=$sourceOrderRefresh?date("Y-m-d H:i", $sourceOrderRefresh[0]->sor_releasetime):"暂无"?></font>，预约刷新将在方案设置后进行。
    <?=CHtml::link("查看房源详细",array($url,"id"=>$sourceId),array("target"=>"_blank","style"=>"color:blue"));?>
</div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <?php
        if($sourceOrderRefresh){
            foreach($sourceOrderRefresh as $value){
                ?>
        <tr>
            <td align="center" class="txt"><?=date("Y-m-d", $value->sor_releasetime)?>&nbsp;到&nbsp;<?=date("Y-m-d", $value->sor_deadline)?></td>
            <td align="center" class="txt"><?=Sourceorderrefresh::model()->formatOrderTime($value->sor_ordertime);?></td>
        </tr>
                <?php
            }
        }
        ?>
    </table>
</div>