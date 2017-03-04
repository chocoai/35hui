<div class="view">
    <div class="right-tip">
        <div class="font-20" style="float:left;">Id&nbsp;</div>
        <div class="right-id-tip deepskyblue">
            <?php echo CHtml::link(CHtml::encode($data->sbi_buildingid), array('view', 'id'=>$data->sbi_buildingid)); ?>
        </div>
    </div>

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_buildingname')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sbi_buildingname),MAINHOST.Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$data->sbi_buildingid)),array("target"=>"_blank")); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_pinyinshortname')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_pinyinshortname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_province')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->sbi_province)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_city')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->sbi_city)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_district')); ?>:</b>
	<?php echo CHtml::encode(Region::model()->getNameById($data->sbi_district)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_openingtime')); ?>:</b>
	<?php echo CHtml::encode(showFormatDateTime($data->sbi_openingtime)); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_section')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_section); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_loop')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_loop); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_tradecircle')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_tradecircle); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_busway')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_busway); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_address')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_foreign')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_foreign); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_openingtime')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_openingtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_propertyname')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_propertyname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_developer')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_developer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_berthnum')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_berthnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_rentberth')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_rentberth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_propertyprice')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_propertyprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_propertydegree')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_propertydegree); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_elevatornum')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_elevatornum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_fireelevatornum')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_fireelevatornum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_buildingarea')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_buildingarea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_floorarea')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_floorarea); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_floor')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_floor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_floordownground')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_floordownground); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_floorupground')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_floorupground); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_roomnum')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_roomnum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_buildingintroduce')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_buildingintroduce); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_peripheral')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_peripheral); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_traffic')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_traffic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_decoration')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_decoration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_floorinformation')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_floorinformation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_parkinginformation')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_parkinginformation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_otherinformation')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_otherinformation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_titlepic')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_titlepic); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_avgrentprice')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_avgrentprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_avgsellprice')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_avgsellprice); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_isnew')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_isnew); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_x')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_x); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_y')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_y); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_tag')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_tag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_recordtime')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_recordtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_updatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sbi_tel')); ?>:</b>
	<?php echo CHtml::encode($data->sbi_tel); ?>
	<br />

	*/ ?>

</div>