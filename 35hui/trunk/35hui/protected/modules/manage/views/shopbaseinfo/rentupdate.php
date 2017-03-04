<?php
$this->breadcrumbs=array(
    '出售出租',
	'更新商铺出租信息',
);
?>
<?php
$arr=Oprationconfig::model()->getConfigByName('release');
$tui_num=$arr['1'];
$ji_num=$arr['2'];
?>
<div class="htit" style="margin-bottom:10px;">更新商铺出租信息</div>
<?php 
            echo $this->renderPartial('_formdiscribe', array(
                'shopBaseInfoModel'=>$shopBaseInfoModel,
                'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
                'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
                //'shopTagModel'=>$shopTagModel,//标签
                'shopRentInfoModel'=>$shopRentInfoModel,//出租信息
                "type"=>"rent",
                'opt'=>"update",
                'ifUpdate'=>true
            ));
?>
<script type="text/javascript">
//点击提交时触发此函数
function validateForm(){
   
    if(!submitValidate()){
        return false;
    }
     
    return true;
}
</script>