<?php

class InfoMemberJobForm extends CFormModel {
    public $mem_company;
    public $mem_jobnumber;
    public $type;
    public $district;
    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
                array('mem_jobnumber', 'length', 'max'=>16, 'message'=>'工号最大长度16位'),
        );
    }

    public function attributeLabels() {
        return array(
        );
    }
    /*
     * 
    */
    public function init() {
        if(isset($_POST['InfoMemberJobForm'])) {
            $post = array_map('trim',$_POST['InfoMemberJobForm']);
            $this->setAttributes($post,false);
        }else {
            $this->type=1;
            $userId = User::model()->getId();
            $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $this->setAttributes($memberModel->attributes,false);
            if($memberModel->mem_company) {
                $this->type=2;
                $comModel = Companymanage::model()->findByPk($memberModel->mem_company);
                if($comModel) {
                    $this->district = $comModel->cm_district;
                }
            }
        }
    }

    public function update() {
        if($this->validate()) {
            $userId = User::model()->getId();
            $memberModel = Member::model()->findByAttributes(array("mem_userid"=>$userId));
            $memberModel->setAttributes($this->attributes,false);
            
            if($this->type==1){
                $memberModel->mem_company = "";
                $memberModel->mem_jobnumber = "";
            }
            $memberModel->update();
            return true;
        }
        return false;
    }
}