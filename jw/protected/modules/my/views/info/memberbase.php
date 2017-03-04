<style type="text/css">
    .errorMessage{color:red}
</style>
<?php
Yii::app()->clientScript->registerScriptFile('/js/dateinput/dateinput.min.js',CClientScript::POS_BEGIN);
Yii::app()->clientScript->registerCssFile('/js/dateinput/dateinput.css');
$form=$this->beginWidget('CActiveForm', array(
        'id'=>'infobase-form',
        'enableAjaxValidation'=>false,
)); ?>
<div class="zftnav">
    <ul>
        <li class="clk">我的档案</li>
    </ul>
</div>
<div class="jbmain">
    <?=$this->renderPartial("_leftmembermenu")?>
    <div class="jbcont">
        <h1>账户信息</h1>
        <div class="mesg">注意您的电子邮箱和您的手机号码会被关注您的好友看到，如需不被看到请点击隐藏设置！</div>
        <div class="ln">手机</div>
        <div class="ln"><?php
            echo $form->textField($model,'mem_telephone',array('class'=>'txt_02'));
            echo $form->checkBox($model,'mem_telhide',array("style"=>"margin-left:5px"));
            echo $form->label($model,'mem_telhide',array("style"=>"margin-left:5px"));
            echo $form->error($model,'mem_telephone');
            ?>
        </div>
        <div class="ln">QQ</div>
        <div class="ln">
            <?php
            echo $form->textField($model,'mem_qq',array('class'=>'txt_02'));
            echo $form->checkBox($model,'mem_qqhide',array("style"=>"margin-left:5px"));
            echo $form->label($model,'mem_qqhide',array("style"=>"margin-left:5px"));
            echo $form->error($model,'mem_qq'); ?>
        </div>

        <h1>个人信息</h1>
        <div class="ln">出生日期</div>
        <div class="ln">
            <?php echo $form->textField($model,'mem_birthday',array('class'=>'txt_02','min'=>'1949-01-01' ,'max'=>'2099-12-30'));
            echo $form->error($model,'mem_birthday');
            ?>
        </div>

        <div class="ln">籍贯</div>
        <div class="ln">
            <?=$form->dropDownList($model, "u_nativeprovince",Region::model()->getAllGroupList(0),array("empty"=>"--请选择--"))?>
            <?=$form->error($model,'u_nativeprovince');
            ?>
        </div>


        <div class="ln">所在地</div>
        <div class="ln">
            <?=$form->dropDownList($model, "u_district",$district,array("empty"=>"--请选择--","onChange"=>"changeNext(this)"))?>
            <?php echo $form->dropDownList($model, "u_section",$section,array("empty"=>"--请选择--"));
            echo $form->error($model,'u_section');
            ?>
        </div>
        <div class="ln">身高：（单位：厘米）</div>
        <div class="ln">
            <?php
            echo $form->textField($model,'mem_height',array('class'=>'txt_02'));
            echo $form->error($model,'mem_height');
            ?>
        </div>
        <div class="ln">体重：（单位：公斤）</div>
        <div class="ln">
            <?php
            echo $form->textField($model,'mem_weight',array('class'=>'txt_02'));
            echo $form->error($model,'mem_weight');
            ?>
        </div>
        <div class="ln">三围：</div>
        <div class="ln" style="line-height:30px">
            胸 <?php echo $form->textField($model,'xiongsize',array('class'=>'txt_01')); ?>
            <?php echo $form->dropDownList($model,'xiongsizedanwei',array("A"=>"A","B"=>"B","C"=>"C","D"=>"D"),array('class'=>'txt_01',"style"=>"width:50px")); ?>
            <span class="errorMessage"><?php
                if(isset($model->errors["xiongsize"])&&$model->errors["xiongsize"]){
                    echo $model->errors["xiongsize"][0];
                }
                ?>
            </span>
            <br />
            腰 <?php echo $form->textField($model,'yaosize',array('class'=>'txt_01')); ?>&nbsp;厘米
            <span class="errorMessage"><?php
                if(isset($model->errors["yaosize"])&&$model->errors["yaosize"]){
                    echo $model->errors["yaosize"][0];
                }
                ?>
            </span>
            <br />
            臀 <?php echo $form->textField($model,'tunsize',array('class'=>'txt_01')); ?>&nbsp;厘米
            <span class="errorMessage"><?php
                if(isset($model->errors["tunsize"])&&$model->errors["tunsize"]){
                    echo $model->errors["tunsize"][0];
                }
                ?>
            </span>
            <div class="ln" style="text-align:center;"><input type="submit" class="btn_04" value="保 存" /> </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(function(){
        $.tools.dateinput.localize("fr",  {
            months:        '一月,二月,三月,四月,五月,六月,七月,八月,' +
                '九月,十月,十一月,十二月',
            shortMonths:   '一月,二月,三月,四月,五月,六月,七月,八月,九月,十月,十一月,十二月',
            days:          '星期日,星期一,星期二,星期三,星期四,星期五,星期六',
            shortDays:     '周日,周一,周二,周三,周四,周五,周六'
        });
        $("#InfoMemberBaseForm_mem_birthday").dateinput({
            selectors: true,
            lang: 'fr',
            format: 'yyyy-mm-dd'
        });
<?php if(Yii::app()->user->getFlash('message')) { ?>jw.pop.alert("修改成功",{autoClose:1000})<?php } ?>
            });
            function changeNext(obj){
                var parentid = $(obj).val();
                var html = "<option>--请选择--</option>";
                if(!parentid){
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
                            var index = "";
                            for(index in msg){
                                html += "<option value='"+index+"'>"+msg[index]+"</option>";
                            }
                            $(obj).next("select").html(html);
                        }
                    });
                }
            }
</script>