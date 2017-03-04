<?php

class RegionController extends Controller {
    public $layout = "manage";
    public function actionIndex() {
        $pid = 0;
        if(isset($_GET["pid"])&&$_GET["pid"]){
            $pid = $_GET["pid"];
        }
        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("re_parent_id"=>$pid));
        $criteria->order = "re_order";
        $all = Region::model()->findAll($criteria);
        
        $preid = $pid;//上一级
        if($preid!=0){
            $info = Region::model()->findByPk($preid);
            if($info){
                $preid = $info->re_parent_id;
            }
        }
        $this->render('index',array(
            "all"=>$all,
            "preid"=>$preid,//上级
            "pid"=>$pid,//本级
        ));
    }
    public function actionUpdate(){
        $id = $_GET["id"];
        $model = Region::model()->findByPk($id);
        if(!$model){
            $this->redirect(array("index"));
        }
        if(isset ($_POST["Region"])&&$_POST["Region"]){
            $model->setAttributes($_POST["Region"],false);
            if($model->re_pinyin){
                $model->re_pinyin = strtoupper($model->re_pinyin);
            }
            $model->update();
            header("Location:".DOMAIN."/admin/region/index/pid/".$model->re_parent_id);
            exit;
        }
        $this->render('update',array(
            "model"=>$model,
        ));
    }
    public function actionDel(){
        $id = $_GET["id"];
        $model = Region::model()->findByPk($id);
        $pid = 0;
        if($model){
            $pid = $model->re_parent_id;
            $model->delete();
        }
        header("Location:".DOMAIN."/admin/region/index/pid/".$pid);
    }
    public function actionCreate() {
        $pid = $_GET["pid"];
        $parent = Region::model()->findByPk($pid);
        if(!$parent&&$pid!=0){
            $this->redirect(array("index"));
        }
        $model = new Region();
        if(isset ($_POST["Region"])&&$_POST["Region"]){
            $model->setAttributes($_POST["Region"],false);
            $model->re_parent_id = $pid;
            if($model->re_pinyin){
                $model->re_pinyin = strtoupper($model->re_pinyin);
            }
            if($model->save()){
                header("Location:".DOMAIN."/admin/region/index/pid/".$model->re_parent_id);
            }
        }
        $this->render('create',array(
            "model"=>$model,
            "parent"=>$parent
        ));
    }
}