<?php
if($cssType=="office") {
    if(!empty($recentViewInfo)) { 
    ?>
<div class="brow">
    <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
    <div class="br_cont">
        <h6>您在新地标浏览过</h6>
        <ul>
                <?php
                    foreach($recentViewInfo as $reViewInfo) {
                        if(!empty($reViewInfo)) {//子数组可能为空。
                            ?>
            <li>
                <span class="br_01"><?=CHtml::link(CHtml::encode(common::strCut($reViewInfo['title'], 30)),$reViewInfo['link'],array("title"=>$reViewInfo['title']));?></span>
                <span class="br_02"><?=$reViewInfo['price']?></span></li>

                            <?
                        }
                    }
                ?>
        </ul>
        <div class="c"></div>

    </div>
    <b class="xtop"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
</div>
    <?php
    }
}elseif($cssType=="shop") {
    if(!empty($recentViewInfo)) {
    ?>
<div class="brow">
    <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
    <div class="br_cont" >
        <h6>您在新地标浏览过</h6>
        <ul>
                <?php
                    foreach($recentViewInfo as $reViewInfo) {
                        if(!empty($reViewInfo)) {//子数组可能为空。
                            ?>
            <li>
                <span class="br_01"><?=CHtml::link(CHtml::encode(common::strCut($reViewInfo['title'], 30)),$reViewInfo['link'],array("title"=>$reViewInfo['title']));?></span>
                <span class="br_02"><?=$reViewInfo['price']?></span>
            </li>

                            <?
                        }
                    }
                ?>
        </ul>
    </div>
    <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
</div>
    <?php
    }
}elseif($cssType=="residence") {
     if(!empty($recentViewInfo)) {
    ?>
<div id="tworight">
    <div class="addspace" style="height:40px;"></div>
    <div class="brow">
        <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
        <div class="br_cont" >
            <h6>您在新地标浏览过</h6>
            <ul>
                    <?php
                        foreach($recentViewInfo as $reViewInfo) {
                            if(!empty($reViewInfo)) {//子数组可能为空。
                                ?>

                <li>
                    <span class="br_01"><?=CHtml::link(CHtml::encode(common::strCut($reViewInfo['title'], 30)),$reViewInfo['link'],array("title"=>$reViewInfo['title']));?></span>
                    <span class="br_02"><?=$reViewInfo['price']?></span>
                </li>
                                <?
                            }
                        }
                    ?>
            </ul>
        </div>
        <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
    </div>
</div>
    <?php
        }
        }elseif($cssType=="residenceIndex") {
            if(!empty($recentViewInfo)) {
    ?>
<div class="brow">
    <b class="xtop"> <b class="xb1"></b> <b class="xb2"></b> <b class="xb3"></b> </b>
    <div class="br_cont">
        <h6>您在新地标浏览过</h6>
        <ul>
                <?php
                    foreach($recentViewInfo as $reViewInfo) {
                        if(!empty($reViewInfo)) {//子数组可能为空。
                            ?>
            <li>
                <span class="br_01"><?=CHtml::link(CHtml::encode(common::strCut($reViewInfo['title'], 30)),$reViewInfo['link'],array("title"=>$reViewInfo['title']));?></span>
                <span class="br_02"><?=$reViewInfo['price']?></span></li>
                            <?
                        }
                    }
                ?>
        </ul>
    </div>
    <b class="xbottom"> <b class="xb3"></b> <b class="xb2"></b> <b class="xb1"></b> </b>
</div>
<?php }} ?>