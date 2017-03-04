<?php
$this->breadcrumbs=array(
        '相册推荐',
        $albumModel->am_albumtitle,
);?>
<div style="height: 250px">
    <div style="float:left;width: 250px;">
        <a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$albumModel->am_id))?>" target="_blank"><img src="<?=Album::model()->getAlbumcoverUrl($albumModel, "_230x250")?>" width="230px" height="250px" /></a>
    </div>
    <table style="float: left">
        <tr>
            <td>相册名称：</td>
            <td><a href="<?=Yii::app()->createUrl("/album/view",array("id"=>$albumModel->am_id))?>" target="_blank"><?=$albumModel->am_albumtitle?></a></td>
        </tr>
        <tr>
            <td>相片数目：</td>
            <td><?=$albumModel->am_photonum?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="button" value="今日推荐" onclick="albumRecommend()" /></td>
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
        foreach($albumRecommend as $key=>$value) {
            ?>
        <tr>
            <td><?=$key+1?></td>
            <td><?=date("Y-m-d",$value->ar_recommendtime);?></td>
            <td><?=date("Y-m-d H:i",$value->ar_createtime);?></td>
        </tr>
            <?php
        }
        ?>
    </table>
</div>
<script type="text/javascript">
    function albumRecommend(){
        var amid = "<?=$albumModel->am_id?>";
        $.post("/admin/albumrecommend/create", {"amid":amid}, function(msg){
            if(msg=="success"){
                jw.pop.alert("推荐成功!",{autoClose:1000});
                setTimeout(function(){window.location.reload()},1000);
            }else{
                jw.pop.alert(msg,{autoClose:1000,icon:2});
            }
        }, "text");
        
    }
</script>