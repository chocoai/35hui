<table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo" style="margin-top:20px">
    <tr>
        <th style="text-align:left" colspan="2"><font style="margin-left:15px">图片上传&nbsp;&nbsp;图片大小必须在2M以内(jpg、jpeg、png、gif 格式)</font></th>
    </tr>
    <tr>
        <td style="text-align:right">内景图</td>
        <td>
            <iframe name="indoor" width="600px" height="225px" scrolling="no" src="<?php echo YII::app()->createUrl('/picture/uploadframe',array("type"=>3,'sourceType'=>$sourceType)) ?>" frameborder="0"></iframe>
            <input type="hidden" name="picture[indoor]" id="indoor_hidden" value="" />
        </td>
    </tr>
    <tr>
        <td style="text-align:right">外景图</td>
        <td>
            <iframe name="outdoor" width="600px" height="225px" scrolling="no" src="<?php echo YII::app()->createUrl('/picture/uploadframe',array("type"=>2,'sourceType'=>$sourceType)) ?>" frameborder="0"></iframe>
            <input type="hidden" name="picture[outdoor]" id="outdoor_hidden" value="" />
        </td>
    </tr>
    <tr>
        <td style="text-align:right" width="15%">平面图</td>
        <td>
            <iframe name="ichnograph" width="600px" height="225px"  scrolling="no" src="<?php echo YII::app()->createUrl('/picture/uploadframe',array("type"=>1,'sourceType'=>$sourceType)) ?>" frameborder="0"></iframe>
            <input type="hidden" name="picture[ichnograph]" id="ichnograph_hidden" value="" />
        </td>
    </tr>
    <tr>
        <td style="text-align:right" valign="top">标题图</td>
        <td style="text-align:left">
            <img src="<?=IMAGE_URL?>/p-lack.jpg" id="titlepic_img" />请选择上面任意一幅图片作为标题图
            <input type="hidden" name="picture[titlepic]" id="titlepic_hidden" value="" />
        </td>
    </tr>
</table>