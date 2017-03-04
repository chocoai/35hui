<?php
$this->breadcrumbs=array(
        '账务充值',
);
?>

<div class="htit">我的充值记录</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="40%">订单号</td>
            <td width="20%">充值</td>
            <td width="20%">购买时间</td>
            <td>状态</td>
        </tr>
        <?php
        if($list){
            foreach($list as $value){
                ?>
        <tr>
            <td><?=$value->arc_ordernum?></td>
            <td><font color="red">￥<?=$value->fundsconfig->fc_rmbprice?></font></td>
            <td><?=date("Y-m-d H:i", $value->arc_releasetime);?></td>
            <td>
                        <?php
                        echo $value->arc_state==0?"<font style='color:red'>未付款</font>&nbsp;".CHtml::link("付款",array("/manage/fundsconfig/recharge","id"=>$value->fundsconfig->fc_id,"arcid"=>$value->arc_id))."&nbsp;&nbsp;".CHtml::link("取消",array("/manage/fundsconfig/delrecharge","arcid"=>$value->arc_id),array("onCLick"=>"return confirm('确定删除吗？')")):"已付款";
                        ?>
            </td>
        </tr>
                <?php
            }
        }
        ?>
    </table>
</div>