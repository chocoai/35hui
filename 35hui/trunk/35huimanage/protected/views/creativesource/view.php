<?php
$this->breadcrumbs = array(
    '创意园区房源信息表'=>array("index"),
    $model->cr_id
);
$this->currentMenu = 10;
$this->menu = array(
    array('label' => '查看', 'url' => array('index')),
    array('label' => '管理', 'url' => array('admin')),
);
?>

<div class="view">
    <b>所属楼盘:</b>
    <? if (isset($model->parkbaseinfo)) {
    ?>
        <a href="<?php echo MAINHOST;
        echo Yii::app()->createUrl('creativeparkbaseinfo/view', array('id' => $model->parkbaseinfo->cp_id)); ?>"
        target="_blank"><?= CHtml::encode(@$model->parkbaseinfo->cp_name) ?></a>
       <?
    } else {
        echo "<font style='color:red'>:楼盘信息为空</font>";
    }
       ?>
    <br />
    
    <b>楼栋名称：</b><a href="<?php  echo MAINHOST;echo Yii::app()->createUrl('creativesource/view',array('id'=>$model->cr_id));?>"target="_blank"><?=$model->cr_dongname ?></a>
    <br/>

    <b>用户:</b>
    <?= isset($model->user) ? CHtml::encode($model->user->user_name) : ""; ?>[<?=$model->cr_userid?>]
    <br />
    <b>状态:</b><?=$model->cr_id?>
    <?= Creativesource::$checktype[$model->cr_check] ?>

    <? $url = Yii::app()->createUrl('creativesource/changetag', array('id' => $model->cr_id, "sourceType" =>4, "buildname" => isset($model->parkbaseinfo) ? @$model->parkbaseinfo->cp_name : "")); ?>
    <?= $model->cr_check == 4 ? CHtml::link("下线", array(), array('onclick' => 'return subFrom("' . $url . '",8)')) : "" ?>&nbsp;
    <?= CHtml::link("删除", array(), array('onclick' => 'return subFrom("' . $url . '",1)')) ?>
    <br />


    <b>楼层类型：</b><?= Creativesource::$cr_floortype[$model->cr_floortype] ?>
    <br />
    
    <b>面积：</b><?= $model->cr_area  ?>平方
    <br />

    

    <b>发布时间：</b><?= date("Y-m-d H:i:s", $model->cr_releasedate) ?>
     <br />
   
    <b>最近更新时间：</b><?= date("Y-m-d H:i:s", $model->cr_updatedate) ?>
    <br />
    
    <b>有效期：</b><?= date("Y-m-d H:i:s", $model->cr_expiredate ) ?>
    <br />


    <b>月租金：</b><?= $model->cr_monthrentprice ?>元
    <br />

    <b>日租金：</b><?= $model->cr_dayrentprice ?>元/平方·日
    <br />
	
	<b>楼盘介绍：</b><?= $model->cr_introduce  ?>
    <br />

</div>
<script>

    function subFrom(toUrl,type){
        var com;
        if(type==8){
            com=prompt("确认下线？\n您的房源因（'|'号前）被强制下线 (6个汉字以内)\n经纪人您好，您在XX楼的房源（'|'号后）感谢您的理解，谢谢！","价格因素|价格偏低，系统认为数据不够精准而被强制下线。建议您从草稿箱中对其重新编辑发布");
        }else if(type==1){
            com=prompt("确认删除？\n您的房源因( '|'号前)被强制删除 (6个汉字以内)\n经纪人您好，您在XX楼的房源（'|'号后）感谢您的理解，谢谢！","价格因素|价格偏低，系统认为数据不够精准而被强制删除。建议您从草稿箱中对其重新编辑发布");
        }
        if(com!=null&&com!=""){
            $.ajax({
                url:toUrl,
                data:{"msg":com,"state":type},
                type:"POST",
                success:function(msg){
                    alert(msg);
                    if(msg!="error"){
                        if(type==8){
                            window.location.href='<?= Yii::app()->createUrl('creativesource/view', array('id' => $model->cr_id)) ?>';
                        }
                        if(type==1){
                            window.location.href='<?= Yii::app()->createUrl('creativesource/index') ?>';
                        }
                    }
                }
            });     
        }
        return false
    
    }</script>