<?=$this->renderPartial('_top');?>
<div class="jbmain">
    <div class="djline">
        <?php //礼物
        foreach($allGift as $value) {
            ?>
        <div class="djmod">
            <img src="<?=$value->gc_url?>" width="210px" height="240px" />
            <p><b><?=$value->gc_name?></b></p>
            <p class="p2">价格：<?=$value->gc_price?>金币</p>
            <div class="ln">
                <input type="button" class="ln1" onclick="sendGift(<?=$value->gc_id?>)"/>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    function sendGift(id){
        var content = '<div id="alertform"><iframe name="send" src="/my/propcenter/frameprop" scrolling="no" frameborder="no" width="550px" height="110px"></iframe></div>';
        jw.pop.customtip("赠送礼物",content,{
            hasBtn_ok:true,
            hasBtn_cancel:true,
            ok_label:'赠送',
            ok: function(){
                var value = window.frames['send'].getValue();
                var receiveUserId = value["receiveUserId"];
                var sendType = value["sendType"];
                if(receiveUserId.length!=0){
                    var receiveUserStr = receiveUserId.join(",");
                    $.post("/my/giftcenter/sendgift", {"receiveUserStr":receiveUserStr,"giftId":id,"sendType":sendType}, function(msg){
                        if(msg&&msg=="success"){
                            jw.pop.alert("赠送礼物成功!",{autoClose:1000});
                            setTimeout(function(){window.location.reload()},1000);
                        }else if(msg&&msg!="success"){
                            jw.pop.alert(msg,{autoClose:1000,icon:2});
                        }else{
                            jw.pop.alert("您传递的参数不对",{autoClose:1000,icon:2});
                        }
                    }, "html")
                }else{
                    window.frames['send'].valueError();
                    return false;
                }
            },
            btn_float:"center"
        });
    }
    function showdescribe(obj){
        var html = $(obj).prev("span").html();
        jw.pop.tip(html)
    }
</script>