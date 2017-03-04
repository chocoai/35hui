<table class="manage_tabletwo" width="100%" border="0" cellpadding="5" cellspacing="5">
    <tr>
        <td width="60%">
            <?=CHtml::link($data->kwrh_name, Kwdrecommend::model()->getShowUrl($data->kwrh_name, $data->kwrh_buildtype, $data->kwrh_sellorrent),array("target"=>"_blank","style"=>"color:blue"))?>
            <?="(".Kwdrecommend::model()->getSellOrRent($data->kwrh_sellorrent)."、".Kwdrecommend::model()->getBuildType($data->kwrh_buildtype).")"?>
        </td>
        <td width="20%"><?=date("Y-m-d H:s",$data->kwrh_buytime);?></td>
        <td><?=date("Y-m-d H:s",$data->kwrh_expiredtime);?></td>
    </tr>
</table>