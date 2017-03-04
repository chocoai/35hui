<?php
$this->temp=$menu;
$this->breadcrumbs=array(
	"我的新地标"=>array('/site/userindex'),
	'图片管理',
);
?>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">管理<?php echo Picture::$typeDescription[$type];?></div>
    <div class="manage_rightboxthree">
        <form name="uploadframeform" id="uploadframeform" enctype="multipart/form-data" method="post" action="<?php echo Yii::app()->createUrl("/picture/upload") ?>">
            <table class="manage_tabletwo" cellspacing="5" cellpadding="5"  border="0" width="100%" >
                <tr>
                    <th colspan="5" style="text-align: left">标题图片：</th>
                </tr>
                <tr>
                    <td>
                         <?php echo CHtml::image(Picture::model()->getPicByTitleInt($headpic,"_small"),"",array('style'=>'width:150px;height:100px;','class'=>'img_border')); ?>
                    </td>
                </tr>
<?php if(Yii::app()->user->hasFlash('uploadFile')): ?>
                <tr>
                    <td colspan="5"><font style="color:red">图片上传失败</font><br/>
                    请检查图片是否符合以下规则：<br/>1.尺寸最少200*200px<br/>2.大小在20KB到3MB之间<br/>3.大边不能超过小边长度2倍
                    </td>
                </tr>
<?php endif; ?>
                <tr>
                    <th colspan="5" style="text-align: left">所有图片：</th>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:left">
                        <ul style="background-color:red">
                        <?php
                            $picnum = 0;
                            if(!empty($photolist)){
                                foreach($photolist as $key=>$value){
                        ?>
                        <li style="text-align:center;float:left">
                            <img src="<?=PIC_URL.Picture::showStandPic($value->p_img,"_small");?>" style="width:150px;height:100px;" class="img_border"/><br />
                            描述:<span id="<?=$value->p_id?>" onclick="editTitle(this)"><?=$value->p_title?CHtml::encode($value->p_title):'添加描述'?></span><br />
                            <img id='ichno' src="<?=Yii::app()->baseUrl;?>/images/3.gif"  onclick="del(<?php echo $value->p_id;?>)" style="cursor: pointer"/>
                            <a href="javascript:settitle(<?php echo $value->p_id;?>)" >设为标题图片</a>
                        </li>
                        <?php
                                }
                                $picnum = $key+1;
                            }
                        ?>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center; margin: 0 auto; ">
                        <?=CHtml::hiddenField("sourceType",$sourceType)?>
                        <input value="<?=$sourceId;?>" name="id" type="hidden" />
                        <input value="<?=$type;?>" name="type" type="hidden"/>
                        <input type="file" name="picfile" id="picfile" onchange="PreviewImg()" style="width:450px" <?php if($picnum>9){echo "disabled='false'";} ?> />
                        <span id="message" style="display:none;"><font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' alt=""/></span>
                    </td>
                </tr>
                <tr><td colspan="5" align="center"><a href="/picture/photomanage/id/<?=$_GET['id']?$_GET['id']:0?>/sourcetype/<?=$_GET['sourcetype']?$_GET['sourcetype']:'office'?>/menu/<?=$_GET['menu']?$_GET['menu']:''?>">完成</a></td></tr>
            </table>
        </form>

    </div>
    <div class="manage_righttwoline"></div>
</div>

<script type="text/javascript">
function editTitle(Obj){
    var id = Obj.id;
    $(Obj).replaceWith('<input maxlength="32" onblur="updateTitle(this)" oldvalue="'+Obj.innerHTML+'" name="'+id+'" value="'+Obj.innerHTML+'">');
}
function updateTitle(title){
    var title = $(title)
    var id = title.attr("name");
    var titleval = $.trim(title.val());
    if(titleval != title.attr("oldvalue") && titleval){
        $.post("<?=Yii::app()->createUrl('picture/updatetitle')?>", {"id":id,"title":titleval}, function(){
            alert("修改成功");
        });
    }
    title.replaceWith('<span id="'+id+'" onclick="editTitle(this)">'+encodeHtml(titleval.length?titleval:'添加描述')+'</span>');
}
function encodeHtml(str){
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    return str;
}
function del(id){
    if(confirm("确定删除图片吗？")){
        $.ajax({
            type: "GET",
            url: "<?php echo Yii::app()->createUrl('/picture/delphoto');?>",
            data: "id="+id,
            success: function(){
                window.location.reload();
            }
        });
    }
}
function PreviewImg(){
    //判断图片是否合法
    var patn = /\.jpg$|\.jpeg$|\.gif$|\.png$/i;
    if(patn.test($("#picfile").val())){
        $("#message").css("display", "");
        $("#picfile").css("display", "none");
        document.getElementById("uploadframeform").submit();
    }else{
        $("#picfile").val("");
        alert("不支持此文件格式上传！");
    }
}
function settitle(id){
	$.ajax({
		url: "<?php echo Yii::app()->createUrl('/picture/settitle');?>",
		data: "id="+id,
		type:"POST",
        acync:"false",
		success:function(item){
			alert('设置标题图片成功！');
            window.location.reload();
		}
	});
}
</script>