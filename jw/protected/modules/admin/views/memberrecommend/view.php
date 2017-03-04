<?php
$this->breadcrumbs=array(
        '专业会员推荐',
        $userModel->u_nickname,
);?>
<div style="height: 140px">
    <div style="float:left;width: 130px;">
        <a href="<?=Yii::app()->createUrl("/user/view",array("id"=>$userModel->u_id))?>" target="_blank"><img src="<?=User::model()->getUserHeadPhoto($userModel, "_65x70")?>" width="130px" height="140px" /></a>
    </div>
    <table style="float: left">
        <tr>
            <td>&nbsp;</td>
            <td><input type="button" value="推荐" onclick="memberRecommend()" /></td>
        </tr>
    </table>
</div>
<div style="clear:both;margin-top: 10px">
    <table class="bordertable" width="300px">
        <tr>
            <th>序号</th>
            <th>推荐日期</th>
            <th>创建时间</th>
        </tr>
        <?php
        foreach($memberRecommend as $key=>$value) {
            ?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=date("Y-m-d",$value->mr_recommendtime);?></td>
            <td><?=date("Y-m-d H:i",$value->mr_createtime);?></td>
        </tr>
            <?php
        }
        ?>
    </table>
</div>
<script type="text/javascript">
    function memberRecommend(){
        var usreid = "<?=$userModel->u_id?>";
        $.post("/admin/memberrecommend/create", {"usreid":usreid}, function(msg){
            if(msg=="success"){
                jw.pop.alert("推荐成功!",{autoClose:1000});
                setTimeout(function(){window.location.reload()},1000);
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2});
            }
        }, "text");

    }
</script>