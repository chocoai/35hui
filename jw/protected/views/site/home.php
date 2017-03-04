<?php
Yii::app()->clientScript->registerCssFile("/css/css.css");
Yii::app()->clientScript->registerCssFile("/css/hy.css");
Yii::app()->clientScript->registerScriptFile("/js/memberhy.js",CClientScript::POS_END);
?>


<div class="pic_index"><img src="/images/index_1.jpg"></div>
<?=$this->renderPartial("/album/_boardorder");?>
<div style="border:none;" class="hymain">
    <div class="redtit">
			展示推荐
            <div style="float:right;font-weight: normal;font-size: 12px;"><a href="<?=Yii::app()->createUrl("/albumrecommend/index")?>" target="_blank">更多</a></div>
    </div>
</div>
<div>
    <?php
    foreach($albumRecommend as $value) {
        ?>
    <div class="sear_modle">
        <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$value->am_id))?>" target="_blank"><img src="<?=Album::model()->getAlbumcoverUrl($value, "_230x250")?>" width="230px" height="250px"/></a>
        <div class="s_m_tit">
                <?php
                $userModel = User::model()->getUserInfoById($value->am_userid);
                $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$value->am_userid));
                ?>
            <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>" target="_blank"><?=$userModel->u_nickname?></a>
            <em><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?></em>
                <?php $comName = Member::model()->getMemberCompany($memberModel);?>
            <code class="zsbg hd" title="红牌数"><?=$value->am_redboard?></code>
            <code class="zsbg" title="浏览量"><?=$value->am_visitnum?></code>
            
        </div>
        <p>
            <span title="<?=$comName?>"><?=Common::strCut($comName,30)?></span>
        </p>
    </div>
        <?php
    }
    ?>
</div>
<div class="pic_index"><img src="/images/index_2.jpg"></div>
<div style="border:none;" class="hymain">
    <div class="redtit">
			新人推荐
    </div>
</div>
<div class="red_main">
    <?php
    foreach($memberRecommend as $value){
        $userModel = User::model()->getUserInfoById($value->mem_userid);
        ?>
    <div class="redmod">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$value->mem_userid));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel)?>"></a>
        <p><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$value->mem_userid));?>" target="_blank"><?=$userModel->u_nickname?></a> <code title="红牌数"><?=$value->mem_redboard?></code></p>
        <?php $com = Member::model()->getMemberCompany($value);?>
        <p title="<?=$com?>"><?=Common::strCut($com,27)?></p>
    </div>
    <?php
    }
    ?>
    
    
</div>
<div class="pic_index"><img src="/images/index_3.jpg"></div>
<div class="pic_index"><img src="/images/index_4.jpg"></div>
<div class="pic_index"><img src="/images/index_5.jpg"></div>