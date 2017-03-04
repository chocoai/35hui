    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::link($model->cp_name,array('view','id'=>$model->cp_id)) ?>&gt;<em>经纪人</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->cp_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->cp_name) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->cp_englishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('model'=>$model)); ?>

	<div class="detcont">
        <div class="detcont">
            <h1>请咨询<?php echo CHtml::encode(trim($model->cp_name)) ?>以下新地标经纪人...</h1>
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
