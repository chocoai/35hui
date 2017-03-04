<?php 
    //判断是不是起始页面
    $isBegin = true;
    foreach($items as $item) {
        if($item['active'])
            $isBegin = false;
        }
    foreach($items as $key=>$item){
        if($item['active']||($isBegin==true)&&($item['label']=="新房地图")){
            echo '<label class="select">'.$item['label'].'</label>';
        }
        else{
            echo CHtml::link($item['label'],$item['url']);
        }
        if($key<count($items)-1){
            echo "|";
        }
    }
?>
