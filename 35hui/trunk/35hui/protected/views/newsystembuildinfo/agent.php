<?php
$sbi_city = Region::model()->getNameById($model->sbi_city);
$sbi_district = Region::model()->getNameById($model->sbi_district);
$sbi_section = Region::model()->getNameById($model->sbi_section);
$sbi_buildingname = $model->sbi_buildingname;
$keywords = $sbi_city.$sbi_buildingname.','.$sbi_buildingname.'写字楼,'.$sbi_buildingname.'写字楼租赁,360°全景看房';
$description='找'.$sbi_city.'出售房源和租房,'.$sbi_city.'360°全景看房，就在新地标全景看房。';
$description.=$sbi_city.$sbi_district.$sbi_section.'/'.$sbi_buildingname.'最新出售和出租房源查询就上新地标。';
Yii::app()->clientScript->registerMetaTag($keywords,'keywords');
Yii::app()->clientScript->registerMetaTag($description,'description');
$this->pageTitle = $keywords.' - 新地标';
?>


    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->sbi_buildingname,array('systembuildinginfo/view','id'=>$model->sbi_buildingid)) ?>&gt;<em>经纪人</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"agent","type"=>$type)); ?>

	<div class="detcont">
        <div class="detcont">
            <h1>请咨询<?php echo CHtml::encode(trim($model->sbi_buildingname)) ?>以下新地标经纪人...</h1>
<?php foreach ($uagents as $agnet) { ?>
			<div class="lou_jjr">
				<div class="schpic">
                    <a href="<?php echo $this->createUrl('uagent/index',array('id'=>$agnet['ua_id'])) ?>">
                    <?php echo CHtml::image(User::model()->getUserHeadPic($agnet['ua_uid'], "_large"),$agnet['ua_realname']);?>
                    </a>
                </div>
				<div class="schjtxt">
					<h4><?php
                    echo User::model()->getUserShowLink($agnet['ua_uid']),' ';
                    echo User::model()->getUserLevelByUserId($agnet['ua_uid']),' ';
                    if($agnet['ua_combo']) echo Uagent::model()->getAgentComboIconUrl($agnet);
                    ?></h4>
					<h6><?php
                    $userModel = User::model()->findByPk($agnet['ua_uid']);
                    echo CHtml::encode($userModel['user_tel']);
                    ?></h6>
					<p>综合能力：<?php echo $agnet['ua_source']?'<em>'.$agnet['ua_source'].'</em>分':'暂无资料' ?></p>
					<p><span>从业年限：<?php echo $agnet['ua_congyeyear']?$agnet['ua_congyeyear'].'年':'暂无资料' ?></span>所在公司：<?php echo $agnet['ua_company']?CHtml::encode($agnet['ua_company']):'暂无资料' ?></p>
					<p>主营大厦：<?php
                    if($agnet['ua_mainbuilds']){
                        foreach(unserialize($agnet['ua_mainbuilds']) as $mb)
                            echo CHtml::link($mb['name'],array('/systembuildinginfo/view','id'=>$mb['id']),array('target'=>'_blank')),' ';
                    }?></p>
				</div>
			</div>
<?php } ?>
        </div>
        <?php
        $pagination = new CPagination($count);
        $pagination->pageSize = $pageSize;
        $this->widget('CLinkPager',array(
                'cssFile'=>'/css/pager.css',
                'pages'=>$pagination,
        ));
        ?>
	</div>
<br />