<div class="xdpic"><img src="/images/xdpic.jpg" /></div>
	<div class="xdmain">
		<div class="xd_left">
			<h1>只要5步，新地标帮您解决出租出售难题！</h1>
			<div class="xdline">
				<h5>提交您的委托房源</h5>
				<p>填写您房源的基本资料（楼盘、面积、装修状况等）</p>
				<p>在房源备注中填写您意向的租售价格以及对房源的简单介绍，以便新地标分析</p>
				<p>务必留下您的联系方式以便更好的跟进</p>
			</div>
			<div class="xdline">
				<h5>我们帮您分析房源</h5>
				<p>针对您的订单，新地标将第一时间定位合适的经纪人与您取得联系</p>
				<p>分析房源所在区域及所在楼盘的租售状况</p>
				<p>分析房源本身的属性并进行价值评估与优劣衡量</p>
			</div>
			<div class="xdline">
				<h5>我们用360全景展示房源</h5>
				<p>360全景是新地标独家提供的对房源实景的在线还原，直观展示</p>
				<p>新地标经纪人会与您取得联系并上门取景</p>
				<p>新地标经纪人将在新地标发布房源的360全景信息</p>
			</div>
			<div class="xdline">
				<h5>丰富的互联网手段推荐您的房源</h5>
				<p>有特殊需求的业主房源将在新地标联盟网站上同步展示</p>
				<p>邮件营销与短信营销将被重点利用</p>
				<p>微博与社区的力量一直是新地标关注的热点</p>
			</div>
			<div class="xdline">
				<h5>新地标专业经纪人全程接管</h5>
				<p>新地标经纪人将一直保持对房源的跟进直至成交</p>
				<p>委托中的业主任何疑问，新地标经纪人将满心满意协助解答</p>
				<p>业主有需要，新地标经纪人可以协助议价</p>
			</div>
		</div>
		<div class="xd_right">
            <?php if(Yii::app()->user->getFlash('showMessage')){ ?>
            <div class="xd_bg"><img src="/images/xdtit.jpg" /></div>
			<div class="xd_conts">
				<p><em>恭喜您！您的托管单已经提交成功！</em></p>
				<p style="padding-top:5px;">我们会再<span style="color:#FF0000;">15</span>分钟内联系您处理后续流程</p>
			</div>
			<div class="xd_bg"><img src="/images/xdbot.jpg" /></div>
            <?php }else{ ?>
			<h1>已经了解？这里下单</h1>
			<div class="xd_bg"><img src="/images/xdtit.jpg" /></div>
			<div class="xd_cont">
				<h2>我的房源委托单</h2>
				<div class="xddes">
					<?php echo $this->renderPartial('_form', array('model'=>$model,'ownerBuild'=>$ownerBuild)); ?>
				</div>
			</div>
			<div class="xd_bg"><img src="/images/xdbot.jpg" /></div>
            <?php } ?>
			<h3>您也可以电话委托</h3>
			<div class="xd_bg"><img src="/images/xdtit.jpg" /></div>
			<div class="xd_contp">
				<p><em>400-820-9181</em></p>
				<p style="padding-top:5px; color:#808080;">免费客户热线服务时间：8:00 - 20:00</p>
			</div>
			<div class="xd_bg"><img src="/images/xdbot.jpg" /></div>
			<div style="clear:both; height:10px;"></div>
		</div>
	</div>
