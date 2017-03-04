<form method="post" class="form">
    <table width="350px">
        <tr style="line-height: 35px;">
            <td width="60px">相册标题：</td>
            <td align="left" width="245px"><input onkeyup="album_check_inputNum(this)" onblur="album_check_inputNum(this)" value="" name="title" style="border: 1px solid #D7D5D6;height: 24px;line-height: 24px;padding: 0px 3px;width: 230px;" /></td>
            <td><em class="numShowMsg">0</em>/15</td>
        </tr>
        <tr>
            <td valign="top">相册描述：</td>
            <td align="left"><textarea onkeyup="album_check_textareaNum(this)" onblur="album_check_textareaNum(this)" style="border: 1px solid #D7D5D6;height: 70px;overflow: auto;padding: 0px 3px;width: 230px;" name="description"></textarea></td>
            <td valign="top"><em class="numShowMsg">0</em>/150</td>
        </tr>
        <tr style="line-height: 35px;">
            <td valign="top">相册类型：</td>
            <td align="left"><?=CHtml::dropDownList("type", "", Album::$am_albumtype)?></td>
            <td valign="top">&nbsp;</td>
        </tr>
    </table>
    <input type="hidden" name="check_title" value="1" />
    <input type="hidden" name="check_description" value="1" />
</form>
<?php Yii::app()->clientScript->registerScriptFile('/js/album.js',CClientScript::POS_END );?>