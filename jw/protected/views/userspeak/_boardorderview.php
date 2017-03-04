<?php
foreach($boardOrder as $value) {
    $userModel = User::model()->getUserInfoById($value->mem_userid)
    ?>
<div class="hyrline">
    <div class="hyr_pic">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="60px"/></a>
    </div>
    <div class="hyr_txt">
        <p><?=$userModel->u_nickname?> <em><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?></em></p>
        <p style="width: 155px;overflow: hidden;height: 20px">
            <?=Region::model()->getNameById($userModel->u_nativeprovince)?>人@
            <?php
            if($value->mem_company) {//有公司
                $company = Companymanage::model()->findByPk($value->mem_company);
                echo Region::model()->getNameById($company->cm_district).' <a style="color:#999;text-decoration:underline;" href="javascript:;" onclick="showCompanyDescribe(\''.$va.'_order_'.$userModel->u_id.'\')">'.$company->cm_companyname."</a>";
                ?>
            <span style="display:none" id="<?=$va?>_order_<?=$userModel->u_id?>">
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
        <p> 
            <img src="/images/dian.png" title="红牌数" /> <span title="红牌数"><?=$value[$key[$va][0]]?></span>
            <img src="/images/dian.png" title="浏览数" /> <span title="浏览数"><?=$userModel->u_visitnum?></span>
        </p>
    </div>
</div>
    <?php
}
?>
