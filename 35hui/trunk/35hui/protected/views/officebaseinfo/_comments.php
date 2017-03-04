<ul class="loupaninfo_fivelinebulone">
    <? $userIndexLink = User::model()->getUserShowIndexUrl($data->oc_cid); ?>
    <li class="one">
        <a href="<?=$userIndexLink?>">
            <?php $headPic = User::model()->getUserHeadPic($data->oc_cid,'_small');echo CHtml::image($headPic,'Logo',array('height'=>'50px','width'=>'50px','class'=>'img_border'));?>
        </a>
    </li>
    <li class="two" style="width:590px;">
        <dl>
        <dt>
            <a href="<?=$userIndexLink?>"><?=User::model()->getNamebyid($data->oc_cid)?></a>
            <?=User::model()->getUserLevelByUserId($data->oc_cid)?>
        </dt>
        <dd class="loupaninfo_ddone">
            <div style="float:left;width:50px;height:18px;">交通：</div>
            <div style="width:100px;float:left;">
                <?=common::getStar($data->oc_traffice,100)?>
            </div>
            <div style="float:left;width:60px;height:18px;">周围设施：</div>
            <div style="width:100px;float:left;">
                <?=common::getStar($data->oc_facility,100)?>
            </div>
            <div style="float:left;width:50px;height:18px;">装修：</div>
            <div style="width:80px;float:left;">
                <?=common::getStar($data->oc_adorn,100)?>
            </div>
        </dd>
        <dd class="loupaninfo_ddtwo"><?php echo nl2br(CHtml::encode($data->oc_comment));?></dd>
        </dl>
    </li>
</ul>
