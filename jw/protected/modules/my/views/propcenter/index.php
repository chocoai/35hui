<?=$this->renderPartial('_top');?>
<div class="jbmain">
    <div class="djline">
        <?php
        foreach($allProp as $value) {
            ?>
        <div class="djmod">
            <img src="<?=$value->pc_url?>" width="210px" height="240px" />
            <p><b><?=$value->pc_name?></b></p>
            <p>
                <span style="float: left;width: 190px;overflow: hidden;height: 20px">使用：<?=$value->pc_describe?></span>
                <span style="float:right;color:#FF7F27;cursor: pointer" onclick="showdescribe(this)">详细</span>
            </p>
            <p class="p2">价格：<?=$value->pc_price?>金币</p>
            <div class="ln">
                <input type="button" class="ln1" onclick="sendProp(<?=$value->pc_key?>)"/>
                <input type="button" class="ln2" onclick="buyProp(<?=$value->pc_key?>)"/>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    function buyProp(id){
        jw.pop.alert(
        "确定购买此道具吗？",{
            ok: function(){
                $.post("/my/propcenter/buyprop", {"propId":id}, function(msg){
                        if(msg&&msg=="success"){
                            jw.pop.alert("购买道具成功!",{autoClose:1000});
                            setTimeout(function(){window.location.reload()},1000);
                        }else if(msg&&msg!="success"){
                            jw.pop.alert(msg,{autoClose:1000,icon:2});
                        }else{
                            jw.pop.alert("您传递的参数不对",{autoClose:1000,icon:2});
                        }
                    }, "html")
            },
            hasBtn_ok:true,
            ok_label:'确定',
            hasBtn_cancel:true,
            icon:4
        });
    }
    function sendProp(id){
        var content = '<div id="alertform"><iframe name="send" src="/my/propcenter/frameprop" scrolling="no" frameborder="no" width="550px" height="110px"></iframe></div>';
        jw.pop.customtip("赠送道具",content,{
            hasBtn_ok:true,
            hasBtn_cancel:true,
            ok_label:'赠送',
            ok: function(){
                var value = window.frames['send'].getValue();
                var receiveUserId = value["receiveUserId"];
                var sendType = value["sendType"];
                if(receiveUserId.length!=0){
                    var receiveUserStr = receiveUserId.join(",");
                    $.post("/my/propcenter/sendprop", {"receiveUserStr":receiveUserStr,"propId":id,"sendType":sendType}, function(msg){
                        if(msg&&msg=="success"){
                            jw.pop.alert("赠送道具成功!",{autoClose:1000});
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