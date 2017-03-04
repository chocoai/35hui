<style type="text/css">
.upcont{ clear:both; height:100px; border:1px solid #ccc; overflow-x:hidden;  overflow-y:scroll; padding:15px 0px;}
.upic{ padding:5px 10px;height:100px; width:110px; float:left; }
.upic .line{ height:20px; line-height:20px; text-align:center;}
.upic .line input{ margin-right:5px;}
.upic img{ padding:2px; border:1px solid #ccc;}</style>
<p>您已从系统库中选择了<font id="viewPicNum" style="font-weight: bold">0</font>张图片</p>
<div class="upcont">
<?php
if($data !== NULL){
    foreach ($data as $pic) {
        $src = PIC_URL.Picture::showStandPic($pic['p_img'],"_thumb");
?>
<div class="upic">
    <img src="<?=$src ?>" height="80" width="110" />
    <div class="line">
        <input type="checkbox" id="basebp_<?=$pic['p_id']?>" onclick="return setBasePic('<?=$pic['p_img']?>',this.checked)" name="imgtitle[]" /><label for="basebp_<?=$pic['p_id']?>">使用本图片</label>
    </div>
</div>
<?php
    }
}
?>
</div>

<script type="text/javascript">
var picNum=0;
function setBasePic(img,add){
    if(picNum>4){
        if(add){
            alert("您最多可以选择5张图片！");
            return false;
        }else{//取消
            window.parent.setBasePicData(img,add);
            picNum--;
        }
    }else{
        window.parent.setBasePicData(img,add);
        if(add){
            picNum++;
        }else{
            picNum--;
        }
    }
    $("#viewPicNum").html(picNum);
    return true;
}
</script>