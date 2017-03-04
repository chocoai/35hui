<tr>
    <td><a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$data->am_id));?>" target="_blank"><?=$data->am_id?></a></td>
    <td><a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$data->am_userid));?>" target="_blank"><?=$data->am_userid?></a></td>
    <td title="<?=$data->am_albumtitle?>"><?=Common::strCut($data->am_albumtitle,30)?></td>
    <td><?=$data->am_redboard?></td>
    <td><?=$data->am_blackboard?></td>
    <td><a href="<?=Yii::app()->createUrl("/admin/albumrecommend/view",array("amid"=>$data->am_id));?>"><?=$data->am_allrecommentnum?></a></td>
    <td><?=$data->am_lastrecommenttime?date("y-m-d",$data->am_lastrecommenttime):"未推荐"?></td>
    <td><?=date("y-m-d H:i",$data->am_createtime)?></td>
    <td><?=$data->am_updatetime?date("y-m-d H:i",$data->am_updatetime):"未更新"?></td>
</tr>