<?php
$memberModel = Member::model()->findByAttributes(array("mem_userid"=>User::model()->getId()));
$myredboard = $memberModel->mem_redboard;//我的红牌数目

$maxRedBoard = $allLevel[count($allLevel)-1]["ml_redboards"];//最大等级需要红牌数数
$levelNum = count($allLevel)-1;//级别数目
$width = 500;//显示总宽度
$oneLevelWidth = intval(($width-10)/($levelNum));//每一个级别所占宽度
?>
<div style="float:left;width:<?=$width?>px;height:70px;">
    <div style="margin-left:10px;display: inline;float: left;height: 25px;width: <?=$width?>px;border-top: 1px solid red;border-right: 1px solid red;border-bottom: 1px solid red;overflow:hidden">
        <div style="position:absolute;cursor: pointer;display: inline">
            <?php
            for($i=0;$i<$levelNum;$i++) {
                echo '<div style="float:left;color:red;height:25px;border-left: 1px solid red;padding-left:'.$oneLevelWidth.'px" title="'.$allLevel[$i]["ml_name"].'"></div>';
            }
            ?>
        </div>
        <?php
        $mylevel = 0;
        for($i=0;$i<$levelNum+1;$i++){
            if($allLevel[$i]["ml_redboards"]<=$myredboard) {
                $mylevel = $i;
            }
        }
        if($mylevel>=$levelNum){//如果满级了
            $showWidth = $width;
        }else{//还没有满级
            $baseWidth = $mylevel*$oneLevelWidth;
            $nextLevelBoard = $allLevel[$mylevel+1]["ml_redboards"];//下一级需要红牌数，如果已经满级，则用最大的1倍
            $betweenBoard = $nextLevelBoard-$allLevel[$mylevel]["ml_redboards"];//本级和下一级之间需要的红牌数目
            $mybetweenBoard = $myredboard-$allLevel[$mylevel]["ml_redboards"];//本级和下一级之间我有的红牌数目
            $oneBoardWidth = $oneLevelWidth/$betweenBoard;//本级和下一级之间一个红牌占用的宽度
            $showWidth = $baseWidth+$oneBoardWidth*$mybetweenBoard;//我的宽度
        }
        ?>
        <div style="padding-left:1px;height:25px;width: <?=$showWidth?>px;background-color: green;"></div>
    </div>
    <div style="padding: 0px;height: 40px;width: 800px;clear: both">
        <?php
        for($i=0;$i<=$levelNum;$i++) {
            echo '<div style="float:left;height:40px;width:'.$oneLevelWidth.'px" title="'.$allLevel[$i]["ml_name"].'">'.$allLevel[$i]["ml_name"].'<br />(<font style="color:#F09">'.$allLevel[$i]["ml_redboards"].'</font>)</div>';
        }
        ?>
    </div>
</div>