<?php
if($sourceType==1){//写字楼
?>
<tr align="center" >
        <td width="5%" class="txt">
            <input name="chk[]" type="checkbox" value="<?php echo $data->ob_officeid; ?>" onclick='unselectall()'/>
            <?php $checkOrderRefresh = Sourceorderrefresh::model()->checkOrderRefresh($data->ob_officeid, "office");?>
            <input type="hidden" id="<?php echo $data->ob_officeid; ?>_isOrder" value="<?=$checkOrderRefresh?>">
        </td>
        <td width="37%" class="txt" align="left">
            <?php echo CHtml::link($data->ob_officename,array('/systembuildinginfo/view',"id"=>$data->ob_sysid),array("style"=>"float:left","target"=>"_blank"));?>
            <span><?php
            echo $data->ob_officearea."平&nbsp;";
            if($data->ob_sellorrent==1){//出租就显示租金
                echo $data->rentInfo->or_rentprice."元";
            }else{//出售就显示售价
                echo $data->sellInfo->os_sumprice."万";
            }
            ?></span><br />
            <?php
            if($data->ob_sellorrent==1){//出租就显示租金
                $url = array("/officebaseinfo/rentView",'id'=>$data->ob_officeid);
             }else{
                 $url = array("/officebaseinfo/saleView",'id'=>$data->ob_officeid);
             }
            echo CHtml::link(common::strCut($data->presentInfo->op_officetitle, 42),$url,array("style"=>"float:left","target"=>"_blank","title"=>$data->presentInfo->op_officetitle));
            if($data->ob_sellorrent==1){
                $url = Yii::app()->createUrl('/manage/viewoffirent/update',array('orid'=>$data->ob_officeid));
            }else{
                $url = Yii::app()->createUrl('/manage/viewoffisell/update',array('osid'=>$data->ob_officeid));
            }
            ?>
            <span><a href="<?php echo $url; ?>">编辑</a></span>
        </td>
        <td class="txt">
        <?php echo CHtml::encode($data->offictag->ot_illegalreason); ?>
    </td>
</tr>
<?php
}elseif($sourceType==2){//商铺
?>
<tr align="center" >
    <td width="5%" class="txt">
        <input name="chk[]" type="checkbox" value="<?php echo $data->sb_shopid; ?>" onclick='unselectall()'/>
        <?php $checkOrderRefresh = Sourceorderrefresh::model()->checkOrderRefresh($data->sb_shopid, "shop");?>
        <input type="hidden" id="<?php echo $data->sb_shopid; ?>_isOrder" value="<?=$checkOrderRefresh?>">
    </td>
    <td width="37%" class="txt" align="left">
        <span><?php
        echo $data->sb_shoparea."平&nbsp;";
        if($data->sb_sellorrent==1){//出租就显示租金
            echo $data->rentInfo->sr_rentprice."元";
        }else{//出售就显示售价
            echo $data->sellInfo->ss_sumprice."万";
        }
        ?></span><br />
        <?php
        if($data->sb_sellorrent==1){//出租就显示租金
            $url = array("/shop/view",'id'=>$data->sb_shopid);
         }else{
             $url = array("/shop/view",'id'=>$data->sb_shopid);
         }
        echo CHtml::link(common::strCut($data->presentInfo->sp_shoptitle, 42),$url,array("style"=>"float:left","target"=>"_blank","title"=>$data->presentInfo->sp_shoptitle));
        if($data->sb_sellorrent==1){
            $url = Yii::app()->createUrl('/manage/shopbaseinfo/rentupdate',array('id'=>$data->sb_shopid));
        }else{
            $url = Yii::app()->createUrl('/manage/shopbaseinfo/sellupdate',array('id'=>$data->sb_shopid));
        }
        ?>
        <span><a href="<?php echo $url; ?>">编辑</a></span>
    </td>
    <td class="txt">
        <?php echo CHtml::encode($data->shopTag->st_illegalreason);?>
    </td>
</tr>
<?php
}elseif($sourceType==3){//住宅
?>
<tr>
    <td width="5%" class="txt">
        <input name="chk[]" type="checkbox" value="<?php echo $data->rbi_id; ?>" onclick='unselectall()'/>
        <?php $checkOrderRefresh = Sourceorderrefresh::model()->checkOrderRefresh($data->rbi_id, "residence");?>
        <input type="hidden" id="<?php echo $data->rbi_id; ?>_isOrder" value="<?=$checkOrderRefresh?>">
    </td>
    <td width="37%" class="txt" align="left">
        <?php echo CHtml::link($data->community->comy_name,array("/communitybaseinfo/view","id"=>$data->rbi_communityid),array("style"=>"float:left","target"=>"_blank"));?>
        <span><?php
        echo $data->rbi_area."平&nbsp;";
        if($data->rbi_rentorsell==1){//出租就显示租金
            echo $data->rentInfo->rr_rentprice."元/月";
        }else{//出售就显示售价
            echo @$data->sellInfo->rs_price."万/套";
        }
        ?></span><br />
        <?php
        echo CHtml::link(common::strCut($data->rbi_title, 42),array("/communitybaseinfo/viewResidence",'id'=>$data->rbi_id),array("style"=>"float:left","target"=>"_blank","title"=>$data->rbi_title));
        if($data->rbi_rentorsell==1){
            $url = Yii::app()->createUrl('/manage/residencebaseinfo/rentupdate',array('id'=>$data->rbi_id));
        }else{
            $url = Yii::app()->createUrl('/manage/residencebaseinfo/sellupdate',array('id'=>$data->rbi_id));
        }
        ?>
        <span><a href="<?php echo $url; ?>">编辑</a></span>
    </td>
    <td class="txt">
        <?php echo CHtml::encode($data->residenceTag->rt_illegalreason);?>
    </td>
</tr>
<?php
}