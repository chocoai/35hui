<?php
$tdis->breadcrumbs=array(
        'DYFW全景图片下载',
);
$this->currentMenu = 92;
$url = PIC_URL."/site/panopreview/panoId/".$panoId;
$defaultUrl = $url."?start_pan=".$defaultParama["start_pan"]."&start_tilt=".$defaultParama["start_tilt"]."&start_fov=".$defaultParama["start_fov"]."&min_pan=".$defaultParama["min_pan"]."&min_tilt=".$defaultParama["min_tilt"]."&min_fov=".$defaultParama["min_fov"]."&max_pan=".$defaultParama["max_pan"]."&max_tilt=".$defaultParama["max_tilt"]."&max_fov=".$defaultParama["max_fov"];
?>
<iframe src="<?=$defaultUrl?>" width="700px" height="350px" id="frame" scrolling="no"></iframe>
<br />

<div style="border: 1px black solid;padding: 10px">
    <form action="/dyfw/download" id="form" method="post">
        <table width="100%">
            <tr>
                <td></td>
                <td>平视角度</td>
                <td>俯仰角度</td>
                <td>缩进</td>
            </tr>
            <tr>
                <td>起始位置</td>
                <td><input type="text" name="start_pan" value="<?=$defaultParama["start_pan"]?>" id="start_pan"/></td>
                <td><input type="text" name="start_tilt" value="<?=$defaultParama["start_tilt"]?>" id="start_tilt"/></td>
                <td><input type="text" name="start_fov" value="<?=$defaultParama["start_fov"]?>" id="start_fov"/></td>
            </tr>
            <tr>
                <td>最小位置</td>
                <td><input type="text" name="min_pan" value="<?=$defaultParama["min_pan"]?>" id="min_pan"/></td>
                <td><input type="text" name="min_tilt" value="<?=$defaultParama["min_tilt"]?>" id="min_tilt"/></td>
                <td><input type="text" name="min_fov" value="<?=$defaultParama["min_fov"]?>" id="min_fov"/></td>
            </tr>
            <tr>
                <td>最大位置</td>
                <td><input type="text" name="max_pan" value="<?=$defaultParama["max_pan"]?>" id="max_pan"/></td>
                <td><input type="text" name="max_tilt" value="<?=$defaultParama["max_tilt"]?>" id="max_tilt"/></td>
                <td><input type="text" name="max_fov" value="<?=$defaultParama["max_fov"]?>" id="max_fov"/></td>
            </tr>
        </table>
        <input type="hidden" name="panoId" value="<?=$panoId?>" />
        <input type="hidden" name="name" value="<?=$name?>" />
        <div style="width:100%">
            <span style="margin-right: 50px">
                <a href="javascript:review()">修改参数后重新预览</a>
            </span>
            <span style="margin-right: 50px">
                <a href="javascript:reset()">恢复默认参数</a>
            </span>
            <span style="margin-right: 50px">
                <a href="javascript:download()">按以上参数下载</a>
            </span>
            <span>
                <?=CHtml::checkBox("picMask",false,array("id"=>"picMask"));?><label for="picMask">为顶部增加水印(室外全景才可勾选)</label>
            </span>
        </div>
    </form>
</div>
<script type="text/javascript">
    function review(){
        var baseUrl = "<?=$url?>";
        var pa = $("#form").serialize();
        baseUrl = baseUrl+"?"+pa;
        $("#frame").attr("src",baseUrl);
        $("#frame").reload();
    }
    function reset(){
        $("#start_pan").val("<?=$defaultParama["start_pan"]?>");
        $("#start_tilt").val(<?=$defaultParama["start_tilt"]?>);
        $("#start_fov").val(<?=$defaultParama["start_fov"]?>);

        $("#min_pan").val(<?=$defaultParama["min_pan"]?>);
        $("#min_tilt").val(<?=$defaultParama["min_tilt"]?>);
        $("#min_fov").val(<?=$defaultParama["min_fov"]?>);

        $("#max_pan").val(<?=$defaultParama["max_pan"]?>);
        $("#max_tilt").val(<?=$defaultParama["max_tilt"]?>);
        $("#max_fov").val(<?=$defaultParama["max_fov"]?>);

        var url = "<?=$defaultUrl?>";
        $("#frame").attr("src",url);
        $("#frame").reload();
    }
    function download(){
        $("#form").submit();
    }
</script>