<style type="text/css">
.loupaninfo_fivelinebulone li.one {float: left; padding: 0; width: 70px; text-align: center; display: block;}
.loupaninfo_fivelinebulone li.two {    border-bottom: 1px solid #D5D5D5;  color: #585858; float: left; padding: 0;display:inline-block;overflow: hidden;width: 590px;}
</style>
<ul class="loupaninfo_fivelinebulone" style="position:relative;">
    <? $userIndexLink = User::model()->getUserShowIndexUrl($data->sbc_cid); ?>
    <li class="one">
        <a href="<?=$userIndexLink?>">
            <div style="width:50px;height: 50px;" class="img_border">
            <?php
                $headPic = User::model()->getUserHeadPic($data->sbc_cid, "_small");
                echo CHtml::image($headPic,'',array('width'=>'50px'));
            ?>
            </div>
        </a>
    </li>
    <li class="two">
        <dl>
            <dt>
                <a style="float:left;" href="<?=$userIndexLink?>"><?=User::model()->getNamebyid($data->sbc_cid)?></a>
                <?=User::model()->getUserLevelByUserId($data->userInfo['user_id'])?><br />
            </dt>
            <dd style="float:right;">发表于&nbsp;<?=date("Y-m-d H:i:s",$data->sbc_comdate)?></dd>

            <dd class="loupaninfo_ddone" style="display:block; width: 590px; overflow: hidden;">
                <div style="float:left;width: 100%">
                    <div style="width:140px; float:left">
                        <span style="float:left;">交通：</span>
                        <?=common::getStar($data->sbc_traffice)?>
                    </div>
                    <div style="width:155px; float:left">
                        <span style="float:left;">周围设施：</span>
                        <?=common::getStar($data->sbc_facility)?>
                    </div>
                    <div style="width:140px; float:left">
                        <span style="float:left;">装修：</span>
                        <?=common::getStar($data->sbc_adorn)?>
                    </div>
                    <div style="width:140px; float:left">
                        <span style="float:left; margin-right: 3px;_margin-left:0;">总评：</span>
                        <span style="  display:block; float:left;">
                            <? $avgStar = round(($data->sbc_traffice+$data->sbc_facility+$data->sbc_adorn)/3);?>
                            <?=common::getStar($avgStar)?>
                        </span>
                    </div>
                </div>
            </dd>
            <dd class="loupaninfo_ddtwo"><?=CHtml::encode($data->sbc_comment)?></dd>
        </dl>
    </li>
</ul>