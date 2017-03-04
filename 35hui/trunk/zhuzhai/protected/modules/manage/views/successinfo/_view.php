<tr>
    <td width="5%" class="txt"><input type="checkbox" name="check[<?php echo $data->si_id?>]"/></td>
    <td width="25%" class="txt" align="left"><?=$data->si_buildname?></td>
    <td class="txt"><?=Successinfo::$si_floortype[$data->si_floortype]?></td>
    <td class="txt"><?=$data->si_area?>m<sup>2</sup></td>
    <td class="txt"><?=$data->si_companyname?></td>
    <td class="txt"><?=date("Y-m-d",$data->si_successtime);?></td>
    <td class="txt"><?=CHtml::link("修改",array('update','id'=>$data->si_id));?> <?=CHtml::link("删除",'#',array('submit'=>array('delete','id'=>$data->si_id),'confirm'=>'你确定要此成交记录吗?'))?></td>
</tr>