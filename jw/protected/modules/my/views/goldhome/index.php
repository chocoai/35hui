<div class="mright">
    <div class="zftnav">
        <ul>
            <li class="clk" onclick="window.location.href='/my/goldhome/index'" style="cursor: pointer">我的金屋</li>
            <li onclick="window.location.href='/my/goldhome/goldhomeme'" style="cursor: pointer">谁收藏了我</li>
        </ul>
    </div>
    <div class="jbmain">
        <div class="sftit">
            <a href="/my/goldhome/index" style="color:<?=$filter==""?"#ff0080":""?>">所有</a>
            <?php
            echo CHtml::link("未分组",array("/my/goldhome/index","f"=>"no"),array("style"=>"color:".($filter=="no"?"#ff0080":"")));
            $editname = "";
            if($allGoldHomeGroup){
                $hasfilter = "";
                foreach ($allGoldHomeGroup as $value){
                    $cssColor = "";
                    if($filter==$value->ghg_id){
                        $cssColor = "#ff0080";
                        $hasfilter = $value->ghg_id;
                        $editname = $value->ghg_groupname;
                    }
                    echo CHtml::link($value->ghg_groupname,array("/my/goldhome/index","f"=>$value->ghg_id),array("style"=>"color:".$cssColor));
                }
                if($hasfilter){
                    echo '<a href="javascript:;" onclick="goldhomegroupedit('.$hasfilter.')">编辑本分组</a>';
                    echo '<a href="javascript:;" onclick="goldhomegroupdel('.$hasfilter.')">删除本分组</a>';
                }
            }
            ?>
        </div>
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_view',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </div>
</div>

<div id="usermessageform" style="display: none">
    <?=$this->renderPartial('/usermessage/_usermessageform');?>
</div>
<div id="goldhomegroup" style="display: none">
    <?=$this->renderPartial('_goldhomegroup',array("allGoldHomeGroup"=>$allGoldHomeGroup));?>
</div>
<div id="goldhomeaddnote" style="display: none">
    <?=$this->renderPartial('_goldhomeaddnote');?>
</div>
<div id="goldhomegroupedit" style="display: none">
    <?=$this->renderPartial('_goldhomegroupedit',array("editname"=>$editname));?>
</div>

<?php Yii::app()->clientScript->registerScriptFile('/js/goldhome.js',CClientScript::POS_END );?>