<?php
$this->breadcrumbs=array('成功案例','添加成功案例');
Yii::app()->clientScript->registerCssFile("/js/dateinput/dateinput.css");
Yii::app()->clientScript->registerScriptFile("/js/dateinput/dateinput.min.js");
?>
<style type="text/css">.err{color:red}</style>
<div class="htit">添加成功案例</div>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'successinfo-form',
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array(
                'onsubmit'=>"return check_submit();"
        ),
)); ?>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
                <td width="16%" class="tit"><em>*</em> 写字楼：</td>
                <td width="84%" class="txtlou">
                    <?php
                    $this->widget('CAutoComplete',
                            array(
                            "id"=>"si_buildname",
                            'name'=>'Successinfo[si_buildname]',
                            'url'=>array('/site/ajaxautocomplete'),
                            "value"=>$model->si_buildname,
                            'max'=>10,//显示最大数
                            'minChars'=>1,//最小输入多少开始匹配
                            'delay'=>500, //两次按键间隔小于此值，则启动等待
                            'scrollHeight'=>200,
                            "extraParams"=>array("type"=>"1"),//表示是楼盘、商业广场还是小区
                            "mustMatch"=>true,
                            'htmlOptions'=>array("class"=>"txt_02"),
                            'formatResult'=>"js:getbuildid",
                    ));
                    ?>
                    <font class="err"></font>
                    <?php echo $form->hiddenField($model,'si_buildid'); ?>
                    <?php echo $form->error($model,'si_buildid'); ?>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 客户公司：</td>
                <td class="txtlou">
                    <?php echo $form->textField($model,'si_companyname',array('class'=>"txt_02")); ?>
                    <font class="err"></font>
                    <?php echo $form->error($model,'si_companyname'); ?>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 楼层类型：</td>
                <td class="txtlou">
                    <?php echo $form->dropDownList($model,'si_floortype',Successinfo::$si_floortype,array('style'=>"width:60px")); ?>
                    <font class="err"></font>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 面积：</td>
                <td class="txtlou">
                    <?php echo $form->textField($model,'si_area',array('style'=>"width:80px","maxlength"=>"6")); ?>平米
                    <font class="err"></font>
                    <?php echo $form->error($model,'si_area'); ?>
                </td>
            </tr>
            <tr>
                <td class="tit"><em>*</em> 成交时间：</td>
                <td class="txtlou">
                    <input type="date" value="<?=$model->si_successtime?date("Y-m-d",$model->si_successtime):""?>" name="Successinfo[si_successtime]"  min="1980-01-01" max="<?=date("Y-m-d")?>"/>
                    <font class="err"></font>
                    <?php echo $form->error($model,'si_successtime'); ?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td class="txtlou"><input type="submit" value="提交" style="width:100px;"></td>
            </tr>
        </table>
</div>
<?php $this->endWidget(); ?>
<div style="height: 100px;clear: both"></div>
<script type="text/javascript">
    $.tools.dateinput.localize("fr",  {
        months:        '一月,二月,三月,四月,五月,六月,七月,八月,' +
            '九月,十月,十一月,十二月',
        shortMonths:   '一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月',
        days:          '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
        shortDays:     '周日,周一,周二,周三,周四,周五,周六'
    });
    $(":date").dateinput({
        selectors: true,
        lang: 'fr',
        format: 'yyyy-mm-dd',
        yearRange: [-30,30]
    });
    function getbuildid(data){
        $("#Successinfo_si_buildid").val(data[1]);
    }
    function check_submit(){
        if($.trim($("#si_buildname").val())==""){
            $("#si_buildname").next(".err").html("写字楼不能为空！");return false;
        }else{
            $("#si_buildname").next(".err").html("");
        }
        if($.trim($("#Successinfo_si_companyname").val())==""){
            $("#Successinfo_si_companyname").next(".err").html("公司名称不能为空！");return false;
        }else{
            $("#Successinfo_si_companyname").next(".err").html("");
        }
        if($.trim($("#Successinfo_si_area").val())==""){
            $("#Successinfo_si_area").next(".err").html("面积不能为空！");return false;
        }else{
            $("#Successinfo_si_area").next(".err").html("");
        }
    }
</script>
