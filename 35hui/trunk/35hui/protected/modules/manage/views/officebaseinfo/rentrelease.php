<?php
$this->breadcrumbs=array('出售出租','发布房源',);
$userRole = User::model()->getCurrentRole();
?>
<div class="liucheng">
    <div class="lcleft"><img src="/images/mc/liucheng.png" /></div>
    <div class="lcright">
        <p><strong>全景拍摄指导</strong></p>
        <p><a href="/help/qjdevice" target="_blank">取景设备</a>|<a href="/help/qjtakephoto" target="_blank">拍摄技巧</a></p>
    </div>
</div>
<?php
if(User::model()->validateRelease(Yii::app()->user->id,1,1)!="success"){
?>
<div class="msg">
    <span>注意：您已经达到了发布上限，不能继续发布！</span>
    <?php if($userRole!=1){?><span>您可以完成所有<font color="red">认证</font>或使用<a href="/manage/buycombo/index" style="color:blue">功能升级</a>来<font color="red">提高发布上限</font>！</span><?php }?>
</div>
<?php } ?>
<div class="htguanle">
    <ul>
        <li class="clk"><a href="javascript:;">发布写字楼出租信息</a></li>
        <li><a href="<?php echo $this->createUrl('/manage/creativesource/rentrelease'); ?>">发布创意园区出租信息</a></li>
        <li><a href="<?php echo $this->createUrl('/manage/shopbaseinfo/rentrelease'); ?>">发布商铺出租信息</a></li>
       <!-- <li><a href="<?php echo $this->createUrl('/manage/residencebaseinfo/rentrelease'); ?>">发布住宅出租信息</a></li>-->
    </ul>
    <div class="moren"><?php echo CHtml::link('修改主营物业',array("/manage/user/index")); ?></div>
</div>

<?php echo $this->renderPartial('_rentformdiscribe', array(
    'model'=>$model,
    'modelSelect'=>$modelSelect,
    'opt'=>"create",
    )); ?>

<div class="msg">
    <em class="red">注意事项</em><br />
    1、上传图片宽度最小为200px*200px。<br />
    2、请勿上传有水印、盖章等任何侵犯他人版权或含有广告信息的图片。<br />
    3、每一类图片最多可上传10张，系统图库最多可选择5张。<br />
    4、批量上传可通过ctrl或shift键复选、框选图片。
</div>

<script type="text/javascript">
var basePicData = [];//存放选择过的图片
function setBasePicSrc(id){
    var _bpcurl = "<?php echo Yii::app()->createUrl('/manage/picture/showbasepic',array('type'=>1,'ptype'=>2)) ?>?id="+id;
    var _bpcurl2 = "<?php echo Yii::app()->createUrl('/mamage/picture/showbasepic',array('type'=>1,'ptype'=>1)) ?>?id="+id;
    $("#iframe_basepic").attr('src',_bpcurl);
    $("#iframe_basepic2").attr('src',_bpcurl2);
    $("#basepicture").empty();
    $("#basepicture2").empty();
    $("#sourceidshow").val(id);
    basePicData = [];
}
function setBasePicData(val,add){
    if(add){
        basePicData[basePicData.length]=val;
    }else{
        for(var i=0;i<basePicData.length;i++){
            if(basePicData[i]==val){
                basePicData.splice(i,1);
            }
        }
    }
}
//验证用户是否还能发布或录入
function validateOptNum(obj){
    var name = $(obj).attr("name");
    var vali = 0;
    $.ajax({
        url: "<?php echo Yii::app()->createUrl("/manage/officebaseinfo/validatenum") ?>",
        type: "GET",
        data: {"name":name},
        async: false,
        success: function(msg){
            if(msg=="success"){//验证通过。
                vali = 1;
            }else if(msg==0){
                if(name=="sketch"){
                    alert("抱歉，已达到允许录入的写字楼房源数的最大值。<?php if($userRole != 1)echo '继续发布，请购买套餐服务!';?>");
                }else{
                    alert("抱歉，已达到允许发布的写字楼房源数的最大值，您可以选择保存为草稿<?php if($userRole != 1)echo '，或购买套餐服务';?>。");
                }
            }
        }
    });
    if(vali==0){
        return false;
    }
}
//点击提交时触发此函数
function validateForm(){
    var _window = window;
    var _win_ichnograph = _window.frames['ichnograph'];
    var _win_outdoor = _window.frames['outdoor'];
    var _win_indoor = _window.frames['indoor'];
    var reg = /[,|]/g;
    //得到frame中的图片。放入隐藏域中
    $("#ichnograph_hidden").val(_win_ichnograph.getPicStr());
    $("#outdoor_hidden").val(_win_outdoor.getPicStr());
    $("#indoor_hidden").val(_win_indoor.getPicStr());
    var imgTitles = "";
    var c = $("#indoor_hidden").val().split('|');
    var cc = c.length;
    while(cc--){
        if(c[cc])
            imgTitles += '|'+c[cc]+','+_win_indoor.document.getElementById(c[cc]).value.replace(reg, '');
    }
    $("#indoor_hidden").val(imgTitles);
   var imgTitles = "";
    var c = $("#outdoor_hidden").val().split('|');
    var cc = c.length;
    while(cc--){
        if(c[cc])
            imgTitles += '|'+c[cc]+','+_win_outdoor.document.getElementById(c[cc]).value.replace(reg, '');
    }
    $("#outdoor_hidden").val(imgTitles);
     var imgTitles = "";
    var c = $("#ichnograph_hidden").val().split('|');
    var cc = c.length;
    while(cc--){
        if(c[cc])
            imgTitles += '|'+c[cc]+','+_win_ichnograph.document.getElementById(c[cc]).value.replace(reg, '');
    }
    $("#ichnograph_hidden").val(imgTitles);
    //系统图
    imgTitles = "";
    var bpArr = basePicData;
    var c = bpArr.length;
    while(c--){
        imgTitles += '|'+bpArr[c];
    }
    $("#base_images").val(imgTitles);
    if(!submitValidate()){
        return false;
    }
}
</script>