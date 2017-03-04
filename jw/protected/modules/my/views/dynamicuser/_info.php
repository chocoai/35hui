<?php
if($allDynamic) {
    foreach($allDynamic as $value) {
        $domId = "dynamicuser_".$value->du_id;
        switch ($value->du_type) {
            default:
                break;
            case 1://说说
                $this->renderPartial("_userspeak",array("model"=>$value, "domId"=>$domId));
                break;
            case 2://相册
                $this->renderPartial("_albumphoto",array("model"=>$value, "domId"=>$domId));
                break;
        }
    }
}else {
    echo "我的空间暂无最新动态";
}
?>