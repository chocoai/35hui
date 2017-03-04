<?php
$model = Uagent::model()->findByPk($_GET['uaid']);
?>
<div class="toplgn">
    <div class="llogo"><?=CHtml::link(CHtml::image("/images/llogo.gif"),DOMAIN)?></div>
    <div class="links">
        <?=CHtml::link("写字楼","/office");?>			 <span>-</span>
        <?=CHtml::link("商铺","/shop");?>			 <span>-</span>
        <?=CHtml::link("地图找房","/map");?>		 <span>-</span>
        <?=CHtml::link("经纪人","/uagent/showuagent");?>			 <span>-</span>
        <?=CHtml::link("资讯","/news/day");?>
    </div>
</div>
<div class="thead">
    <div class="jjrdetail">
        <div class="jieshao">
            <?=$model->ua_post ? CHtml::encode($model->ua_post) : '暂无店铺公告'; ?>
        </div>
    </div>
</div>
<div class="mupai">
    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <?= CHtml::image(User::model()->getUserHeadPic($model->ua_uid, "_normal"), 'Logo', array('height' => '100px', 'width' => '80px')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if(Uagent::model()->getIdentityCertification($model->ua_uid)) {
                                echo CHtml::image(IMAGE_URL."/icon/sf.gif","已认证",array("title"=>"身份已认证 "));
                            }else{
                                echo CHtml::image(IMAGE_URL."/icon/sf_gray.gif","未认证",array("title"=>"身份证未认证 "));
                            }
                            echo "&nbsp;";
                            if(Uagent::model()->getSeniorityCertification($model->ua_uid)) {
                                echo CHtml::image(IMAGE_URL."/icon/zy.gif","已认证",array("title"=>"名片已认证 "));
                            }else{
                                echo CHtml::image(IMAGE_URL."/icon/zy_gray.gif","未认证",array("title"=>"名片未认证 "));
                            }
                            echo "&nbsp;";
                            if(Uagent::model()->getBindingBusiness($model->ua_uid)) {
                                echo CHtml::image(IMAGE_URL."/icon/gsdefy.gif","已认证",array("title"=>"营业执照已认证"));
                            }else{
                                echo CHtml::image(IMAGE_URL."/icon/gsdefy_gray.gif","未认证",array("title"=>"执照未认证 "));
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <?php $UserModel = User::model()->findByPk($model->ua_uid);?>
                    <tr><td width="65px">姓名：</td><td><?php echo CHtml::encode($model->ua_realname); ?></td></tr>
                    <tr><td width="65px">等级：</td><td><?= User::model()->getUserLevelByUserId($model->ua_uid) ?></td></tr>
                    <tr><td>注册时间：</td><td><?php echo date("Y-m-d", $UserModel->user_regtime); ?></td></tr>
                    <tr><td>服务区域：</td><td><?=Region::model()->getNameById($model->ua_district)?>-<?=Region::model()->getNameById($model->ua_section)?></td></tr>
                    <tr><td>公司门店：</td><td style="padding-right:17px;"><?php echo Uagent::model()->getCompanyByUaid($model) ?></td></tr>
                    <tr><td>电话：</td><td><?=$UserModel->user_tel;?></td></tr>
                </table>
            </td>
        </tr>
    </table>
</div>