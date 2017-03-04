<?php
$sbi_city = '上海';
$sbi_district = Region::model()->getNameById($model->cp_district);
$sbi_section = '';
$sbi_buildingname = $model->cp_name;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'创意园区,'.$sbi_buildingname.'创意园区租赁,360°全景看房';
$description='找'.$sbi_city.'创意园区租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
$tag =  !empty($_GET['tag'])?$_GET['tag']:'';
?>
	<div class="lptit">
		<ul>
			<li<?php echo $tag==''?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('id'=>$model->cp_id)) ?>">创意园区</a></li>
            <li<?php echo $tag=='around'?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('tag'=>'around','id'=>$model->cp_id)) ?>">周边配套</a></li>
            <li<?php echo $tag=='agent'?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('tag'=>'agent','id'=>$model->cp_id)) ?>">经纪人</a></li>
            <li<?php echo $tag=='album'?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('tag'=>'album','id'=>$model->cp_id)) ?>">相 册</a></li>
		</ul>
	</div>