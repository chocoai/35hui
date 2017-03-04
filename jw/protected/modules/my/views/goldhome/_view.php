<?php
$userModel = User::model()->findByPk($data['gh_golehomeuserid']);
$userMemberModel = Member::model()->findByAttributes(array("mem_userid"=>$userModel->u_id));
?>
<div class="sfline">
    <div class="sf_01"><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?></div>
    <div class="sf_02">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_230x250")?>" width="140px"></a>
    </div>
    <div class="sf_03">
        <h4><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>" class="ff0080" target="_blank"><?=$userModel->u_nickname?></a></h4>
        <p>
            <?=$userMemberModel->mem_height?$userMemberModel->mem_height."CM":""?>
            <?=$userMemberModel->mem_weight?$userMemberModel->mem_weight."KG":""?>
            <?php
            if($userMemberModel->mem_threesize) {
                $threesize = explode(",",$userMemberModel->mem_threesize);
                echo $threesize[0]."-".$threesize[1]."-".$threesize[2];
            }
            ?>
        </p>
        <p>
            <?=Region::model()->getNameById($userModel->u_district)?>
            <?=Region::model()->getNameById($userModel->u_section)?>
            <?=Companymanage::model()->getNameById($userMemberModel->mem_company)?>
        </p>
        <p>
            <?php
            if($userMemberModel->mem_qqhide==0&&$userMemberModel->mem_qq){
                echo "QQ：".$userMemberModel->mem_qq;
            }
            ?>
            <?php
            if($userMemberModel->mem_telhide==0&&$userMemberModel->mem_telephone){
                echo "TEL：".$userMemberModel->mem_telephone;
            }
            ?>
        </p>
        <p><?php
        if($data->gh_note){
            echo "备注：<span id='note_".$data->gh_id."'>".$data->gh_note."</span>";
        }
        ?></p>
    </div>
    <div class="sf_04 beginSplitType" attr="<?=$data["gh_id"]?>">
        <div class="sfgroup" style="display:none;"></div>
        <div style="width: 45px;overflow: hidden">
            <a href="javascript:;"><?=Common::strCut(Goldhomegroup::model()->getGroupNameById($data["gh_group"]),9,"")?></a>
        </div>
    </div>
    <div class="sf_05">
        <p><a href="javascript:;" onclick="addNote(<?=$data->gh_id?>)">添加备注</a></p>
        <p><a href="javascript:;" onclick="delGoldHome(<?=$data->gh_id?>)">解除收藏</a></p>
        <p><a href="javascript:;" onclick="sendUserMessage('<?=$data['gh_golehomeuserid']?>')">短信她</a></p>
    </div>
</div>