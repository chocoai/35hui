<div class="form">
    <?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>
    <div class="row">
        <?php echo CHtml::activeHiddenField($model, 'ht_sourceid'); ?>
		<?php echo CHtml::activeHiddenField($model, 'ht_sourcetype'); ?>
	</div>
    <div class="row">
        <?php echo CHtml::activeLabelEx($model,'ht_description'); ?>
		<?php echo CHtml::activeTextField($model, 'ht_description'); ?>
		<?php echo CHtml::error($model,'ht_description'); ?>
	</div>
    <div class="row">
        房型平面图:
        <ul style="width:500px;height: 200px;background: #f0f8ff;overflow: auto;">
            <?
                foreach($layoutPictrues as $picture){
            ?>
            <li style="margin:10px 0px">
                <input <?=$model->ht_pictureid==$picture->p_id?"checked='check'":""?> type="radio" name="Housetype[ht_pictureid]" value="<?=$picture->p_id?>">
                <?=CHtml::image(PIC_URL.$picture->p_tinyimg,"",array('style'=>'height:75px;width: 100px;'))?>
            </li>
            <?
                }
            ?>
        </ul>
    </div>
    <div id="select" class="row">
        房型全景图:
        <ul style="width:500px;height: 200px;background: #f0f8ff">
            <?
                foreach($houseLayoutPanoramas as $panorama){
            ?>
            <li style="margin:10px 0px">
                <div style="float:right;padding-right: 20px;"><?=CHtml::link("查看全景",array('panoramaView','id'=>$panorama->p_id),array("target"=>"_blank"))?></div>
                <div style="padding-left: 20px">
                    <input <?=$model->ht_panoramaid==$panorama->p_id?"checked='check'":""?>  type="radio" name="Housetype[ht_panoramaid]" value="<?=$panorama->p_id?>">&nbsp;&nbsp;
                    描述:<?=$panorama->p_description?></div>
            </li>
            <?
                }
            ?>
        </ul>
    </div>
    <div class="row submit">
        <?php echo CHtml::submitButton('确定'); ?>
    </div>
<?php echo CHtml::endForm(); ?>
</div>