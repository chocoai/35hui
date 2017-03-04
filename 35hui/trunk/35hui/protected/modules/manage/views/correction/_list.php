<?php $content = unserialize($data["ct_content"])?>
<tr>
    <td class="txt"><?=$index+1?></td>
    <td class="txt"><?=Correction::model()->getName($data->ct_sourceId, $data->ct_sourcetype)?></td>
    <td class="txt"><?=$data->ct_status==0?"请等待审核！":$data->ct_message?></td>
    <td><?=Correction::$ct_status[$data->ct_status];?></td>
    <td class="txt"><em><?=date("Y-m-d H:s",$data->ct_releasetime)?></em></td>
</tr>