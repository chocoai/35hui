<?=$this->renderPartial('_leftmenu');?>
<div class="zfmain">
    <div class="yue">我的账户余额：<em><?=$userModel->u_goldnum?></em>金币</div>
    <div class="zfbmain">
        <div class="zfblf"><a href="">支付宝</a></div>
        <div class="zfbrt">
            <h1>使用支付宝充值</h1>
            <p>请选择你要充值金额</p>
            <form action="/my/accountrecharge/recharge" method="post" target="_blank" onsubmit="return checkValue()">
                <table class="zfbtab" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td><input type="radio" name="price" value="10" id="price_1"/><label for="price_1">10元=<?=10*$rmb_to_gold?>金币</label></td>
                        <td><input type="radio" name="price" value="30" id="price_2"/><label for="price_2">30元=<?=30*$rmb_to_gold?>金币</label></td>
                        <td><input type="radio" name="price" value="50" id="price_3"/><label for="price_3">50元=<?=50*$rmb_to_gold?>金币</label></td>
                    </tr>
                    <tr>
                        <td colspan="3">自定义金额 <input type="text" name="userprice" class="txt_01"/> 元</td>
                    </tr>
                </table>
                <p><input type="radio" name="pay_bank" value="directPay" checked><img src="/images/alipay_1.gif" border="0" /></p>
                <input type="hidden" name="submitprice" value="" />
                <input type="submit" class="btn_01" value="下一步"/>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        $("input[name='price']").click(function(){
            $("input[name='userprice']").val("");
        });
        $("input[name='userprice']").click(function(){
            $("input[name='price']:checked").attr("checked","")
        })
    })
    function checkValue(){
        var checked = $("input[name='price']:checked").val();
        var userprice = $("input[name='userprice']").val();
        var money = "";
        if(checked==undefined){
            money = userprice;
        }else{
            money = checked;
        }
        money = $.trim(money);
        var preg = /^[0-9]*$/
        if(money==""){
            jw.pop.alert("请选择要充值的金额",{autoClose:1000,icon:2});
        }else if(isNaN(money)){
            jw.pop.alert("请填入正确的充值数字",{autoClose:1000,icon:2});
        }else if(parseInt(money)<10){
            jw.pop.alert("最小充值金额为10元",{autoClose:1000,icon:2});
        }else if(!preg.test(money)){
            jw.pop.alert("充值金额必须是整数",{autoClose:1000,icon:2});
        }else{
            $("input[name='submitprice']").val(money);
            jw.pop.alert("充值已经完成？",{
                ok: function(){
                    setTimeout(function(){
                        window.location.href="<?=DOMAIN?>/my/accountrecharge/rechargelog";
                    },10);
                },
                hasBtn_ok:true,
                ok_label:'付款成功',
                hasBtn_cancel:true,
                cancel_label:'付款遇到问题',
                icon:4
            });
            return true;
        }
        return false;
    }
</script>