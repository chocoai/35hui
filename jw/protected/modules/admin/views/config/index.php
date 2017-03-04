<?php
$this->breadcrumbs=array(
        '详细配置',
);
?>
<form action="" method="post" onsubmit="return checkSubmit()">
    <table>
        <tr>
            <td>序号</td>
            <td>值</td>
            <td>描述</td>
        </tr>
        <?php
        foreach($list as $key=>$value) {
            ?>
        <tr>
            <td align="right"><?=$key+1?></td>
            <td><input type="text" name="<?=$value->conf_key?>" value="<?=$value->conf_value?>" /></td>
            <td><?=$value->conf_description?></td>
        </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="修改" /></td>
            <td>&nbsp;</td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    function checkSubmit(){
        var preg = /^[1-9][0-9]*$/
        var check = 1;
        $("form input").not("input[type='submit']").each(function(){
            var value = $.trim($(this).val());
            if(!preg.test(value)){
                jw.pop.alert("值不能为空，且必须是数字！",{autoClose:1000,icon:2})
                check = 0;
            }
        })
        if(check){
            return true;
        }else{
            return false;
        }
    }
    $(document).ready(function(){
<?php if(Yii::app()->user->hasFlash('message')): ?>
        jw.pop.alert("<?=Yii::app()->user->getFlash('message')?>",{autoClose:1000})
<?php endif; ?>
    });
</script>