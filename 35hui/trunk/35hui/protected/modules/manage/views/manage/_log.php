<tr>
    <td class="txt"><?=common::showFormatDateTime($data->lg_recodetime); ?></td>
    <td class="txt"><em><?=$data->lg_gainorlose==1?"+":"-"?><?=$data->lg_score?></em></td>
    <td class="txt"><?php echo CHtml::encode($data->lg_description); ?></td>
</tr>