<div class="zftnav">
    <ul>
        <li class="clk">我的档案</li>
    </ul>
</div>
<div class="jbmain">
    <?=$this->renderPartial("_leftmembermenu")?>
    <div class="jbcont">
        <h1>修改头像</h1>
        <div class="ln">
            <table width="100%">
                <tr valign="top">
                    <td width="280px">
                        <img src="<?=$url?>" id="target" alt="Flowers" width="280px"/>

                    </td>
                    <td>
                        <form method="post" action="<?=Yii::app()->createUrl("/my/info/savephoto");?>" onsubmit="return checkCoords();">
                            <div style="margin-left: 10px;">
                                <h2>预览头像</h2>
                                <div style="width:130px;height:140px;overflow:hidden;border: 1px solid #CCC;">
                                    <img src="<?=$url?>" id="preview" alt="Preview"/>
                                </div>
                                <div style="margin-left: 10px;margin-top: 10px">
                                    <input type="image" src="/images/save.png" />
                                </div>
                                <div style="display: none">
                                    <input type="hidden" id="x" name="x" />
                                    <input type="hidden" id="y" name="y" />
                                    <input type="hidden" id="w" name="w" />
                                    <input type="hidden" id="h" name="h" />
                                    <input type="hidden"  name="picid" value="<?=$_GET["picid"]?>"/>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script src="/js/jcrop/jquery.Jcrop.js" type="text/javascript"></script>
<link rel="stylesheet" href="/js/jcrop/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript">
    jQuery(function($){
        var jcrop_api, boundx, boundy;
        $('#target').Jcrop({
            onChange: updatePreview,
            onSelect: updatePreview,
            aspectRatio: 1,
            bgColor: 'white',
            borderOpacity: 0
        },function(){
            var bounds = this.getBounds();
            boundx = bounds[0];
            boundy = bounds[1];
            jcrop_api = this;
            jcrop_api.animateTo([100,100,230,240]);
            jcrop_api.setOptions({
                minSize: [ 65, 70  ],
                maxSize: [ 195, 210 ]
            });
            jcrop_api.setOptions({aspectRatio: 13/14 });
        });
        function updatePreview(c){
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);

            if (parseInt(c.w) > 0)
            {
                var rx = 130 / c.w;
                var ry = 140 / c.h;

                $('#preview').css({
                    width: Math.round(rx * boundx) + 'px',
                    height: Math.round(ry * boundy) + 'px',
                    marginLeft: '-' + Math.round(rx * c.x) + 'px',
                    marginTop: '-' + Math.round(ry * c.y) + 'px'
                });
            }
        };

    });
    function checkCoords(){
        if (parseInt($('#w').val())) return true;
        jw.pop.alert("请选择区域！",{autoClose:1000,icon:2})
        return false;
    };
</script>