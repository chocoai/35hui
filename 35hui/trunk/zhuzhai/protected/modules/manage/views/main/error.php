<?php
$this->breadcrumbs=array('您访问的页面不存在')
        ?>
<style type="text/css">
    .main {	margin-top: 20px;}
    .img404 {BACKGROUND:url(/images/error.gif) no-repeat left top;	padding:0px;HEIGHT: 180px;BORDER-BOTTOM: #ccc 1px solid;}
    h2 {padding-left: 100px;FONT-SIZE: 16px;}
    .content {padding-left: 100px;	margin-top: 20px;FLOAT: left;WIDTH: 80%;	LINE-HEIGHT: 19px;}
    .content UL {PADDING-RIGHT: 35px;PADDING-LEFT: 35px;PADDING-BOTTOM: 20px;MARGIN: 0px;PADDING-TOP: 10px;}
    .content UL LI {list-style-type:disc;}
</style>
<div class="main">
    <div class=img404>
        <h2>很抱歉，您所请求的页面不存在！</h2>
        <div class=content>仔细找过啦，没有发现你要找的页面。最可能的原因是：
            <ul>
                <?php
                if(isset($message)){
                    echo "<li>".CHtml::encode($message)."</li>";
                }
                ?>
                <li>在地址中可能存在键入错误。</li>
                <li>当你点击某个链接时，它可能已过期。</li>
            </ul>
        </div>
    </div>
</div>
