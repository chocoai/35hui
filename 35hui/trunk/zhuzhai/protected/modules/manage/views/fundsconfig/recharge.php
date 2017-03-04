<?php
$this->breadcrumbs=array('账务充值');
?>
<style type="text/css">
    .zhifu ul{clear:both}
    .zhifu ul li{width:150px;float:left;line-height: 30px}
    .zhifu .hed{width:100%;float: left;height: 30px}
    .zhifu .btm{clear:both;width:100%;float: left;height: 50px}
</style>

<div class="htit">充值优惠</div>
<div class="jifentit">充值：<em style="color:red">￥<?=$model->fc_rmbprice?></em>
    <a href="<?=Yii::app()->createUrl("/manage/fundsconfig/buylist")?>">历史充值记录</a>
</div>
<div class="rgcont">
    <form name=alipayment onSubmit="return CheckForm();" action=""  method=post target="_blank">
        <table cellspacing="0" cellpadding="0" border="0" width="100%" class="table_02">
            <tr>
                <td valign="top" class="tit" width="80px">支付方式：</td>
                <td class="tit">
                    <div class="zhifu">
                        <div class="hed">
                            <input type="radio" name="pay_bank" value="directPay" checked><img src="/images/bank/alipay_1.gif" border="0"/>
                        </div>
                        <ul>
                            <li><input type="radio" name="pay_bank" value="ICBCB2C"/><img src="/images/bank/ICBC_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="CMB"/><img src="/images/bank/CMB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="CCB"/><img src="/images/bank/CCB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="BOCB2C"><img src="/images/bank/BOC_OUT.gif" border="0"/></li>

                            <li><input type="radio" name="pay_bank" value="ABC"/><img src="/images/bank/ABC_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="COMM"/><img src="/images/bank/COMM_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="SPDB"/><img src="/images/bank/SPDB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="GDB"><img src="/images/bank/GDB_OUT.gif" border="0"/></li>

                            <li><input type="radio" name="pay_bank" value="CITIC"/><img src="/images/bank/CITIC_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="CEBBANK"/><img src="/images/bank/CEB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="CIB"/><img src="/images/bank/CIB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="SDB"><img src="/images/bank/SDB_OUT.gif" border="0"/></li>

                            <li><input type="radio" name="pay_bank" value="CMBC"/><img src="/images/bank/CMBC_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="HZCBB2C"/><img src="/images/bank/HZCB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="SHBANK"/><img src="/images/bank/SHBANK_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="NBBANK "><img src="/images/bank/NBBANK_OUT.gif" border="0"/></li>

                            <li><input type="radio" name="pay_bank" value="SPABANK"/><img src="/images/bank/SPABANK_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="BJRCB"/><img src="/images/bank/BJRCB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="ICBCBTB"/><img src="/images/bank/ENV_ICBC_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="CCBBTB"/><img src="/images/bank/ENV_CCB_OUT.gif" border="0"/></li>

                            <li><input type="radio" name="pay_bank" value="SPDBB2B"/><img src="/images/bank/ENV_SPDB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="ABCBTB"/><img src="/images/bank/ENV_ABC_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="fdb101"/><img src="/images/bank/FDB_OUT.gif" border="0"/></li>
                            <li><input type="radio" name="pay_bank" value="PSBC-DEBIT"/><img src="/images/bank/PSBC_OUT.gif" border="0"/></li>
                        </ul>
                        <div class="btm"><input type=image src="/images/bank/button_sure.gif" value="确认订单" name=nextstep></div>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>

<div id="opendiv" style="display: none">
    <style type="text/css">
        .order-pay-dialog{background: #63C5C8;border: 2px solid;color: white;cursor: pointer;letter-spacing: 0.1em;padding: 4px 1em;width: 130px;height: 20px;font-size: 12px}
    </style>
    <table width="250px">
        <tr>
            <td colspan="2"><div style="float:right;cursor: pointer"><img onClick="closeTip()" src="<?php echo IMAGE_URL."/3.gif";?>"/></div></td>
        </tr>
        <tr>
            <td><img src="<?=IMAGE_URL?>/noticeinfo.gif" /></td>
            <td><h3>请您在新打开的页面上<br />完成付款。</h3></td>
        </tr>
        <tr>
            <td colspan="2" style="line-height:30px">付款完成前请不要关闭此窗口。<br>完成付款后请根据您的情况点击下面的按钮：</td>
        </tr>
        <tr>
            <td colspan="2" style="padding-top:20px">
                <a class="order-pay-dialog" onclick="closeTip()" href="<?=Yii::app()->createUrl("/manage/fundsconfig/buylist");?>" target="frame">已完成付款</a>
                <input class="order-pay-dialog" type="button" value="付款遇到问题" onclick="closeTip()">
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    function CheckForm(){
        parent.window.openTipContent($("#opendiv").html(),"250px","200px")
        return true;
    }
</script>