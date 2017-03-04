<table border="0">
    <tr>
        <td>送给：</td>
        <td>
            <div style="width: 500px;" class="autoCompletemaindiv">
                <div class="nowSelectDiv"></div>
                <div class="inputDiv">
                    <input value="" style="width:100%"/>
                </div>
                <ul class="showmath"></ul>
            </div>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td><input type="checkbox" value="1" id="sendType" /><label for="sendType">秘密赠送</label></td>
    </tr>
</table>
<script type="text/javascript">
    function getValue(){
        var receiveUserId = [];
        $(".autoCompletemaindiv .oneSelect").each(function(i){
            receiveUserId[i] = $(this).attr("attr");
        })
        var sendType = $("#sendType:checked").val();
        if(typeof(sendType)=="undefined"){
            sendType = 0;
        }
        var re = new Array;
        re["receiveUserId"]=receiveUserId;
        re["sendType"]=sendType;
        return re;
    }
    function valueError(){
        $(".autoCompletemaindiv").css("border-color","red");
        setTimeout(function(){
            $(".autoCompletemaindiv").css("border-color","gray");
        },500);
    }
    $(".autoCompletemaindiv").click(function(){
        $(".autoCompletemaindiv input").focus();
    });
    $(document).ready(function(){
        $(".autoCompletemaindiv").autoComplete({
            source:[<?=$attentionUser?>],
            listShow:4,
            clickFun:function(msg){
                var preg = /\(/;
                var id = msg.substr(msg.search(preg)+1);
                var name = msg.substr(0, msg.search(preg));
                id = id.replace(")", "");
                var length = $(".autoCompletemaindiv .oneSelect").length;
                if(length<4){
                    var check = true;
                    $(".autoCompletemaindiv .oneSelect").each(function(){
                        $(this).attr("attr")==id?check=false:"";
                    })
                    if(check){
                        var html = '<div class="oneSelect" attr="'+id+'">'+
                            '<span class="person">'+
                            '<font title="'+name+'">'+name+'</font>'+
                            '<span onclick="delOneSelect('+id+')">×</span>'+
                            '</span></div>';
                        $(".autoCompletemaindiv .nowSelectDiv").append(html);
                    }
                }else{
                    jw.pop.alert("已经达到了可选择的最大值",{autoClose:1000,icon:2})
                }
            },
            zeroDelFun:function(){
                 $(".autoCompletemaindiv .oneSelect").eq($(".autoCompletemaindiv .oneSelect").length-1).remove()
            }
        });
    })
    function delOneSelect(id){
        $(".autoCompletemaindiv .oneSelect[attr='"+id+"']").remove();
    }
</script>
<?php Yii::app()->clientScript->registerScriptFile('/js/giftAutoComplete/giftAutoComplete.js',CClientScript::POS_END );?>
<?php Yii::app()->clientScript->registerCssFile('/js/giftAutoComplete/giftAutoComplete.css');?>