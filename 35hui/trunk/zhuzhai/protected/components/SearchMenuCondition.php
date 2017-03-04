<?php
Yii::import("zii.widgets.CPortlet");
class SearchMenuCondition extends CPortlet{
    public $options = array();
    public $officeType = 0;
    public $rentorsell = 0;
    public $backGroundColor="#add8e6";
    public $saveCondition = true;//是否显示保存条件按钮
    
    public function renderContent(){
        $options = $this->options ;
        $html = Findcondition::model()->getFindConditionDescription($options);
        $this->render('SearchMenuCondition',array(
            'html'=>$html,
            'conditionJson'=>json_encode($options),
            'officeType'=>$this->officeType,
            'rentorsell'=>$this->rentorsell,
            'backGroundColor'=>$this->backGroundColor,
            "saveCondition"=>$this->saveCondition,
        ));
    }
}
?>