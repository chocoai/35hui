<div class="view" style="height: 20px">
    <table width="100%">
        <tr>
            <td width="5%"><?php echo CHtml::encode($data->mag_userid); ?></td>
            <td width="15%"><?php echo CHtml::encode($data->mag_username); ?></td>
            <td width="13%"><?php echo CHtml::encode($data->mag_realname); ?></td>
            <!--<td width="15%"><?//php echo Manageuser::$mag_role[$data->mag_role]; ?></td>-->
            <td width="20%"><?php echo date("Y-m-d H:i", $data->mag_releasetime); ?></td>
            <td width="8%"><?php echo Manageuser::$mag_state[$data->mag_state]; ?></td>
            <td width="13%"><?=$data->mag_tel?"$data->mag_tel":"暂无"?></td>
            <td>
                <?php 
                if($data->mag_role==1){
                    echo "不可操作";
                }elseif($data->mag_state!=2){
                    $str = $data->mag_state==0?"锁定":"解锁";
                    echo CHtml::link($str,"#",array("style"=>"color:blue","onClick"=>"update('".$data->mag_userid."')"))."&nbsp;&nbsp;";
                    echo CHtml::link("删除","#",array("style"=>"color:blue","onClick"=>"del('".$data->mag_userid."')"))."&nbsp;&nbsp;";
                    
                    echo CHtml::link("编辑",array('/manageuser/update','id'=>$data->mag_userid),array("style"=>"color:blue"))."&nbsp;&nbsp;";
                    echo CHtml::link("查看授权",array('/manageuser/authorization','id'=>$data->mag_userid),array("style"=>"color:blue"));
                }
                ?>
            </td>
        </tr>
    </table>
</div>

