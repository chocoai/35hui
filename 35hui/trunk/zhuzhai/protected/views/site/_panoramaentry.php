<div class="mrccount">
    <h2><!--<a href="">&gt;&gt; 更多</a>-->全景足迹</h2>
    <div class="mrc_cont" id="marquee-panorama" pause="3000" style="height:250px; overflow:hidden; clear:both;">
        <ul>
        <?php
            if($panoramaentry){
                foreach($panoramaentry as $value){
                    $href = '';
                    $buildId = $value->p_buildingid;
                    if($value->p_ptype==2){
                        $href = Yii::app()->createUrl("/communitybaseinfo/view",array("id"=>$buildId));
                        $showName=common::strCut(Communitybaseinfo::model()->getCommunityNameById($buildId),28);
                    }else{
                        $href = Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>$buildId));
                        $showName=common::strCut(Systembuildinginfo::model()->getBuildNameById($buildId),28);
                    }
        ?>
            <li><img src="<?=IMAGE_URL?>/tip.gif" alt=""/><?=date('m月d日',$value->p_uploadtime);?>拍摄<a href="<?php echo $href;?>"><?=$showName?></a>全景</li>
         <?php }}?>
        </ul>
    </div>
</div>
