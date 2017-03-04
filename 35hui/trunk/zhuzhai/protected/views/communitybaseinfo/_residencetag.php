<ul class="serach_moremenu">
    <?
        if(!isset($showTab) || $showTab==false){
            $showTab = array(1,2,3,4,5,6);
        }
    ?>
    <?
    if(in_array(1, $showTab)){
    ?>
    <li class="<?=(!array_key_exists('sourcetag', $options) || $options['sourcetag']=="")?"one":"two"?>"><strong><a href="<?php echo Yii::app()->createUrl($url)?>">全部房源</a></strong></li>
    <?
    }
    ?>
    <?
    if(in_array(2, $showTab)){
    ?>
    <li class="<?=array_key_exists('sourcetag', $options)&&$options['sourcetag']==1?"one":"two"?>"><strong><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions(array(), "sourcetag", "1"))?>">推荐房源</a></strong></li>
    <?
    }
    ?>
    <?
    if(in_array(3, $showTab)){
    ?>
    <li class="<?=array_key_exists('sourcetag', $options)&&$options['sourcetag']==3?"one":"two"?>"><strong><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions(array(), "sourcetag", "3"))?>">全景房源</a></strong></li>
    <?
    }
    ?>
    <?
    if(in_array(4, $showTab)){
    ?>
    <li class="<?=array_key_exists('sourcetag', $options)&&$options['sourcetag']==4?"one":"two"?>"><strong><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions(array(), "sourcetag", "4"))?>">急房源</a></strong></li>
    <?
    }
    ?>
    <?
    if(in_array(5, $showTab)){
    ?>
    <li class="three">
        <strong>
            <a href="<?php
                if($type=="sale"){
                    echo Yii::app()->createUrl('/map/SendHand');
                }else if($type=="rent"){
                    echo Yii::app()->createUrl('/map/rent');
                }else {
                    echo Yii::app()->createUrl('/map/map');
                }
            ?>" target="_blank">地图搜索</a>
        </strong>
    </li>
    <?
    }
    ?>
</ul>