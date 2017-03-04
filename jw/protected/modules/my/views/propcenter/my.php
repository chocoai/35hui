<?=$this->renderPartial('_top');?>
<div class="jbmain">
    <div class="yue">我共有<a href="/my/propcenter/my"><em><?=$countAll?></em></a>个道具，<a href="/my/propcenter/my/type/un"><em><?=$countUnUse?></em></a>个未使用</div>
    <div class="djline">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_propmyview',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </div>
</div>
<div id="usermessageform" style="display: none">
    <?=$this->renderPartial('/usermessage/_usermessageform');?>
</div>
<script type="text/javascript">
    function showdescribe(obj){
        var html = $(obj).prev("span").html();
        jw.pop.tip(html)
    }
    function useProp(id,key){
        if(key==<?=Propcenter::horn?>){
            sendUserMessage(id);
        }else if(key==<?=Propcenter::reduceblackboard?>){
            confirmUse(id);
        }
    }
    function confirmUse(id,title,content){
        jw.pop.alert("确定使用本道具吗？",{
            ok: function(){
                $.post("/my/propcenter/use", {"pblId":id,"title":title,"content":content}, function(msg){
                    if(msg=="success"){
                        jw.pop.alert("道具使用成功！",{autoClose:1000})
                        setTimeout(function(){window.location.reload()},1000)
                    }
                }, "text");
            },
            hasBtn_ok:true,
            ok_label:'确定',
            hasBtn_cancel:true,
            icon:4
        });
    }
    function sendUserMessage(id){
        var content = "<div id='alertform'>"+$("#usermessageform").html()+"</div>";
        jw.pop.customtip(
        "发送消息",
        content,
        {
            hasBtn_ok:true,
            hasBtn_cancel:true,
            zIndex:10000,
            ok: function(){
                var title = $.trim($("#alertform form input[name='title']").val());
                if(title==""){
                    $("#alertform input[name='title']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform input[name='title']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                var check_title = $("#alertform form input[name='check_title']").val();
                if(check_title==0){
                    $("#alertform input[name='title']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform input[name='title']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                var content = $.trim($("#alertform form textarea[name='content']").val());
                if(content==""){
                    $("#alertform textarea[name='content']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform textarea[name='content']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                var check_content = $("#alertform form input[name='check_content']").val();
                if(check_content==0){
                    $("#alertform textarea[name='content']").css("border-color","#ff0000");
                    setTimeout(function(){
                        $("#alertform textarea[name='content']").css("border-color","#D7D5D6");
                    },500);
                    return false;
                }
                confirmUse(id,title,content);
                return false
            },
            btn_float:"center"
        }
    );
    }
    function message_check_inputNum(){
        var dom = $("#alertform");
        var n = Math.ceil(txtNum_func($(dom).find("input[name='title']").val())/2);
        $(dom).find(".numShowMsg").eq(0).html(n);
        if(n>50){
            $(dom).find(".numShowMsg").eq(0).css("color","#ff0000")
            $(dom).find("input[name='check_title']").val("0");
        }else{
            $(dom).find(".numShowMsg").eq(0).css("color","");
            $(dom).find("input[name='check_title']").val("1");
        }
    }
    function message_check_textareaNum(){
        var dom = $("#alertform");
        var n = Math.ceil(txtNum_func($(dom).find("textarea[name='content']").val())/2);
        $(dom).find(".numShowMsg").eq(1).html(n);
        if(n>150){
            $(dom).find(".numShowMsg").eq(1).css("color","#ff0000")
            $(dom).find("input[name='check_content']").val("0");
        }else{
            $(dom).find(".numShowMsg").eq(1).css("color","");
            $(dom).find("input[name='check_content']").val("1");
        }
    }
</script>