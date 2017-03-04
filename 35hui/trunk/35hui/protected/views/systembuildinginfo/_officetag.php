<h3><a href="<?php $options['sourcetag'] = "";echo Yii::app()->createUrl($url,$options)?>">全部房源</a>&nbsp;&nbsp;
    <a href="<?php $options['sourcetag'] = "1";echo Yii::app()->createUrl($url,$options)?>">推荐房源</a>&nbsp;&nbsp;
    <a href="<?php $options['sourcetag'] = "2";echo Yii::app()->createUrl($url,$options)?>">多媒体房源</a>&nbsp;&nbsp;
    <a href="<?php $options['sourcetag'] = "3";echo Yii::app()->createUrl($url,$options)?>">全景房源</a>&nbsp;&nbsp;
    <a href="<?php $options['sourcetag'] = "4";echo Yii::app()->createUrl($url,$options)?>">急房源</a>&nbsp;&nbsp;
    <a href="<?php
        if($type=="sale"){
            echo Yii::app()->createUrl('/map/SendHand');
        }else if($type=="rent"){
            echo Yii::app()->createUrl('/map/rent');
        }else {
            echo Yii::app()->createUrl('/map/map');
        }
    ?>" target="_blank">地图搜索</a></h3>
            