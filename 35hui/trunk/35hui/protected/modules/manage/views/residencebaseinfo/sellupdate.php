<?php
$this->breadcrumbs=array(
    '出售出租',
	'房源修改',
);
?>
<div class="htit" style="margin-bottom:10px;">修改出售住宅</div>

<?php
            $this->renderPartial('_sellform', array(
                'model'=>$model,
                'sellModel'=>$sellModel,
                'tagModel'=>$tagModel,
                'districtlist'=>$districtlist,
                'allLoop'=>$allLoop,
                "releaseNeedMoney"=>$releaseNeedMoney,
                'modelSelect'=>'',
                "type"=>"sale",
                'opt'=>""
            ));
?>

<script type="text/javascript">
function validateForm(){
    if(!submitValidate()){
        return false;
    }else{
        var oldHurry = <?=$tagModel->rt_ishurry?>;
        var oldRecommend = <?=$tagModel->rt_isrecommend?>;
        var money = <?=$updateNeedMoney?>;
        //计算要花费的新币。
        var recommend = $(":radio[name='rt_isrecommend']:checked").val();
        var sumStr='';
        if(oldRecommend!=recommend&&recommend==1){
            money += <?=$releaseNeedMoney[1]?>;
            sumStr += ",推荐房源扣<?=$releaseNeedMoney[1]?>点"
            if(<?=$recommendNum[0]-$recommendNum[1]?><=0){
                alert("抱歉，您已经达到允许设推荐房源的最大值，请去除选择推荐房源按键在尝试提交。")
                return false;
            }
        }
        var hurry = $(":radio[name='rt_ishurry']:checked").val();
        if(oldHurry!=hurry&&hurry==1){
            money += <?=$releaseNeedMoney[2]?>;
            sumStr += ",急房源扣<?=$releaseNeedMoney[2]?>点"
            if(<?=$hurryNum[0]-$hurryNum[1]?><=0){
                alert("抱歉，您已经达到允许设急房源的最大值，请去除选择急房源按键在尝试提交。")
                return false;
            }
        }
        if(sumStr){
            sumStr=",其中修改房源扣<?=$updateNeedMoney?>点"+sumStr;
        }
        if(!confirm("共需要扣除"+money+"点新币"+sumStr+"。确定修改吗？")){
            return false;
        }
    }
}
</script>