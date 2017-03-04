<?php
Yii::app()->clientScript->registerCssFile("/css/css.css");
Yii::app()->clientScript->registerCssFile("/css/hy.css");
?>
<?php
$get = SearchMenu::explodeAllParamsToArray();
$this->widget('SearchMenu');
?>
<div class="sear_cont">
    <div class="rq_cont" style="width: auto">
        <span style="float:left;padding-top: 3px">按红牌数排序：</span>
        <a class="<?=(!isset($get["order"])||$get["order"]==1)?"clk":""?>" href="<?=Yii::app()->createUrl("/member/list",array(SearchMenu::$getName=>SearchMenu::dealOptions($get,"order",1)));?>">今日</a>
        <a class="<?=(isset($get["order"])&&$get["order"]==2)?"clk":""?>" href="<?=Yii::app()->createUrl("/member/list",array(SearchMenu::$getName=>SearchMenu::dealOptions($get,"order",2)));?>">本周</a>
        <a class="<?=(isset($get["order"])&&$get["order"]==3)?"clk":""?>" href="<?=Yii::app()->createUrl("/member/list",array(SearchMenu::$getName=>SearchMenu::dealOptions($get,"order",3)));?>">本月</a>
    </div>
</div>
<div>
    <?php
    foreach($dataProvider->getData() as $memberModel) {
        $this->renderPartial('_view',array(
            "memberModel"=>$memberModel,
        ));
    }
    echo '<div style="clear:both"></div>';
    $this->widget('CLinkPager',array(
            'pages'=>$dataProvider->pagination,
            "cssFile"=>"/css/pager.css"
    ));
    ?>
    
</div>