<form method="post" class="form" action="#">
    <table width="350px">
        <tr style="line-height: 35px;">
            <td>备注：</td>
            <td><input type="text" name="title" onkeyup="message_check_inputNum()" onblur="message_check_inputNum()" style="border: 1px solid #D7D5D6;height: 24px;line-height: 24px;padding: 0px 3px;width: 260px;" /></td>
            <td><em class="numShowMsg">0</em>/50</td>
        </tr>
    </table>
     <input type="hidden" name="check_title" value="1" />
</form>