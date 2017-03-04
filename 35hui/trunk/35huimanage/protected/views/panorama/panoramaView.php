<?php
    $panoId = substr($panoramaUrl, strrpos($panoramaUrl, "/")+1);
?>
<div style="margin-left: 20px;margin-top: 20px">
<iframe src="<?=PIC_URL?>/site/frame/panoId/<?=$panoId?>" width="700px" height="400px" frameborder="0" scrolling="no"></iframe>
</div>
<br />
缩略图：<img src="<?=PIC_URL?>/panorama/<?=$panoId?>/thumbnail.jpg" width="90px" height="70px" alt="" />