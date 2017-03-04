<?php
$this->breadcrumbs=array(
        '发件箱',
);
$this->renderPartial('_head');
?>
<form action="/manage/msg/delete" method="post">
    <div class="rgcont">
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr>
                <td class="ftit" colspan="2" width="55%">留言标题</td>
                <td width="15%" class="ftit">收件人</td>
                <td width="19%" class="ftit">发送时间</td>
                <td width="11%" class="ftit">操作</td>
            </tr>
            <?php
            foreach($dataProvider->getData() as $data){
                $this->renderPartial('_sendlist', array('data'=>$data));
            }
            ?>
        </table>
    </div>
    <div class="thline">
        <div class="thinpunt" style="padding-left:18px;">
            <input type="checkbox" id="checkall" onchange="funcheckall()" /><label for="checkall">全选本页</label>
            <input type="submit" value="删除" class="btn_01" onclick="return confirm('确定要删除所选信件吗？')"/>
        </div>
        <div class="thpage" style="text-align:right;">
            <?php
            echo "<div style='clear:both; height:35px; padding-top:15px;'>";
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "htmlOptions"=>array("style"=>"float:right"),
            ));
            ?>
        </div>
    </div>
</form>
<script type="text/javascript">
    function funcheckall(){
        $("table input[type='checkbox']").attr("checked",$("#checkall").attr("checked"));
    }
</script>