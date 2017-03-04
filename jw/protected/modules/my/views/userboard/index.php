<?=$this->renderPartial('/dynamicmy/_top');?>
<div class="jbmain">
    <form onsubmit="return submitForm()" action="#">
        <table style="margin-bottom: 10px" width="100%">
            <tr>
                <td>昵称:<input type="text" name="nickname" value="<?=isset($search["nickname"])?$search["nickname"]:""?>"/></td>
                <td>打牌对象:
                    <select name="type">
                        <option value="0">全部</option>
                        <option value="1" <?=isset($search["type"])&&$search["type"]=="1"?"selected":""?>>本身</option>
                        <option value="2" <?=isset($search["type"])&&$search["type"]=="2"?"selected":""?>>相册</option>
                    </select>
                </td>
                <td>
                    打牌时间:
                    <select name="time">
                        <option value="0">不限</option>
                        <option value="1" <?=isset($search["time"])&&$search["time"]=="1"?"selected":""?>>今日</option>
                        <option value="2" <?=isset($search["time"])&&$search["time"]=="2"?"selected":""?>>本周</option>
                        <option value="3" <?=isset($search["time"])&&$search["time"]=="3"?"selected":""?>>本月</option>
                    </select>
                </td>
                <td>类型:
                    <select name="boardtype">
                        <option value="0" >全部</option>
                        <option value="1" <?=isset($search["boardtype"])&&$search["boardtype"]=="1"?"selected":""?>>红牌</option>
                        <option value="2" <?=isset($search["boardtype"])&&$search["boardtype"]=="2"?"selected":""?>>黑牌</option>
                    </select>
                </td>
                <td>
                    <input type="image" src="/images/search.gif" style="height:24px"/>
                </td>
            </tr>
        </table>
    </form>
    <table width="100%" border="1">
        <tr>
            <th width="60px">序号</th>
            <th width="100px">打牌者</th>
            <th>打牌对象</th>
            <th width="200px">打牌时间</th>
            <th width="40px">类型</th>
        </tr>
        <?php
        $page = isset($_GET["page"])&&$_GET["page"]?$_GET["page"]:1;
        $pageSize = $dataProvider->pagination->pageSize;
        foreach($dataProvider->getData() as $number=>$data) {
            $this->renderPartial('_view', array(
                    'data'=>$data,
                    "number"=>$number,
                    "page"=>$page,
                    "pageSize"=>$pageSize
            ));
        }
        ?>
    </table>
    <?php
    $this->widget('CLinkPager',array(
            'pages'=>$dataProvider->pagination,
            "cssFile"=>"/css/pager.css"
    ));
    ?>

</div>
<script type="text/javascript">
function submitForm(){
    $("form input[name='nickname']").val($.trim($("form input[name='nickname']").val()));//去除空格
    var form = $("form").serialize();
    form = form.replace(/nickname=&/,"");
    form = form.replace(/type=0&/,"");
    form = form.replace(/time=0&/,"");
    form = form.replace(/boardtype=0/,"");
    var href = "<?=$baseurl?>";
    href = href.replace(/\?.*$/,"");
    if(form){
        href += "?"+form;
    }
    window.location.href = href;
    return false;
}
</script>