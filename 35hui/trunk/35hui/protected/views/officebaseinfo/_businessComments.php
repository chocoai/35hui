<ul class="serach_moremenu">
    <li class="two"><strong><?=CHtml::link("商务中心概述",array("businessSummarize",'opid'=>$officeBaseinfo->ob_officeid),array('name'=>'tab'))?></strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心详情",array("businessDetail",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("平面图",array("businessIchnography",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("房源照片",array("businessOtherPicture",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="one"><strong>商务中心点评</strong></li>
</ul>
<div class="serach_morelefttwobox">
    <!--商务中心点评 start-->
    <!-- 评论模块 开始 -->
    <div id="brightChild5">
        <h3><strong>商务中心点评</strong></h3>
        <ul class="loupan_twoleftulone">
            <li class="four">
                <?=CHtml::link("查看更多商务中心点评&gt;&gt;",array('officebaseinfo/allBusinessComments','opid'=>$officeBaseinfo->ob_officeid));?>
            </li>
        </ul>
        <div class="swzxdianpin">
            <div class="loupaninfo_fivelinebox">
                <?php
                foreach($recentComments as $comment){
                ?>
                <ul class="loupaninfo_fivelinebulone">
                    <? $userIndexLink = User::model()->getUserShowIndexUrl($comment->oc_cid); ?>
                    <li class="one">
                        <a href="<?=$userIndexLink?>">
                            <?php $headPic = User::model()->getUserHeadPic($comment->oc_cid,'_small');echo CHtml::image($headPic,'Logo',array('height'=>'50px','width'=>'50px','class'=>'img_border'));?>

                        </a>
                    </li>
                    <li class="two" style="width:590px;">
                        <dl>
                        <dt>
                            <a href="<?=$userIndexLink?>"><?=User::model()->getNamebyid($comment->oc_cid)?></a>
                            <?=User::model()->getUserLevelByUserId($comment->oc_cid)?>
                        </dt>
                        <dd class="loupaninfo_ddone" style="width:500px;">
                            <div style="float:left;width:50px;height:18px;">交通：</div>
                            <div style="width:100px;float:left;">
                                <?=common::getStar($comment->oc_traffice,100)?>
                            </div>
                            <div style="float:left;width:60px;height:18px;">周围设施：</div>
                            <div style="width:100px;float:left;">
                                <?=common::getStar($comment->oc_facility,100)?>
                             </div>
                            <div style="float:left;width:50px;height:18px;">装修：</div>
                            <div style="width:80px;float:left;">
                                <?=common::getStar($comment->oc_adorn,100)?>
                            </div>
                        </dd>
                        <dd class="loupaninfo_ddtwo"><?php echo nl2br(CHtml::encode($comment->oc_comment));?></dd>
                        </dl>
                        </li>
                </ul>
                <?php
                }
                ?>
            </div>
            <?php $this->renderPartial('/officebaseinfo/_businessCommentForm',array('newCommentModel'=>$newCommentModel,'officeid'=>$officeBaseinfo->ob_officeid,)); ?>
        </div>
    </div>
    <!-- 评论模块 结束 -->
</div>
