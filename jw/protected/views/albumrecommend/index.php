?php
Yii::app()->clientScript->registerCssFile("/css/css.css");
Yii::app()->clientScript->registerCssFile("/css/hy.css");
?>
<div class="logo"><a href="/">logo</a></div>
<div class="vocation-mark">
    <a href="" class="mark c66dfff-bg">个人</a>
    <a href="" class="mark c9c0-bg">设计插画</a>
</div>
<div class="clear"></div>
<div class="update_m">
    <h1>展示更新</h1>
    <div class="update_mlf">
        <p><a href="<?=Yii::app()->createUrl("/albumrecommend/index",array("type"=>1));?>">今天</a></p>
        <p><a href="<?=Yii::app()->createUrl("/albumrecommend/index",array("type"=>2));?>">昨天</a></p>
        <p><a href="<?=Yii::app()->createUrl("/albumrecommend/index",array("type"=>3));?>">前天</a></p>
    </div>
    <div class="update_mrt">
        <?php
        foreach($recommendInfo as $value) {
            $albumModel = Album::model()->findByPk($value->ar_amid);
            if($albumModel) {
                $userModel = User::model()->getUserInfoById($albumModel->am_userid);
                $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$albumModel->am_userid));
                ?>
        <div class="day_mod">
            <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$albumModel->am_id))?>" target="_blank"><img src="<?=Album::model()->getAlbumcoverUrl($albumModel, "_230x250")?>" width="150px" height="160px"/></a>
            <div class="day1"><?=$userModel->u_nickname?></div>
            <?php $comName = Member::model()->getMemberCompany($memberModel);?>
            <div class="day2"><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?> <a href="" title="<?=$comName?>"><?=Common::strCut($comName,24)?></a></div>
            <div class="day3">
                <a class="zsbg" title="红牌数"><?=$albumModel->am_redboard?></a>
                <a class="zsbg" title="浏览量"><?=$albumModel->am_visitnum?></a>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
</div>