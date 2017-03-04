<form method="post" class="form" action="#">
    <table width="350px">
        <tr style="line-height: 35px;">
            <td>标题：</td>
            <td><input type="text" name="title" onkeyup="message_check_inputNum()" onblur="message_check_inputNum()" style="border: 1px solid #D7D5D6;height: 24px;line-height: 24px;padding: 0px 3px;width: 260px;" /></td>
            <td><em class="numShowMsg">0</em>/50</td>
        </tr>
        <tr>
            <td valign="top">内容：</td>
            <td align="left"><textarea onkeyup="message_check_textareaNum()" onblur="message_check_textareaNum()" style="border: 1px solid #D7D5D6;height: 150px;overflow: auto;padding: 0px 3px;width: 260px;" name="content"></textarea></td>
            <td valign="top"><em class="numShowMsg">0</em>/150</td>
        </tr>
    </table>
     <input type="hidden" name="check_title" value="1" />
    <input type="hidden" name="check_content" value="1" />
</form>