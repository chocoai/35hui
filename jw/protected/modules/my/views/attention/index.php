<div class="mright">
    <?=$this->renderPartial('/dynamicmy/_top');?>
    <div class="jbmain">
        <div class="yue">我共关注了<em><?=$count?></em>人</div>
        <div class="dx_tit">
            <a href="<?=Yii::app()->createUrl("/my/attention/index",array("type"=>User::ROLE_AUDIENCE));?>" class="<?=$type==User::ROLE_AUDIENCE?"clk":""?>"><?=User::$authRolesName[User::ROLE_AUDIENCE]?></a>
            <a href="<?=Yii::app()->createUrl("/my/attention/index",array("type"=>User::ROLE_MEMBER));?>" class="<?=$type==User::ROLE_MEMBER?"clk":""?>"><?=User::$authRolesName[User::ROLE_MEMBER]?></a>
        </div>
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_view',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css",
                "viewData"=>array("type"=>$type),
        )); ?>
    </div>
</div>