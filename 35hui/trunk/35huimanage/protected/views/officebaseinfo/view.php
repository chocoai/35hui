<?php
$this->breadcrumbs = array(
    '写字楼房源'=>array("index"),
    $model->ob_officeid
);
$this->currentMenu = 10;
$this->menu = array(
    array('label' => '查看', 'url' => array('index')),
    array('label' => '管理', 'url' => array('admin')),
);
?>

<div class="view">
    <b>所属楼盘:</b>
    <? if (isset($model->buildingInfo)) {
    ?>
        <a href="<?php echo MAINHOST;
        echo Yii::app()->createUrl('systembuildinginfo/view', array('id' => $model->buildingInfo->sbi_buildingid)); ?>"
        target="_blank"><?= CHtml::encode(@$model->buildingInfo->sbi_buildingname) ?></a>
       <?
    } else {
        echo "<font style='color:red'>:楼盘信息为空</font>";
    }
       ?>
    <br />

    <b>用户:</b>
    <?= isset($model->user) ? CHtml::encode($model->user->user_name) : ""; ?>[<?=$model->ob_uid?>]
    <br />
    <b>状态:</b>
    <? $url = Yii::app()->createUrl('officebaseinfo/changetag', array('id' => $model->ob_officeid, "sourceType" => 1, "buildname" => isset($model->buildingInfo) ? @$model->buildingInfo->sbi_buildingname : "")); ?>
    <?= Officebaseinfo::$checktype[$model->ob_check] ?>
    <?= $model->ob_check == 4 ? CHtml::link("下线", array(), array('onclick' => 'return subFrom("' . $url . '",8)')) : "" ?>&nbsp;
    <?= CHtml::link("删除", array(), array('onclick' => 'return subFrom("' . $url . '",1)')) ?>

    <br />
    <b>面积：</b><?= $model->ob_officearea ?>平方
    <br />

    <b>装修程度：</b> <?= Officebaseinfo::$adrondegree[$model->ob_adrondegree] ?>
    <br />

    <b>售或租：</b><?= Officebaseinfo::$rentorsell[$model->ob_sellorrent] ?>

    <br />
    <b>发布时间：</b><?= date("Y-m-d H:i:s", $model->ob_releasedate) ?>

    <br />
    <b>最近更新时间：</b><?= date("Y-m-d H:i:s", $model->ob_updatedate) ?>

    <br>
    <b>有效期：</b><?= date("Y-m-d H:i:s", $model->ob_expiredate) ?>
    <br />

    <b>房源总价：</b><?= $model->ob_sumprice ?>万
    <br />

    <b>平均售价：</b><?= $model->ob_avgprice ?>万/平方
    <br />

    <b>月租金：</b><?= $model->ob_monthrentprice ?>元
    <br />

    <b>日租金：</b><?= $model->ob_rentprice ?>元/平方·日
    <br />
	
	<b>楼盘介绍：</b><?= $model->ob_introduce  ?>
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
                            window.location.href='<?= Yii::app()->createUrl('officebaseinfo/view', array('id' => $model->ob_officeid)) ?>';
                        }
                        if(type==1){
                            window.location.href='<?= Yii::app()->createUrl('officebaseinfo/index') ?>';
                        }
                    }
                }
            });     
        }
        return false
    
    }</script>