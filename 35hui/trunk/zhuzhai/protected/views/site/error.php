<?php
$this->pageTitle = "您访问的页面不存在";
?>
<style type="text/css"> 
    
</style>
<div class="container">
  <div class="err">
      <h5>找不到你要的页面。</h5>
      <h2>很抱歉，您所请求的页面不存在！</h2>
      <p>仔细找过啦，没有发现你要找的页面。最可能的原因是：</p>
        <?php
        if(isset($message)){
            echo "<p>".CHtml::encode($message)."</p>";
        }
        ?>
        <p>在地址中可能存在键入错误。</p>
        <p>当你点击某个链接时，它可能已过期。</p>
  </div>
</div>
