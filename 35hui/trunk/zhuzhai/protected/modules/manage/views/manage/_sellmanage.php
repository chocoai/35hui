<?php
if($sourceType==1){//写字楼
    ?>
<tr>
    <td width="5%" class="txt">
        <input name="chk[]" type="checkbox" value="<?php echo $data->ob_officeid; ?>" onclick='unselectall()'/>
            <?php $checkOrderRefresh = Sourceorderrefresh::model()->checkOrderRefresh($data->ob_officeid, "office");?>
        <input type="hidden" id="<?php echo $data->ob_officeid; ?>_isOrder" value="<?=$checkOrderRefresh?>">
    </td>
    <td width="37%" class="txt" align="left">
            <?php echo CHtml::link(@$data->buildingInfo->sbi_buildingname,array('/officebaseinfo/view',"id"=>$data->ob_officeid),array("style"=>"float:left","target"=>"_blank"));?>
        <span><?php
                echo $data->ob_officearea."平&nbsp;";
                if($data->ob_sellorrent==1){//出租就显示租金
                    echo $data->ob_rentprice."元";
                }else{//出售就显示售价
                    echo $data->ob_sumprice."万";
                }
                ?></span><br />
            <?php
            if($data->ob_sellorrent==1){
                $url = Yii::app()->createUrl('/manage/officebaseinfo/rentupdate',array('id'=>$data->ob_officeid));
            }else{
                $url = Yii::app()->createUrl('/manage/officebaseinfo/saleupdate',array('id'=>$data->ob_officeid));
            }
            ?>
        <span><a href="<?php echo $url; ?>">编辑</a></span></td>
    <td class="txt">
            <?php
            $_c1='color:blue';
            $_c2='color:#cccccc';
            if(Picture::isHavePicture($data->ob_officeid,2)){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("图",array("/manage/picture/photomanage",'id'=>$data->ob_officeid,'sourcetype'=>"office"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            if($data->ob_ispanorama==1){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("景",array("/manage/subpanorama/index",'id'=>$data->ob_officeid,'type'=>"1"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            ?>
    </td>
    <td class="txt"><?php echo $data->ob_visit; ?></td>
    <td class="txt">
        <a href="javascript:flushBuild(<?php echo $data->ob_officeid;?>)">刷新</a><br/>
            <?php
            if($checkOrderRefresh){
                echo CHtml::link("查看",array("/manage/sourceorderrefresh/view","sourceid"=>$data->ob_officeid,"type"=>"office"),array("style"=>"color:blue"))."|".CHtml::link("取消","#",array("onClick"=>"cancelOrderRefresh('$data->ob_officeid','office')"));
            }else{
                echo CHtml::link("预约","#",array("onClick"=>"oneOrderRefresh('$data->ob_officeid','office')"));
            }
            ?>
    </td>
    <td class="txt"><?php echo date("Y-m-d",$data->ob_updatedate)."<br />".date("H:i",$data->ob_updatedate); ?></td>
    <td class="txt"><?php echo date("Y-m-d",$data->ob_releasedate)."<br />".date("Y-m-d",$data->ob_releasedate+$data->ob_expiredate);?></td>
</tr>
    <?php
}elseif($sourceType==2){//商铺
    ?>
<tr>
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
        <span><a href="<?php echo $url; ?>">编辑</a></span></td>
    <td class="txt">
            <?php
            $_c1='color:blue';
            $_c2='color:#cccccc';
            if(Picture::isHavePicture($data->sb_shopid,2)){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("图",array("/manage/picture/photomanage",'id'=>$data->sb_shopid,'sourcetype'=>"shop"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            if($data->shopTag->st_ispanorama==1){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("景",array("/manage/subpanorama/index",'id'=>$data->sb_shopid,'type'=>"2"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            ?>
    </td>
    <td class="txt"><?php echo $data->sb_visit; ?></td>
    <td class="txt">
        <a href="javascript:flushBuild(<?php echo $data->sb_shopid;?>)">刷新</a><br/>
            <?php
            if($checkOrderRefresh){
                echo CHtml::link("查看",array("/manage/sourceorderrefresh/view","sourceid"=>$data->sb_shopid,"type"=>"shop"),array("style"=>"color:blue"))."|".CHtml::link("取消","#",array("onClick"=>"cancelOrderRefresh('$data->sb_shopid','shop')"));
            }else{
                echo CHtml::link("预约","#",array("onClick"=>"oneOrderRefresh('$data->sb_shopid','shop')"));
            }
            ?>
    </td>
    <td class="txt"><?php echo date("Y-m-d",$data->sb_updatedate)."<br />".date("H:i",$data->sb_updatedate); ?></td>
    <td class="txt"><?php echo date("Y-m-d",$data->sb_releasedate)."<br />".date("Y-m-d",$data->sb_releasedate+$data->sb_expiredate);?></td>
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
        <span><a href="<?php echo $url; ?>">编辑</a></span></td>
    <td class="txt">
            <?php
            $_c1='color:blue';
            $_c2='color:#cccccc';

            if(Picture::isHavePicture($data->rbi_id,8)){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("图",array("/manage/picture/photomanage",'id'=>$data->rbi_id,'sourcetype'=>"residence"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            if($data->residenceTag->rt_ispanorama==1){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("景",array("/manage/subpanorama/index",'id'=>$data->rbi_id,'type'=>"4"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            ?>
    </td>
    <td class="txt"><?php echo $data->rbi_visit; ?></td>
    <td class="txt">
        <a href="javascript:flushBuild(<?php echo $data->rbi_id;?>)">刷新</a><br/>
            <?php
            if($checkOrderRefresh){
                echo CHtml::link("查看",array("/manage/sourceorderrefresh/view","sourceid"=>$data->rbi_id,"type"=>"residence"),array("style"=>"color:blue"))."|".CHtml::link("取消","#",array("onClick"=>"cancelOrderRefresh('$data->rbi_id','residence')"));
            }else{
                echo CHtml::link("预约","#",array("onClick"=>"oneOrderRefresh('$data->rbi_id','residence')"));
            }
            ?>
    </td>
    <td class="txt"><?php echo date("Y-m-d",$data->rbi_updatedate)."<br />".date("H:i",$data->rbi_updatedate); ?></td>
    <td class="txt"><?php echo date("Y-m-d",$data->rbi_releasedate)."<br />".date("Y-m-d",$data->rbi_releasedate+$data->rr_validdate);?></td>
</tr>
    <?php
}elseif($sourceType==4){//创意园区
    ?>
<tr>
    <td width="5%" class="txt">
        <input name="chk[]" type="checkbox" value="<?php echo $data->cr_id; ?>" onclick='unselectall()'/>
            <?php $checkOrderRefresh = Sourceorderrefresh::model()->checkOrderRefresh($data->cr_id, "cypark");?>
        <input type="hidden" id="<?php echo $data->cr_id; ?>_isOrder" value="<?=$checkOrderRefresh?>">
    </td>
    <td width="37%" class="txt" align="left">
            <?php echo CHtml::link(@$data->parkbaseinfo->cp_name,array('/creativesource/view',"id"=>$data->cr_id),array("style"=>"float:left","target"=>"_blank"));?>
        <span><?php
                echo $data->cr_area."平&nbsp;";
                echo $data->cr_dayrentprice."元";
                ?></span><br />
            <?php
                $url = Yii::app()->createUrl('/manage/creativesource/rentupdate',array('id'=>$data->cr_id));
            ?>
        <span><a href="<?php echo $url; ?>">编辑</a></span></td>
    <td class="txt">
            <?php
            $_c1='color:blue';
            $_c2='color:#cccccc';
            if(Picture::isHavePicture($data->cr_id,10)){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("图",array("/manage/picture/photomanage",'id'=>$data->cr_id,'sourcetype'=>"cypark"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            if($data->cr_ispanorama==1){
                $color=$_c1;
            }else{
                $color=$_c2;
            }
            echo CHtml::link("景",array("/manage/subpanorama/index",'id'=>$data->cr_id,'type'=>"5"),array('class'=>'tabmargin','style'=>$color,'target'=>'frame'));

            ?>
    </td>
    <td class="txt"><?php echo $data->cr_visit; ?></td>
    <td class="txt">
        <a href="javascript:flushBuild(<?php echo $data->cr_id;?>)">刷新</a><br/>
            <?php
            if($checkOrderRefresh){
                echo CHtml::link("查看",array("/manage/sourceorderrefresh/view","sourceid"=>$data->cr_id,"type"=>"creative"),array("style"=>"color:blue"))."|".CHtml::link("取消","#",array("onClick"=>"cancelOrderRefresh('$data->cr_id','creative')"));
            }else{
                echo CHtml::link("预约","#",array("onClick"=>"oneOrderRefresh('$data->cr_id','creative')"));
            }
            ?>
    </td>
    <td class="txt"><?php echo date("Y-m-d",$data->cr_updatedate)."<br />".date("H:i",$data->cr_updatedate); ?></td>
    <td class="txt"><?php echo date("Y-m-d",$data->cr_releasedate)."<br />".date("Y-m-d",$data->cr_releasedate+$data->cr_expiredate);?></td>
</tr>

    <?php
}?>