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
    }
    return true;
}
</script>