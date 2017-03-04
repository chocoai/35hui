<tr>
    <td><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data->mem_userid));?>" target="_blank"><?=$data->mem_userid?></a></td>
    <td><?=User::model()->getUserNameById($data->mem_userid)?></td>
    <td><?=$data->mem_telephone?></td>
    <td><?=Memberlevel::model()->getUserLevelName($data->mem_userid)?></td>
    <td><?=$data->mem_redboard?></td>
    <td><a href="<?=Yii::app()->createUrl("/admin/memberrecommend/view",array("uid"=>$data->mem_userid));?>"><?=$data->mem_allrecommentnum?></a></td>
    <td><?=$data->mem_lastrecommenttime?date("y-m-d",$data->mem_lastrecommenttime):"未推荐"?></td>
</tr>