<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
?>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
<div style="width:100%;height:650px;" id="container"></div>
<script type="text/javascript" src="<?=Yii::app()->request->baseUrl;?>/js/baidumap.js"></script>
<script type="text/javascript">
    var sellorrent = "<?php echo $sellorrent;?>";//表明是租是售还是新房。1租2售nh新房
    var kwd = "<?php echo $kwd;?>";//外部api查询kwd
    var data = "";       //本地数据库房源数据
    var citycode = "021";//默认城市
    var host = "<?php echo DOMAIN;?>";//主机。

 $(document).ready(function(){
        //创建和初始化地图
        initMap(<?php echo $coordinates['x']?>,<?php echo $coordinates['y']?>);
        if(kwd!=""){
            //searchBykeyword()
            // map.addEventListener("tilesloaded",function(){searchBykeyword();});
        }
    });
</script>
<div id="Info"  style="position:absolute;top:80px;"></div>
<style>
.showDiv{display:block; width:100%; height:650px;}
.hideDiv{display:none}
</style>
