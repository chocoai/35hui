<?php
if($type=='office'){
?>
<tr>
    <td width="30%"><?=common::strCut($data->ob_officename, 30)?></td>
    <td><a href="<?php
        if($data->ob_sellorrent==1){//出租
            echo Yii::app()->createUrl("/officebaseinfo/rentView",array("id"=>$data->ob_officeid));
        }else{//出售
            echo Yii::app()->createUrl("/officebaseinfo/saleView",array("id"=>$data->ob_officeid));
        }
    ?>" target="_blank"><?php echo common::strCut($data->presentInfo->op_officetitle, 60); ?></a></td>
    <td width="15%">
        <?php
            if($data->offictag->ot_isbuyregion==1){//区域推广
                echo "已推荐";
            }else{
                echo "<a href='javascript:recommend(".$data->ob_officeid.")'>推荐</a>";
            }
        ?>
    </td>
</tr>
<?php
}elseif($type=='shop'){
?>
<tr>
    <td width="10%"><?php echo $data->sb_shopid; ?></td>
    <td><a href="<?php echo Yii::app()->createUrl("/shop/view",array("id"=>$data->sb_shopid));?>" target="_blank"><?php echo common::strCut($data->presentInfo->sp_shoptitle, 60); ?></a></td>
    <td width="15%">
        <?php
            if($data->shopTag->st_isbuyregion==1){//首页显示
                echo "已推荐";
            }else{
                echo "<a href='javascript:recommend(".$data->sb_shopid.")'>推荐</a>";
            }
        ?>
    </td>
</tr>
<?php
}else{
?>
<tr>
    <td width="10%"><?php echo $data->rbi_id; ?></td>
    <td><a href="<?php echo Yii::app()->createUrl("/communitybaseinfo/viewResidence",array("id"=>$data->rbi_id));?>" target="_blank"><?php echo common::strCut($data->rbi_title, 60); ?></a></td>
    <td width="15%">
        <?php
            if($data->residenceTag->rt_isbuyregion==1){//首页显示
                echo "已推荐";
            }else{
                echo "<a href='javascript:recommend(".$data->rbi_id.")'>推荐</a>";
            }
        ?>
    </td>
</tr>
<?php
}