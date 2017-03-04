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
Yii::app()->clientScript->registerScriptFile('http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=1004570649');
?>


    <div class="space">
		<div class="lfspace"><a href="/">首页</a>&gt;<?php echo CHtml::encode($model->sbi_buildingname) ?>&gt;<em>楼盘详细</em></div>
		<div class="rtspace">浏览次数：<?php echo CHtml::encode($model->sbi_visit) ?></div>
	</div>
	<div class="loutit">
		<div class="lflou">
			<div class="title"><?php echo CHtml::encode($model->sbi_buildingname) ?></div>
			<div class="egtit"><?php echo CHtml::encode($model->sbi_buildingenglishname) ?></div>
		</div>
	</div>
	<?php $this->renderPartial('_viewHead', array('get'=>$_GET,"select"=>"blog","type"=>$type)); ?>

	<div class="detcont">
        <div class="detcont">
            <div class="ListBlog">
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
				<ul class="weibo">
					<li>
						<dl>
							<dt><img src="http://tp2.sinaimg.cn/1736988141/50/1297888813/0" title="任雨菲_MiCHelLE"></dt>
							<dd><a href="" >任雨菲</a>光影空間 限量版路演活動#連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天連續三天在中信廣場裡面舉行噢~~早十晚十今天第一天<br></dd>
							<dd><span style="color: #999;">今天  10:18:56</span></dd>
						</dl>
					</li>
				</ul>
                <div class="blogmore"><a href="">查看更多</a><a href="javascript:;" onclick="WB2.login(function(){})">Login</a></div>
			</div>
        </div>
	</div>
<br />
<script type="text/javascript">
$(function(){
    WB2.login(function(){
        //callback function
    });
    WB2.anyWhere(function(W){
    // 获取评论列表
    W.parseCMD("/statuses/comments.json", function(sResult, bStatus){
        if(bStatus == true) {
    alert(sResult);
        }
    },{
        userid : 12345678
    },{
        method: 'post'
    });
    });
});

</script>
