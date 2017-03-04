<?php
Yii::import("zii.widgets.CPortlet");
class ReportWidget extends CPortlet{
    public $triggerId = "";//触发举报的控件的id
    public $suspectUserId = 0;//被举报的人的userid
    public $sourceId = 0;//房源id
    public $sourceType = 0;//房源类别
    public function renderContent(){
        $this->render('ReportWidget',array(
            'triggerId'=>$this->triggerId,
            'suspectUserId'=>$this->suspectUserId,
            'sourceId'=>$this->sourceId,
            'sourceType'=>$this->sourceType
        ));
    }
}
?>