<div class="view" style="height:130px">
    <div style="float: left">
        <b><?php echo CHtml::encode($data->getAttributeLabel('spn_sourcetype')); ?>:</b>
        <?php  echo Subpanorama::$sourcetype[$data->spn_sourcetype]; ?>
        <br />
        <b>全景ID:</b>
        <?php echo CHtml::encode($data->spn_id); ?><br />
        <b>房源:</b><a target="_blank" href="<?php
            $nameArr=Subpanorama::model()->get_name($data->spn_sourceid,$data->spn_sourcetype);
            if($data->spn_sourcetype==Subpanorama::office){
                echo MAINHOST.Yii::app()->createUrl("office/view",array("id"=>$data->spn_sourceid));
            }elseif($data->spn_sourcetype==Subpanorama::shop){
                echo MAINHOST.Yii::app()->createUrl("shop/view",array("id"=>$data->spn_sourceid));
            }elseif($data->spn_sourcetype==Subpanorama::business){//
                echo MAINHOST.Yii::app()->createUrl("officebaseinfo/businessSummarize",array("id"=>$data->spn_sourceid));
            }elseif($data->spn_sourcetype==Subpanorama::residence){//
                echo MAINHOST.Yii::app()->createUrl("communitybaseinfo/view",array("id"=>$data->spn_sourceid));
            }
        ?>">
        <?php
            echo $nameArr[0];
        ?></a>
        <br />

        <b>发布者：</b>
        <?php
          echo $nameArr[1];
        ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('spn_state')); ?>:</b>
        <font color="<?php
        if($data->spn_state==1){
            echo 'blue';
        }elseif($data->spn_state==2){
            echo 'green';
        }elseif($data->spn_state==0){
            echo 'orange';
        }elseif($data->spn_state==3){
            echo 'red';
        }
        ?>"><?php echo Subpanorama::$spn_state[$data->spn_state]; ?></font>
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('spn_releasetime')); ?>:</b>
        <?php echo date("Y-m-d H:i:s", $data->spn_releasetime); ?>
        <br />
    </div>
    <div style="float: right;margin-top: 10px" >
        <?=CHtml::link("查看",array("view",'id'=>$data->spn_id));?>
    </div>
</div>