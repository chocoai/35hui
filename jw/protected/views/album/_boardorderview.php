<?php
foreach($boardOrder as $key=>$value) {
    if($key>6){
        break;
    }
    $userModel = User::model()->getUserInfoById($value->mem_userid)
            ?>
<div class="redmod">
    <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id));?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_130x140")?>" width="130px"/></a>
    <p><a href="javascript:;"><?=$userModel->u_nickname?></a> <code><?=Memberlevel::model()->getUserLevelName($userModel->u_id)?></code></p>
    <p style="height: 22px;width: 125px;overflow: hidden">
            <?=Region::model()->getNameById($userModel->u_nativeprovince)?>人@
            <?php
            if($value->mem_company) {//有公司
                $company = Companymanage::model()->findByPk($value->mem_company);
                echo Region::model()->getNameById($company->cm_district).' <em onclick="showCompanyDescribe(\''.$va.'_order_'.$userModel->u_id.'\')" style="cursor:pointer">'.$company->cm_companyname."</em>";
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
</div>
    <?php
}
?>
