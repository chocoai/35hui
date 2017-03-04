<?php if(Yii::app()->user->hasFlash('deleteResult')): ?>
    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('deleteResult'); ?>
    </div>
<?php endif; ?>

<form action="" method="get" name="form" id="form">
    <?php $districtArray = Region::model()->getTarafUnits(37); ?>
    <?php echo CHtml::dropDownList('district',$district,$districtArray,array("empty"=>"--请选择--",'onChange'=>"changeChildren('district')")); ?>
    <?php echo CHtml::dropDownList('section',$section,$district?Region::model()->getFormatChildrenData($district):array(),array("empty"=>"--请选择--")); ?>
    <?php echo CHtml::dropDownList('type',$type,array("all"=>"全部","1"=>"注册","2"=>"爬取"),array()); ?>
    <?php echo CHtml::dropDownList('check',$check,Uagent::$ua_check,array("empty"=>"全部")); ?>
    &nbsp;&nbsp;公司：<input type="text" name="ua_company" value="<?=isset($ua_company)?$ua_company:""?>" size="10" />
    &nbsp;&nbsp;姓名：<input type="text" name="ua_realname" value="<?=isset($ua_realname)?$ua_realname:""?>" size="5" />
    <input type="hidden" id="orderBy" name="orderBy" value=""/>
    <input type="submit" name="search" value="搜索" />
</form>
<table style="margin: 0px" border="1" width="1340px">
    <tr>
        <th width="50px">ID</th>
        <th width="50px">用户Id</th>
         <th width="110px">注册名</th>
        <th width="100px">真实姓名</th>
         <th width="110px">所在公司</th>
        <th width="100px">身份认证</th>
        <th width="100px">名片认证</th>
        <th width="100px">运营认证</th>
        <th width="100px">审核状态</th>
        <th width="100px">注册时间</th>
        <th width="100px"><a href="javascript:orderBy('user_online');">在线时间</a></th>
        <th width="100px"><a href="javascript:orderBy('user_loginnum');">登录次数</a></th>
        <th width="100px"><a href="javascript:orderBy('user_lasttime');">最近登录时间</a></th>
        <th width="120px"><a href="javascript:orderBy('user_housenum');">已发布房源数量</a></th>
        <th width="120px"><a href="javascript:orderBy('user_subpnum');">上传全景图数量</a></th>
    </tr>
</table>

<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'summaryText'=>'',
    'summaryCssClass'=>'',
));
?>
<script type="text/javascript">
/**
 * 用户审核
 */
function audit(check,id){
    $.ajax({
        url:"<?php echo Yii::app()->createUrl("/uagent/audit") ?>",
        type:"GET",
        data:"id="+id+"&check="+check,
        success:function(){
            window.location.reload();
        }
    })
}
/* 排序*/
function orderBy(order){
    $("#orderBy").val(order);
    $("#form").submit();
}
function changeChildren(type){
    var parentId = $('#district').val();
    var key = "";
    var empty = '<option value="">--请选择--</option>';
    if(parentId!=""&&parentId!=null){
        $.ajax({
            type: "GET",
            url: "<?=Yii::app()->createUrl('region/ajaxGetChildren');?>",
            data: type+"="+parentId,
            success: function(childrenData){
                var childrenHtml = empty;
                if(childrenData!="[]"){
                    eval("var childrenData = " + childrenData + ";");
                    for(key in childrenData){
                        childrenHtml += "<option value="+key+">"+childrenData[key]+"</option>";
                    }
                    $("#section").html(childrenHtml);
                }else{
                    $("#section").html(empty);
                }
            }
        });
    }else{
        $("#section").html(empty);
    }
}

/*加样式*/
var _selectID='';
function selectID(num){
    var _ID = _selectID;
    if(_ID==num) return false;
    var obj=$("#uagent_"+num);
    var objBg=obj.attr('bgcolor');
    obj.attr('bgcolored',objBg).attr('bgcolor',"#FFFFFF");
    $("#uagent_"+_ID).attr('bgcolor',$("#uagent_"+_ID).attr('bgcolored'));
    _selectID=num;
}
</script>