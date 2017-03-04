<?php 
Yii::app()->clientScript->registerScriptFile("/js/memberhy.js",CClientScript::POS_END);
$memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userModel->u_id))
        ?>
<div class="clear"></div>
<div class="ren_msg">
    <div class="rmpic">

        <img src="<?=User::model()->getUserHeadPhoto($userModel,"_130x140")?>" />
    </div>
    <div class="rmtxt">
        <h2><?=$userModel->u_nickname?> <em><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?></em></h2>
        <p>
            <?=$memberModel->mem_height?$memberModel->mem_height."CM":""?>
            <?=$memberModel->mem_weight?$memberModel->mem_weight."KG":""?>
            <?php
            if($memberModel->mem_threesize) {
                $threesize = explode(",",$memberModel->mem_threesize);
                echo $threesize[0]."-".$threesize[1]."-".$threesize[2];
            }
            ?>
        </p>
        <p style="width: 190px;overflow: hidden;line-height: 27px">
            <?=Region::model()->getNameById($userModel->u_nativeprovince)?>人@
            <?php
            if($memberModel->mem_company) {//有公司
                $company = Companymanage::model()->findByPk($memberModel->mem_company);
                echo Region::model()->getNameById($company->cm_district).' <a style="color:#999;text-decoration:underline;" href="javascript:;" onclick="showCompanyDescribe(\'companydescribe\')">'.$company->cm_companyname."</a>";
                ?>
            <span style="display:none" id="companydescribe">
                公司名称：<?=$company->cm_companyname?><br />
                人均消费：<?=$company->cm_avgconsume?>元<br />
                公司地址：<?=$company->cm_address?>
            </span>
                <?php
            }else {//自由人
                echo Region::model()->getNameById($userModel->u_district)." ".Region::model()->getNameById($userModel->u_section);
            }
            ?>
        </p>
        <div class="p">
            <a href="javascript:;" onclick="addAttention(<?=$userModel->u_id?>)"class="bg" title="关注后能及时获取会员的最新动态">关注</a>
            <a href="javascript:;" onclick="addGoldHome(<?=$userModel->u_id?>)"class="bg" title="收藏后能查看更完整的会员信息，如工号、QQ、电话号码。">收藏</a>
        </div>

    </div>
</div>
<div class="ren_des" style="word-wrap:break-word;word-break:break-all;">
    <table style="height: 125px;line-height: 30px;">
        <tr>
            <td>
                <?php
                $speak = Userspeak::model()->getLastSpeak($userModel->u_id);
                if($speak) {
                    echo CHtml::encode($speak->us_content);
                }
                ?>
            </td>
        </tr>
    </table>
</div>
<div class="flsh">
    <div class="userboard" id="userboarddiv">
        <div class="rbticket">
            <div class="percent">
                <?php
                $all = $memberModel->mem_redboard+$memberModel->mem_blackboard;
                $redPercent = $all!=0?intval(($memberModel->mem_redboard/$all)*100):0;
                $blakPercent = $all!=0?intval(($memberModel->mem_blackboard/$all)*100):0;
                ?>
                <div class="tiao" ratio="$redPercent" id="pingjia" style="width: <?=$redPercent?>%; ">
                    <p>
                        好评率：<?=$redPercent?>%
                        差评率：<?=$blakPercent?>%
                    </p>
                </div>
            </div>
            <a href="javascript:;" class="btnleft voteRecommend" tp="<?=$userModel->u_id?>_1"></a>
            <a href="javascript:;" class="btnright voteRecommend" tp="<?=$userModel->u_id?>_2"></a>
            <div class="pnum">
                <span class="fl">红票：<span id="red"><?=$memberModel->mem_redboard?></span>票</span>
                <span class="fr">黑票：<span id="black"><?=$memberModel->mem_blackboard?></span>票</span>
            </div>
        </div>
    </div>
</div>

<?php
$controller = trim(Yii::app()->controller->getId());
?>
<div class="mnav">
    <ul>
        <li class="<?=$controller=="user"?"clk":""?>">
            <div class="arrow2" style="display:<?=$controller=="user"?"":"none"?>"></div>
            <?=CHtml::link("首页",array("/user/view","id"=>$userModel->u_id))?>
        </li>
        <li class="<?=$controller=="album"?"clk":""?>">
            <div class="arrow2" style="display:<?=$controller=="album"?"":"none"?>"></div>
            <?=CHtml::link("展示",array("/album/index","id"=>$userModel->u_id))?>
        </li>
        <li class="<?=$controller=="userspeak"?"clk":""?>">
            <div class="arrow2" style="display:<?=$controller=="userspeak"?"":"none"?>"></div>
            <?=CHtml::link("动态",array("/userspeak/index","id"=>$userModel->u_id))?>
        </li>
    </ul>
</div>
<?php
if($this->breadcrumbs) {
    $return = array();
    foreach($this->breadcrumbs as $key=>$value) {
        if(is_array($value)) {
            $return[] = CHtml::link($key,$value);
        }else {
            $return[] = CHtml::link($value,"#");
        }
    }
    echo '<div class="zstit">'.implode(" > ",$return)."</div>";
}
?>