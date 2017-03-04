<?php $content = unserialize($data["ct_content"])?>
<div style="width:100%;border-bottom: 1px dotted #CCCCCC;line-height: 25px">
    <table width="100%">
        <tr>
            <td width="5%"><?=($page-1)*$itemCount+$index+1?></td>
            <td><?=Correction::model()->getName($data->ct_sourceId, $data->ct_sourcetype)?></td>
            <td width="50%"><?=$data->ct_status==0?"请等待审核！":$data->ct_message?></td>
            <td width="8%"><?=Correction::$ct_status[$data->ct_status];?></td>
            <td width="13%"><?=date("m-d H:s",$data->ct_releasetime)?></td>
        </tr>
    </table>
</div>