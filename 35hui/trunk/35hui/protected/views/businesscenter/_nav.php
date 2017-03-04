<?php
$sbi_city = '上海';
$sbi_district = Region::model()->getNameById($model->bc_district);
$sbi_buildingname = $model->bc_name;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'商务中心,'.$sbi_buildingname.'商务中心租赁,360°全景看房';
$description='找'.$sbi_city.'出售房源和租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.='上海'.$sbi_district.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
$tag =  !empty($_GET['tag'])?$_GET['tag']:''; ?>
	<div class="lptit">
		<ul>
			<li<?php echo $tag==''?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('id'=>$model->bc_id)) ?>">商务中心</a></li>
            <?php if($model->bc_sysid){ ?><li<?php echo $tag=='details'?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('tag'=>'details','id'=>$model->bc_id)) ?>">详细参数</a></li><?php } ?>
            <li<?php echo $tag=='around'?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('tag'=>'around','id'=>$model->bc_id)) ?>">周边配套</a></li>
            <li<?php echo $tag=='album'?' class="clk"':'' ?>><a href="<?php echo $this->createUrl('view',array('tag'=>'album','id'=>$model->bc_id)) ?>">相 册</a></li>
		</ul>
	</div>