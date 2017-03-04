<?php
$actionID = $this->getAction()->getId();
?>
<div class="left">
  
  <div class="aboutmenu">
    <ul>
      <li <?=$actionID==="index"?'class="currentmenu"':'';?>><a href="/help">关于我们</a></li>
      <li <?=$actionID==="connect"?'class="currentmenu"':'';?> ><a href="/help/connect">联系我们</a></li>
      <li <?=$actionID==="qjdevice"?'class="currentmenu"':""?>><a href="/help/qjdevice">全景取景设备</a></li>
      <li <?=$actionID==="qjtakephoto"?'class="currentmenu"':""?>><a href="/help/qjtakephoto">拍摄技巧</a></li>
      <li <?=$actionID==="scfake"?'class="currentmenu"':""?>><a href="/help/scfake">虚拟办公室</a></li>
      <li <?=$actionID==="scoffice"?'class="currentmenu"':""?>><a href="/help/scoffice">服务式办公室</a></li>
      <li <?=$actionID==="scsol"?'class="currentmenu"':""?>><a href="/help/scsol">商务解决方案</a></li>
      <li <?=$actionID==="kwdrecommend"?'class="currentmenu"':""?>><a href="/help/kwdrecommend">关键词推广</a></li>
      <li <?=$actionID==="buyregion"?'class="currentmenu"':""?>><a href="/help/buyregion">版块精选</a></li>
      <li <?=$actionID==="contract"?'class="currentmenu"':'';?>><a href="/help/contract">服务协议</a></li>     
      <li <?=$actionID==="money"?'class="currentmenu"':'';?>><a href="/help/money">积分</a></li>
    </ul>
  </div>
</div>