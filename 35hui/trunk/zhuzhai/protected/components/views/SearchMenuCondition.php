<?php
$condition=urlencode($conditionJson);
$tParams = SearchMenu::explodeAllParamsToArray();
?>
<?php 
if($officeType==Findcondition::office){
    ?>
<div class="scclick">
    <em>您已选择：</em>
        <?php if($html){
            echo implode("",$html);
        }else{
            echo '[<span style="color:#22468B;"> 无 </span>]';
        }
        if($html){
            if($saveCondition){
                echo CHtml::link('保存条件',"#",array('id'=>'subscribe',"onclick"=>"saveCondition()","style"=>"background:none; border:none;line-height:20px;"));
            }
            echo CHtml::link('清空条件',Yii::app()->createUrl(Yii::app()->controller->route),array("style"=>"background:none; border:none;line-height:20px;"));
        }?>
</div>
    <?php
}else{
    ?>
<div class="scclick"><em>搜房条件:</em>
        <?php if($html){
            echo implode("",$html);
        }else{
            echo '[<span style="color:#22468B;"> 无 </span>]';
        }
        if($html){
            if($saveCondition){
                echo '<a id="subscribe" href="#" style="background:none; border:none;line-height:20px;" onclick="saveCondition()">保存条件</a>';
            }
            echo CHtml::link('清空条件',Yii::app()->createUrl(Yii::app()->controller->route),array('style'=>'background:none; border:none;line-height:20px;'));
        }?>
</div>
        <?php } ?>

<input id="condition" type="hidden" value="<?=$condition?>">
<input id="officeType" type="hidden" value="<?=urlencode($officeType)?>">
<input id="rentorsell" type="hidden" value="<?=urlencode($rentorsell)?>">
<script type="text/javascript">
    $(function(){
        $("#kwords").val("<?=empty($tParams[SearchMenu::$diyCondition])?"":urldecode($tParams[SearchMenu::$diyCondition])?>");
    });
    var saveState = true;
    function saveCondition(){
        if(saveState){
            var condition = $("#condition").val();
            var officeType = $("#officeType").val();
            var rentorsell = $("#rentorsell").val();
            $.ajax({
                type: "POST",
                url: "<?=Yii::app()->createUrl('findcondition/ajaxAddCondition');?>",
                data: {condition:condition,officeType:officeType,rentorsell:rentorsell},
                success: function(result){
                    if(result==1){
                        alert("只有个人用户才能保存！");
                    }else if(result==3){
                        saveState = false;
                        alert("保存条件成功");
                    }else if(result==4){
                        alert("请先登录!");
                    }else{
                        alert("保存失败");
                    }
                }
            });
        }else{
            alert("该条件已经保存");
        }
    }
</script>
