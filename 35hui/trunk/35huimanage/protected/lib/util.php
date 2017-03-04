<?php 

#================================================================
#===EasyDBAccess 对象维持
function dba() {
    static $dba;
    if(!$dba) {
        $db_conf=Yii::app()->db;
        $dba = new EasyDBAccess($db_conf);
    }
    return $dba;
}

#================================================================
#===Validator 对象维持
function va() {
    static $va;
    if(!$va) {
        $va = new Validator();
    }
    return $va;
}
?>