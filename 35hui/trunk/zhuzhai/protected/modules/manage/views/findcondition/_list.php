<?php
switch ($data->fc_officetype){
    default:
        $baseUrl = "#";
        break;
    case Findcondition::building :
        $baseUrl = "/systembuildinginfo/buildlist";
        break;
    case Findcondition::business :
        $baseUrl = "/officebaseinfo/rentBusinessList";
        break;
    case Findcondition::office :
        if($data->fc_rentorsell==Findcondition::rent){
            $baseUrl = "/officebaseinfo/rentIndex";
        }else{
            $baseUrl = "/officebaseinfo/saleIndex";
        }
        break;
    case Findcondition::shop :
        if($data->fc_rentorsell==Findcondition::rent){
            $baseUrl = "/shop/rentIndex";
        }else{
            $baseUrl = "/shop/sellIndex";
        }
        break;
    case Findcondition::residence :
        if($data->fc_rentorsell==Findcondition::rent){
            $baseUrl = "/communitybaseinfo/rentIndex";
        }else{
            $baseUrl = "/communitybaseinfo/sellIndex";
        }
        break;
}
?>
<tr>
    <td width="10%" class="txt"><?=@Findcondition::$officeTypeDes[$data->fc_officetype] ?></td>
    <td width="60%" class="txt">
        <?=CHtml::link(implode("+",Findcondition::model()->getFindCondition($data->fc_conditionstr)),Yii::app()->createUrl($baseUrl,SearchMenu::dealOptions(json_decode($data->fc_conditionstr,true))),array("target"=>"_blank"));?>
    </td>
    <td width="15%" class="txt"><?=common::showFormatDateTime($data->fc_recordtime);?></td>
    <td width="10%" class="txt"><?=CHtml::link("删除",'#',array('submit'=>array('delete','id'=>$data->fc_id),'confirm'=>'你确定要删除此记录吗?'))?></td>
</tr>