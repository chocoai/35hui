<style type="text/css">
    table a:link{color:#0041d9;  text-decoration: none; font-size: 14px; }
    table a:hover{color: #FF6600; font-size: 14px;}
    .jjritems{ width: 710px; display: inline-block; float: left; background-color: white; margin: 5px 0px 10px 0px; border-bottom: 1px dashed #999999; padding-bottom:5px;_padding-bottom:-5px;  _margin-bottom:0px; }
    .jjritems div a:link, .jjritems div a:visited{color:#0041d9; text-decoration: none;}
    .jjritems div a:hover{color: #FF6600;}
    .photo{float:left;width:100px;height: 130px; margin-right: 15px;  margin-top: 7px;}
    .table_01{}
    .table_01 td{ height: 22px; line-height: 22px;}
    .table_01 td a{ padding:0 5px; }
    .table_01 td a em{ color: #ff2200; font-size: 12px;}
</style>
<div class="jjritems">
	<div>
        <div class="img_border photo">
            <?=CHtml::link(CHtml::image(User::model()->getUserHeadPic($data->user_id),"",array("width"=>"100","height"=>"130")),array("/viewuagent/index",'uaid'=>$data->agentinfo->ua_id));?>
        </div>
        <div style="width:550px; float: left;">
            <table class="table_01">
                <tr>
                    <td>
                        <?=CHtml::link($data->agentinfo['ua_realname'],array("/viewuagent/index",'uaid'=>$data->agentinfo->ua_id));?>
                        <?=User::model()->getUserLevelByUserId($data->user_id)?> 
                    </td>
                </tr>
                <tr>
                    <td>所属公司：<?=Uagent::model()->getCompanyByUaid($data->agentinfo);?></td>
                </tr>
                <tr>
                    <td>服务区域：<?=Region::model()->getNameById($data->agentinfo->ua_district); ?></td>
                </tr>
                <tr>
                    <td>手机：<?=$data->user_tel; ?></td>
                </tr>
                <tr>
                    <td>最近登录：<?=common::dealShowTime($data->user_lasttime);?></td>
                </tr>
                <tr>
                    <td>介绍：<?= CHtml::encode(common::strCut($data->agentinfo->ua_post, 240)); ?></td>
                </tr>
                <tr>
                    <td><a href="<?=Yii::app()->createUrl("viewuagent/index",array("uaid"=>$data->agentinfo->ua_id));?>">全景房源<em>（<?=$data->user_subpnum; ?>）</em></a><a href="<?=Yii::app()->createUrl("viewuagent/uresidence",array("uaid"=>$data->agentinfo->ua_id));?>">住宅<em>（<?=$data->user_residencenum; ?>）</em></a><a href="<?=Yii::app()->createUrl("viewuagent/uoffice",array("uaid"=>$data->agentinfo->ua_id));?>">写字楼<em>（<?=$data->user_officenum; ?>）</em></a><a href="<?=Yii::app()->createUrl("viewuagent/ushop",array("uaid"=>$data->agentinfo->ua_id));?>">商铺<em>（<?=$data->user_shopnum; ?>）</em></a></td>
                </tr>
            </table>
        </div>
 	</div>	
</div>