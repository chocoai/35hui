<?php
$this->breadcrumbs=array(
	'全景资源管理'=>array('index'),
);

$this->menu=array(
	array('label'=>'浏览所有全景', 'url'=>array('index')),
);
?>
您获取的唯一地址是：<input value="<?=$fileDir?>" readOnly="true" onmouseover="this.select()" size="40"/><br />
<div style="height: 50px"></div>
提示：在制作全景时，请在连接地址上添加此唯一地址。完整连接地址如 <font color="red">/panorama/12907399725425/index.swf</font><br />
<font color="red">注意：在完整地址最前面<b>必须有 “/”</b>，地址有效期，<b>七</b>天,过期将不能再使用</font>

