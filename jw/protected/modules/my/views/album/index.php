<div class="mright">
    <div class="zftnav">
        <ul style="width:500px">
            <li class="clk">我的展示</li>
        </ul>
        <div class="ul">
            <a href="javascript:;" onclick="createAlbum()">创建展示册</a>
            <a href="<?=Yii::app()->createUrl("/my/albumphoto/uploadphoto")?>"><img src="/images/uppic.png" /></a>
        </div>
    </div>
    <div class="phomain">
        <div style="height: 10px;width: 100%"></div>
        <?php
        foreach($albums as $value){
            ?>
        <div class="phomod">
            <div class="pic"><a href="<?=Yii::app()->createUrl("/my/album/view",array("id"=>$value->am_id))?>"><img src="<?=Album::model()->getAlbumcoverUrl($value, "_230x250")?>"  width="152px" height="163px"  /></a></div>
            <div class="txt"><a href="" class="cz bg">154</a><a href="" class="bd bg">154553</a></div>
            <p><em><?=Common::strCut($value->am_albumtitle, "27")?></em></p>
            <p class="optDom" style="display: none"><a href="javascript:;" onclick="editAlbum(<?=$value->am_id?>)">编辑</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:;" onclick="delAlbum(<?=$value->am_id?>)">删除</a></p>
            <div style="display:none" id="info_<?=$value->am_id?>">
                <input name="title" type="hidden" value="<?=$value->am_albumtitle?>" />
                <input name="description" type="hidden" value="<?=$value->am_albumdescribe?>"/>
                <input name="type" type="hidden" value="<?=$value->am_albumtype?>"/>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>
<div id="albumform" style="display: none">
    <?=$this->renderPartial('_albumform');?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.phomain .phomod').mouseover(function() {
            $(this).find(".optDom").css("display","")
        }).mouseout(function() {
            $(this).find(".optDom").css("display","none")
        });
    })
</script>