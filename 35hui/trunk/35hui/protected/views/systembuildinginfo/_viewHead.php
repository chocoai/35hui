<?php
$newGet = array();
foreach($get as $key=>$value){
    if($key!="tag"){
        $newGet[$key]=$value;
    }
}
?>
<div class="lptit">
    <ul>
        <li class="<?=$select=="view"?"clk":""?>"><a href="<?php echo $this->createUrl('view',$newGet) ?>">楼盘主页</a></li>
        <li class="<?=$select=="details"?"clk":""?>"><a href="<?php $newGet["tag"]="details"; echo $this->createUrl('view',$newGet) ?>">详细参数</a></li>
        <li class="<?=$select=="around"?"clk":""?>"><a href="<?php $newGet["tag"]="around"; echo $this->createUrl('view',$newGet) ?>">周边配套</a></li>
        <li class="<?=$select=="agent"?"clk":""?>"><a href="<?php $newGet["tag"]="agent"; echo $this->createUrl('view',$newGet) ?>">经纪人</a></li>
        <li class="<?=$select=="album"?"clk":""?>"><a href="<?php $newGet["tag"]="album"; echo $this->createUrl('view',$newGet) ?>">相 册</a></li>
        <li class="<?=$select=="comment"?"clk":""?>"><a href="<?php $newGet["tag"]="comment"; echo $this->createUrl('view',$newGet) ?>">评论</a></li>
    </ul>
    <div class="wyou"><a href="<?php echo $this->createUrl('/quickrelease/index',array('office'=>$_GET['id'])) ?>"><img src="/images/yfy.jpg" /></a></div>
</div>