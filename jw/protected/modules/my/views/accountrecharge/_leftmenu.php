<div class="zftnav">
    <ul>
        <li class="<?php echo $this->action->id=='index'?' clk':''?>" onclick="location.href='<?=Yii::app()->createUrl("/my/accountrecharge");?>'" style="cursor:pointer">支付中心</li>
        <li class="<?php echo $this->action->id=='rechargelog'?' clk':''?>" onclick="location.href='<?=Yii::app()->createUrl("/my/accountrecharge/rechargelog");?>'" style="cursor:pointer">充值明细</li>
        <li class="<?php echo $this->action->id=='consumelog'?' clk':''?>" onclick="location.href='<?=Yii::app()->createUrl("/my/accountrecharge/consumelog");?>'" style="cursor:pointer">消费明细</li>
    </ul>
</div>