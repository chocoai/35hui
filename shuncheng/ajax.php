<?php
include('snews.php');
if(!_ADMIN) exit;
/* ========= Actions ========== */
function actionTemplate(){
    $name = isset($_GET['name'])?trim($_GET['name']):'error';
    $file = 'view/template/'.$name.'.php';
    $template = '';
    if(file_exists($file))
        echo template($file);
}

function actionUpdate(){
    $id = isset($_GET['id'])?(int)$_GET['id']:0;
    $type = isset($_GET['type'])?(int)$_GET['type']:1;
    $value = !empty($_GET['value'])?cleanWords(trim($_GET['value'])):'';

    $table = '';
    if($type == 1){
        $table = _PRE.'officeext';
    }elseif($type == 2){
        $table = _PRE.'creativeext';
    }
    $sql = "REPLACE INTO ".$table." SET id = {$id},emptyarea='{$value}';";
    echo $sql;
    if($value && $table && $id){
        $value = clean(cleanXSS($value));
        mysql_query($sql);
    }
}

// dddd
$action = isset($_GET['action'])?$_GET['action']:'';
switch($action){
    case 'template':
        actionTemplate();
        break;
    case 'update':
        actionUpdate();
        break;
}

function template($file)
{
    ob_start();

    try {
        include $file;
    } catch (Exception $e) {
        ob_end_clean();
    }
    return ob_get_clean();
}
