<?php
$this->breadcrumbs=array(
	'完善与纠错'=>array('index'),
	$model->ct_id,
);

$this->menu=array(
	array('label'=>'返回列表', 'url'=>array('index')),
);
?>
<style type="text/css">
    table td{border-bottom:1px dotted #009}
    .oneDiv{border: 1px solid #298DCD;width:45%;padding: 10px}
</style>
<?php if(Yii::app()->user->hasFlash('message')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('message'); ?>
    </div>
<?php endif; ?>
<div style="width:100%;">
    <div style="float: left;" class="oneDiv"><b>原始内容：</b>
        <table width="100%">
            <?php
			
            foreach($correction as $key=>$value){
				if(isset($oldSource[$key])){
            ?>
            <tr>
                <td><?php
                    if($key=="cp_traffic"||$key=="cp_peripheral"||$key=="sbi_peripheral"||$key=="sbi_traffic"||$key=="sbi_floorinfo"){
                        
						$arr=unserialize($oldSource[$key]);
                        if($key=="cp_traffic"||$key=="cp_peripheral"){
                            $num=$key=="cp_peripheral"?"1":"3";
                            $arr=Creativeparkbaseinfo::model()->ArrayKeyReplice($arr,$num);
                        }
						if($arr&&is_array($arr)){
							foreach($arr as $k=>$v){
								echo $k.":".$v."<hr/>";
							}
						}
                    }else{
                        echo CHtml::encode($oldSource->getAttributeLabel($key))."：".$oldSource[$key];
                    }?>
                </td>
            </tr>
            <?php
                }
            }
            if(isset($correction["picture"])){//如果用户有图片纠错，就要显示以前的图片。好让审核人员操作
                echo "<tr><td>";
                
                $sourceType=1;
                if($model->ct_sourcetype==2){
                    $sourceType=7;
                }else if($model->ct_sourcetype==3){
                    $sourceType=9;
                }
                
                $pic = Picture::model()->getPicturesByCondition($model->ct_sourceId, $sourceType, 1);
                echo "<b>平面图</b>(共&nbsp;".count($pic)."&nbsp;张)<br />";
                foreach($pic as $value){
                    echo "<span style='padding:5px;'>".CHtml::image(PIC_URL.Picture::showStandPic($value->p_img,"_large"),"",array("width"=>"150px","height"=>"100px"))."</span>";
                }
                echo "<br />";
                $pic = Picture::model()->getPicturesByCondition($model->ct_sourceId, $sourceType, 2);
                echo "<b>外景图</b>(共&nbsp;".count($pic)."&nbsp;张)<br />";
                foreach($pic as $value){
                    echo "<span style='padding:5px;'>".CHtml::image(PIC_URL.Picture::showStandPic($value->p_img,"_large"),"",array("width"=>"150px","height"=>"100px"))."</span>";
                }
                echo "<br />";
                $pic = Picture::model()->getPicturesByCondition($model->ct_sourceId, $sourceType, 3);
                echo "<b>室内图</b>(共&nbsp;".count($pic)."&nbsp;张)<br />";
                foreach($pic as $value){
                    echo "<span style='padding:5px;'>".CHtml::image(PIC_URL.Picture::showStandPic($value->p_img,"_large"),"",array("width"=>"150px","height"=>"100px"))."</span>";
                }
                echo "</td></tr>";
            }
            ?>
        </table>
    </div>
    <div style="float: right;" class="oneDiv"><b>纠错内容：</b>
        <form action="/correction/audit/id/<?=$_GET["id"]?>" method="post" id="correctionForm">
        <table width="100%">
        <?php
            $allNum = 0;
            foreach($correction as $key=>$value){
                if(isset($oldSource[$key])){$allNum++;
            ?>
            <tr>
                <td> <?php if($key=="cp_traffic"||$key=="cp_peripheral"||$key=="sbi_peripheral"||$key=="sbi_traffic"||$key=="sbi_floorinfo"){
                        $arr=unserialize($value);
                         if($key=="cp_traffic"||$key=="cp_peripheral"){
                            $num=$key=="cp_peripheral"?"1":"3";
                            $arr=Creativeparkbaseinfo::model()->ArrayKeyReplice($arr,$num);
                        }
						if($arr&&is_array($arr)){
							foreach($arr as $k=>$v){
								echo $k.":".$v."<hr/>";
							}
						}
                    }else{
                        echo CHtml::encode($oldSource->getAttributeLabel($key))."：".$value;
                    }?>&nbsp;&nbsp;&nbsp;&nbsp;
                    <span>
                        <input type="button" value="采用" onclick="passOn(this,'')" />
                        <input type="button" value="不采用"onclick="unPassOn(this)" />
                    </span>
                    <input type="hidden" value="0" name="<?=$key?>" />
                </td>
            </tr>
            <?php
                }
            }
            if(isset($correction["picture"])){
                echo "<tr><td>";
                $picture = Correction::model()->formartPic($correction["picture"]);
                foreach($picture as $value){$allNum++;
                    echo "<span style='padding:5px;'>";
                    echo CHtml::link(CHtml::image(PIC_URL.Picture::showStandPic($value[0],"_small"),"",array("width"=>"100px")),PIC_URL.$value[0],array("target"=>"_blank"));
                    echo CHtml::dropDownList("",$value[1],Picture::$typeDescription,array("onChange"=>"changeValue(this)"));
                    ?>
                        <span>
                            <input type="button" value="采用" onclick="passOn(this,'pic')" />
                            <input type="button" value="不采用"onclick="unPassOn(this)" />
                        </span>
                    <input type="hidden" value="<?=$value[0]."_".$value[1]?>" name="picture[]" />
                    <?php
                    echo "</span><br />";
                }
                echo "</td></tr>";
            }
        ?>
        </table>
        </form>
    </div>
</div>
<input type="hidden" value="<?=$allNum?>" name="allNum" id="allNum" />
<div style="clear:both;height: 5px"></div>
<div style="width: 100%;border-top: 1px solid aqua;text-align: center">
    <input type="button" value="提交纠错表单" onclick="return validateForm()" />
</div>
<script type="text/javascript">
var allNum = $("#allNum").val();
$(document).ready(function(){
    
    <?php
    if($model->ct_status!=0){
    ?>
    $("input").css("display","none");
    <?php
    }
    ?>
});
function passOn(obj,type){//采用
    allNum--;
    if(type=="pic"){
    }else{
        $(obj).parent().nextAll("input[type='hidden']").val("1");
    }
    $(obj).parent().html("<img src='/images/onValid.gif' />")
}
function unPassOn(obj){//不采用
    allNum--;
    $(obj).parent().nextAll("input[type='hidden']").val("0");
    $(obj).parent().html("<img src='/images/onError.gif' />")
}
function validateForm(){
    if(allNum!=0){
        alert("请处理完所有的栏目在点击提交！");
        return false;
    }
    $('#correctionForm').submit();
}
function changeValue(obj){
    var value = $(obj).val();
    var hidden = $(obj).nextAll("input:hidden").val();
    var arr = hidden.split("_");
    $(obj).nextAll("input:hidden").val(arr[0]+"_"+value);
}
</script>