<?php
$this->breadcrumbs=array(
	Yii::app()->user->name=>array('/site/userindex'),
	'站内信',
);
?>

<h1>站内信</h1>
<div>
<ul id="flowtabs" class="navi">
        <li><a id="t1" href="#inbox">收件箱</a></li>
        <li><a id="t2" href="#outbox">发件箱</a></li>
</ul>
<div id="flowpanes" style="height:600px">
    <div class="items">
		<div>
			<table>
		  	 <?php
		           $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$revProvider,
						'itemView'=>'_revlist',
						'summaryText'=>'<span style="padding-left:20px;">共有<strong>{count}</strong>封站内信</span>',
						'summaryCssClass'=>'',
						'emptyText'=>'收件箱内暂时没有信件',
		           ));
		          ?>
			</table>
		</div>
			
		<div>
			<table>
		  	 <?php
		           $this->widget('zii.widgets.CListView', array(
						'dataProvider'=>$sendProvider,
						'itemView'=>'_sendlist',
						'summaryText'=>'共发出<strong>{count}</strong>封站内信',
						'summaryCssClass'=>'',
						'emptyText'=>'发件箱内暂时没有信件',
		           ));
		          ?>
			</table>
		</div>
	</div>
</div>
</div>