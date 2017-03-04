<?php
$this->breadcrumbs=array(
    '出售出租',
	'更新商铺出售信息',
);
?>
<?php
$arr=Oprationconfig::model()->getConfigByName('release');
$tui_num=$arr['1'];
$ji_num=$arr['2'];
?>
<div class="htit" style="margin-bottom:10px;">更新商铺出售信息</div>
<?php 
            $this->renderPartial('_formdiscribe', array(
                'shopBaseInfoModel'=>$shopBaseInfoModel,
                'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
                'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
                'shopTagModel'=>$shopTagModel,//标签
                'shopSellInfoModel'=>$shopSellInfoModel,//出租信息
                "type"=>"sell",
                'opt'=>"update",
                'ifUpdate'=>true
            ));
?>

<script type="text/javascript">
function validateForm(){
    if(!submitValidate()){
        return false;
    }else{
        var oldHurry = <?=$shopTagModel->st_ishurry?>;
        var oldRecommend = <?=$shopTagModel->st_isrecommend?>;
        var money = <?=$updateNeedMoney?>;
        //计算要花费的新币。
        var recommend = $(":radio[name='st_isrecommend']:checked").val();
        var sumStr='';
        if(oldRecommend!=recommend&&recommend==1){
            money += <?=$tui_num?>;
            sumStr += ",推荐房源扣<?=$tui_num?>点"
            if(<?=$recommendNum[0]-$recommendNum[1]?><=0){
                alert("抱歉，您已经达到允许设推荐房源的最大值，请去除选择推荐房源按键在尝试提交。")
                return false;
            }
        }
        var hurry = $(":radio[name='st_ishurry']:checked").val();
        if(oldHurry!=hurry&&hurry==1){
            money += <?=$ji_num?>;
            sumStr += ",急房源扣<?=$ji_num?>点"
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