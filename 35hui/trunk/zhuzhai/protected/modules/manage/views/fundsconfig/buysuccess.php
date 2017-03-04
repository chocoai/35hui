<div class="htit">充值优惠</div>
<div class="jifentit" style="text-align: center;padding-top: 150px">
    <?php
    if($return){
        echo "<font style='color:green'>充值成功！</font>";
    }else{
        echo "<font style='color:red'>同一个订单不能重复付款，充值失败！</font>";
    }
    ?><br />
    订单号：<?=$dingdan?>。充值金额￥<font color="red"><?=$total_fee?></font>元！
    <?=CHtml::link("返回",array("/manage"),array("style"=>"color:blue"));?>
</div>