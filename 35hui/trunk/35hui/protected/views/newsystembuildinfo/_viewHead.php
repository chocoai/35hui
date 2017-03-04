<?php
$newGet = array("type"=>$type);
foreach($get as $key=>$value){
    if($key!="tag"){
        $newGet[$key]=$value;
    }
}

?>
<div class="xptit">
    <ul>
        <li class="<?=$select=="view"?"clk":""?>"><a href="<?php echo $this->createUrl('view',$newGet) ?>">楼盘主页</a></li>
        <li class="<?=$select=="details"?"clk":""?>"><a href="<?php $newGet["tag"]="details"; echo $this->createUrl('view',$newGet) ?>">详细参数</a></li>
        <li class="<?=$select=="around"?"clk":""?>"><a href="<?php $newGet["tag"]="around"; echo $this->createUrl('view',$newGet) ?>">周边配套</a></li>
        <li class="<?=$select=="album"?"clk":""?>"><a href="<?php $newGet["tag"]="album"; echo $this->createUrl('view',$newGet) ?>">相 册</a></li>
        <li class="<?=$select=="comment"?"clk":""?>"><a href="<?php $newGet["tag"]="comment"; echo $this->createUrl('view',$newGet) ?>">评论</a></li>
    </ul>
    
</div>