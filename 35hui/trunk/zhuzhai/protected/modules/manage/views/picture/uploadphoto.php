<?php
$this->breadcrumbs=array(
	'图片管理',
);
?>
<form name="uploadframeform" id="uploadframeform" enctype="multipart/form-data" method="post" action="<?php echo Yii::app()->createUrl("/manage/picture/upload") ?>">
<div class="htit">管理<?php echo @ Picture::$typeDescription[$type];?></div>
<div class="gltit">标题图</div>
<div class="gltu">
    <div class="glmodl">
        <?php echo CHtml::image(Picture::model()->getPicByTitleInt($headpic,"_large"),"",array('style'=>'width:150px;height:100px;')); ?>
    </div>
</div>
<?php if(Yii::app()->user->hasFlash('uploadFile')): ?>
<div class="msg">
    <font style="color:red">图片上传失败</font><br/>
    请检查图片是否符合以下规则：<br/>1.尺寸最少200*200px<br/>2.大小在20KB到3MB之间<br/>3.大边不能超过小边长度2倍

</div>
<?php endif; ?>

<div class="gltit">所有图片</div>
<div class="gltu">
<?php 
$picnum = 0;
if(!empty($photolist)){
foreach($photolist as $key=>$value){ ?>
   <div class="glmodle">
       <img src="<?=PIC_URL.Picture::showStandPic($value->p_img,"_large");?>" style="width:150px;height:100px;" class="img_border"/><br />
       描述:<span id="<?=$value->p_id?>" onclick="editTitle(this)"><?=$value->p_title?CHtml::encode($value->p_title):'添加描述'?></span><br />
       <p><a href="javascript:settitle(<?php echo $value->p_id;?>)" >设为标题图片</a>
       <a  onclick="del(<?php echo $value->p_id;?>)" href="javascript:;" >删除</a>
       </p>
   </div>
<?php }
$picnum = $key+1;
}?>
</div>
<p align="center">
    <?=CHtml::hiddenField("sourceType",$sourceType)?>
    <input value="<?=$sourceId;?>" name="id" type="hidden" />
    <input value="<?=$type;?>" name="type" type="hidden"/>
    <input type="file" name="picfile" id="picfile" onchange="PreviewImg()" style="width:450px" <?php if($picnum>9){echo "disabled='false'";} ?> />
    <span id="message" style="display:none;"><font style='color:red'>上传中</font><img src='<?=IMAGE_URL?>/uploadPicLoad.gif' alt=""/></span>
<a href="/manage/picture/photomanage/id/<?=$_GET['id']?$_GET['id']:0?>/sourcetype/<?=$_GET['sourcetype']?$_GET['sourcetype']:'office'?>/menu/<?=$_GET['menu']?$_GET['menu']:''?>">返回</a>
</p>
</form>
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
        $.post("<?=Yii::app()->createUrl('/manage/picture/updatetitle')?>", {"id":id,"title":titleval}, function(){
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
            url: "<?php echo Yii::app()->createUrl('/manage/picture/delphoto');?>",
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
		url: "<?php echo Yii::app()->createUrl('/manage/picture/settitle');?>",
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