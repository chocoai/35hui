<?php
$this->breadcrumbs=array('用户资料',);
?>

<?php $this->renderPartial('_head'); ?>

<?php $form=$this->beginWidget('CActiveForm',array(
            'id'=>'update_form-form',
            'enableAjaxValidation'=>true,
            'htmlOptions'=>array('onSubmit'=>'return check_info();')
        )); ?>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 位置：</td>
            <td width="84%" class="txtlou">
                <select name="Uagent[ua_district]" onchange="changeNext(this)" class="slet_01 sslect">
                    <option value="0">-请选择-</option>
                    <?php
                    if(!empty($districtlist)){
                        foreach($districtlist as $value){
                    ?>
                            <option value="<?php echo $value->re_id; ?>" <?php if($model->ua_district==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <select name="Uagent[ua_section]" class="slet_01 sslect">
                    <option value="0">-请选择-</option>
                    <?php
                    if(!empty($sectionlist)){
                        foreach($sectionlist as $value){
                    ?>
                            <option value="<?php echo $value->re_id; ?>" <?php if($model->ua_section==$value->re_id)echo "selected" ?>><?php echo $value->re_name;?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 真实姓名：</td>
            <td width="84%" class="txtlou">
                <?php echo CHtml::activeTextField($model,'ua_realname',array('class'=>"txt_02")); ?>
                <?php echo CHtml::error($model,'ua_realname'); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 联系电话：</td>
            <td width="84%" class="txtlou">
                <?php echo CHtml::activeTextField($userModel,'user_tel',array('class'=>"txt_02",'maxlength'=>30,'onblur'=>"isMobel(this)")); ?>
                <?php echo CHtml::error($userModel,'user_tel'); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 电子邮箱：</td>
            <td width="84%" class="txtlou">
                <?php echo CHtml::activeTextField($userModel,'user_email',array('class'=>"txt_02",'maxlength'=>30)); ?>
                <?php echo CHtml::error($userModel,'user_email'); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 公司名称：</td>
            <td width="84%" class="txtlou">
                <?php echo CHtml::activeTextField($model,'ua_company',array('class'=>"txt_02",'maxlength'=>50)); ?>
                <?php echo CHtml::error($model,'ua_company'); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 主营业务：</td>
            <td width="84%" class="txtlou">
                <?php echo CHtml::dropDownList('mainbusiness',$model->userInfo->user_mainbusiness, User::$mainBusiness,array("class"=>"slet_01 sslect")); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit">从业日期：</td>
            <td width="84%" class="txtlou">
                <?php
                $beg = "1980";
                $contyearray = array();
                while($beg<=date("Y")){
                    $contyearray[$beg] = $beg;
                    $beg++;
                }
                ?>
                <?php echo CHtml::activeDropDownList($model,'ua_congyeyear',$contyearray,array("empty"=>"--请选择--","class"=>"slet_01 sslect")); ?>
                <font id="err"></font>
            </td>
        </tr>
        <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%" class="txtlou"><input type="submit" value="提交" style="width:100px;" /></td>
        </tr>
    </table>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
<?php
if(Yii::app()->user->hasFlash('message')){
    echo "alert('".Yii::app()->user->getFlash('message')."');";
}
?>
function changeNext(obj){
    var parentid = $(obj).val();
    var html = "<option value='0'>-请选择-</option>";
        if(parentid==0){
            $(obj).nextAll("select").html(html);//删除后面所有的选择。
        }else{
            $.ajax({
               url: "<?php echo Yii::app()->createUrl("/region/getlistbyparentid") ?>",
               type: "GET",
               data: "parentid="+parentid,
               async: false,
               success: function(msg){
                   var msg = eval("("+msg+")");
                   $(obj).nextAll("select").html(html);//删除后面所有的选择。
                   for(var i=0;i<msg.length;i++){
                       html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
                   }
                   $(obj).next("select").html(html);
               }
            });
        }

}
function check_info(){
    var d=$('select[name="Uagent[ua_district]"]');
    var s=$('select[name="Uagent[ua_section]"]');
    var r=$('input[name="Uagent[ua_realname]"]');
    var t=$('input[name="User[user_tel]"]');
    var e=$('input[name="User[user_email]"]');
    var c=$('input[name="Uagent[ua_company]"]');
    if(d.val()==0){
        d.nextAll('#err').html('<font color="red">请选择区域</font>');
        return false;
    }
    if(s.val()==0){
       s.nextAll('#err').html('<font color="red">请选择版块</font>');
       s.focus();
       return false;
    }else{
        s.nextAll('#err').html('');
    }
    if($.trim(r.val())==''){
        r.next('#err').html('<font color="red">真实姓名不能为空</font>');
        r.focus();
        return false;
    }else{
        r.next('#err').html('');
    }
    if($.trim(t.val())==''){
        t.next('#err').html('<font color="red">联系电话不能为空</font>');
        t.focus();
        return false;
    }else{
        t.next('#err').html('');
    }
    if($.trim(e.val())==''){
        e.next('#err').html('<font color="red">邮箱不能为空</font>');
        e.focus();
        return false;
    }else{
        e.next('#err').html('');
    }
    if($.trim(c.val())==''){
        c.next('#err').html('<font color="red">公司不能为空</font>');
        c.focus();
        return false;
    }else{
        c.next('#err').html('');
    }
}
</script>