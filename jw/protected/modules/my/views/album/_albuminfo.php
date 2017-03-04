<h2>红黑榜</h2>
<div class="mlccont">
    <div style="border-right:1px solid #BBBBBB;" class="mlmodel active"><p><?=$albummodel->am_redboard?></p><p>红牌</p></div>
    <div class="mlmodel"><p><?=$albummodel->am_blackboard?></p><p>黑牌</p></div>
    <div class="mline">
        <?php
        $all = $albummodel->am_redboard+$albummodel->am_blackboard;
        ?>
        好评率：<?=$all!=0?intval(($albummodel->am_redboard/$all)*100):0?>%
        差评率：<?=$all!=0?intval(($albummodel->am_blackboard/$all)*100):0?>%
    </div>
</div>
<h2>类别</h2>
<div class="miaos"><?=Album::$am_albumtype[$albummodel->am_albumtype]?></div>
<h2>描述</h2>
<div class="miaos">
    <?=CHtml::encode($albummodel->am_albumdescribe)?>
</div>