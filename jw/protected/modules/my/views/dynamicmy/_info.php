<?php
if($allDynamic) {
    foreach($allDynamic as $value) {
        $domId = "dynamicmy_".$value->dm_id;
        switch ($value->dm_type) {
            default:
                break;
            case 1://说说
                $this->renderPartial("_userspeak",array("model"=>$value,"domId"=>$domId));
                break;
            case 2://相册
                $this->renderPartial("_albumphoto",array("model"=>$value,"domId"=>$domId));
                break;
            case 3://对人的打牌
                $this->renderPartial("_userboard",array("model"=>$value));
                break;
            case 4://收到道具
                $this->renderPartial("_prop",array("model"=>$value));
                break;
            case 5://收到礼物
                $this->renderPartial("_gift",array("model"=>$value));
                break;
        }
    }
}else {
    echo "我的空间暂无最新动态";
}
?>