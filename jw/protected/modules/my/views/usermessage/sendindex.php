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
        <li onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage");?>'" style="cursor: pointer">收件箱</li>
        <li class="clk" onclick="location.href='<?=Yii::app()->createUrl("/my/usermessage/sendindex");?>'" style="cursor: pointer">发件箱</li>
        <li onclick="location.href='<?=Yii::app()->createUrl("/my/systemmessage");?>'" style="cursor: pointer">系统消息</li>
    </ul>
</div>

<div class="jbmain">
    <div class="dxline">
        <span class="dx_01"><input type="checkbox" name="all" id="selectallbox"/></span>
        <span class="dx_03">
            <label for="selectallbox">全选</label>	<input type="button" value="删 除" class="btn_03" onclick="delUserMessage()" />
        </span>
    </div>
    <form action="/my/usermessage/del" id="listForm" method="post">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_sendview',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </form>
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
    function showMessageInfo(id){
        window.location.href="/my/usermessage/view/id/"+id;
        return false;
    }
</script>