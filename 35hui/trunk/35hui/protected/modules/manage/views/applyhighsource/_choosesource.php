<table width="100%">
    <tr>
        <?php
        if($typeName=="office") {
        ?>
        <td width="30%"><?=common::strCut($data->ob_officename, 30)?></td>
        <td width="60%"><?=$data->offictag->ot_ispanorama?CHtml::image(IMAGE_URL."/panorama_square.gif"):""?><?=common::strCut($data->presentInfo->op_officetitle, 75)?></td>
        <td><?=CHtml::link("申请设优","#",array("onClick"=>"setSource(".$data->ob_officeid.")","style"=>"color:blue"));?></td>
         <?php
        }elseif($typeName=="shop") {
        ?>
        <td width="90%"><?=$data->shopTag->st_ispanorama?CHtml::image(IMAGE_URL."/panorama_square.gif"):""?><?=common::strCut($data->presentInfo->sp_shoptitle, 105)?></td>
        <td><?=CHtml::link("申请设优","#",array("onClick"=>"setSource(".$data->sb_shopid.")","style"=>"color:blue"));?></td>
        <?php
        }elseif($typeName=="residence") {
        ?>
        <td width="90%"><?=$data->residenceTag->rt_ispanorama?CHtml::image(IMAGE_URL."/panorama_square.gif"):""?><?=common::strCut($data->rbi_title, 105)?></td>
        <td><?=CHtml::link("申请设优","#",array("onClick"=>"setSource(".$data->rbi_id.")","style"=>"color:blue"));?></td>
        <?php }?>
    </tr>
</table>