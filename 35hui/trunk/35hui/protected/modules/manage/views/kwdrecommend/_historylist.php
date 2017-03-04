<tr>
    <td class="txt">
        <?=CHtml::link($data->kwrh_name, Kwdrecommend::model()->getShowUrl($data->kwrh_name, $data->kwrh_buildtype, $data->kwrh_sellorrent),array("target"=>"_blank","style"=>"color:blue"))?>
        <?="(".Kwdrecommend::model()->getSellOrRent($data->kwrh_sellorrent)."、".Kwdrecommend::model()->getBuildType($data->kwrh_buildtype).")"?>
    </td>
    <td class="txt"><?=date("Y-m-d H:s",$data->kwrh_buytime);?></td>
    <td class="txt"><?=date("Y-m-d H:s",$data->kwrh_expiredtime);?></td>
</tr>