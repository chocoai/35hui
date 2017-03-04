<div class="view" style="padding:0px">
    <table width="100%">
        <tr>
            <td width="15px"><?php echo CHtml::link(CHtml::encode($data->br_id), array('view', 'id'=>$data->br_id)); ?></td>
            <td><?php echo CHtml::encode(User::model()->getRealNamebyid($data->br_userid)); ?></td>
            <td width="100px"><?php echo CHtml::encode(Buyregion::model()->getShowRegionName($data->br_regionid)); ?></td>
            <td width="60px"><?php echo CHtml::encode(Buyregion::$br_sourcetype[$data->br_sourcetype]); ?></td>
            <td width="50px"><?php echo CHtml::encode(Buyregion::$br_sellorrent[$data->br_sellorrent]); ?></td>
            <td width="70px"><?php echo CHtml::encode(date("y-m-d",$data->br_buytime)); ?></td>
            <td width="50px"><?=(($data->br_expiredate)/86400)."天"?></td>
            <td width="40px"><?php
            if($data->br_buytime+$data->br_expiredate>time()){//还没有过期
                echo "可用";
            }else{
                if($data->br_status==1){
                    echo CHtml::link("未下线",array("buyregion/update","id"=>$data->br_id),array("style"=>"color:red"));
                }else{
                    echo "下线";
                }
            }
            ?></td>
        </tr>
    </table>
</div>