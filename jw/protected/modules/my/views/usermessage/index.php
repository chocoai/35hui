<style type="text/css">
    fieldset{
        border: 1px solid #DEDEDE;
        color: #999;
        font-size: 12px;
        line-height: 18px;
        padding: 2px 0px 8px;
    }
    legend{color: #999;margin-left: 5px;padding: 0px 4px;}
    .quote_content{margin-left: 5px;padding: 0px 5px;}
</style>
<div class="zftnav">
    <ul>
        <li class="clk" onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage");?>'" style="cursor: pointer">收件箱</li>
        <li onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage/sendindex");?>'" style="cursor: pointer">发件箱</li>
        <li onclick="location.href='<?=Yii::app()->createUrl("/my/systemmessage");?>'" style="cursor: pointer">系统消息</li>
    </ul>
</div>

<div class="jbmain">
    <div class="dxline">
        <span class="dx_01"><input type="checkbox" name="all" id="selectallbox"></span>
        <span class="dx_03">
            <label for="selectallbox">全选</label>	<input type="button" value="删 除" class="btn_03" onclick="delUserMessage()" />
        </span>
    </div>
    <form action="/my/usermessage/del" id="listForm" method="post">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_view',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </form>
</div>

<div id="usermessageform" style="display: none">
    <?=$this->renderPartial('_usermessageform');?>
</div>
<script type="text/javascript">
    function delUserMessage(){
        var info = $("#listForm").serialize();
        if(info){
            jw.pop.alert("确定删除所选信件吗？",{
                    ok: function(){
                        setTimeout(function(){$("#listForm").submit()},0);
                    },
                    hasBtn_ok:true,
                    ok_label:'确定',
                    hasBtn_cancel:true,
                    icon:4
                }
            );
        }else{
            jw.pop.alert("请先勾选要删除的信件！",{autoClose:1000,icon:2})
        }
    }
    function showMessageInfo(id){
        window.location.href="/my/usermessage/view/id/"+id;
        return false;
    }
    function sendUserMessage(umid){
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
                $.post("/my/usermessage/reply",{"umid":umid,"title":title,"content":content},function(msg){
                    if(msg=="error"){
                        jw.pop.alert("消息回复失败！",{autoClose:1000,icon:2});
                    }else{
                        jw.pop.alert("消息回复成功！",{autoClose:1000});
                    }
                },"text")
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

    $("#selectallbox").click(function(){
        var all = $(this);
        $("form input[type='checkbox']").each(function(){
            $(this).get(0).checked = $(all).get(0).checked
        });
    });
    $("form input[type='checkbox']").click(function(){
        if(!$(this).get(0).checked){
            $("#selectallbox").get(0).checked = false;
        }
    });
</script>
