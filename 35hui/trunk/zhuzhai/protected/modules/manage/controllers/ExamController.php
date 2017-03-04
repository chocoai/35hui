<?php

class ExamController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
                'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
                        'actions'=>array("index","beginexam","examsuccess"),
                        'roles'=>array(
                                Yii::app()->params['agent'],
                        ),
                ),
                array('deny',  // deny all users
                        'users'=>array('*'),
                ),
        );
    }
    public function actionIndex(){
        $model = Exam::model()->findByAttributes(array("e_uid"=>Yii::app()->user->id));
        $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>Yii::app()->user->id));
        $this->render('index',array(
                "model"=>$model,
                "uagent"=>$uagent
        ));
    }
    public function actionBeginExam(){
        $type=@$_GET["type"];//类型

        if(!array_key_exists($type, Examchoice::$ec_type)){
            $this->redirect(array("main/error"));
        }
        //判断今天是否还能答题
        $model = Exam::model()->findByAttributes(array("e_uid"=>Yii::app()->user->id));
        $info = Exam::model()->getExamInfoByType($model, $type);
        if(!Exam::model()->checkCanExam($info['examtime'])){
            $this->render('examerror');
            exit;
        }
        if(isset ($_POST)&&$_POST){
            $questions = array();
            $orders = array();//答案排序
            //先获取所有答的题目
            foreach($_POST["qid"] as $key=>$value){
                $questions[$key] = substr($value, 4);
                $orders[$key] = substr($value, 0, 4);
            }
            $criteria=new CDbCriteria;
            $criteria->select = "ec_id, ec_answer";
            $criteria->addInCondition("ec_id",$questions);
            $allExam = Examchoice::model()->findAll($criteria);
            $exams = Examchoice::model()->findAll($criteria);
            //判断每一题是否正确
            $questionsFlip = array_flip($questions);
            $zhqueNum = 0;//回答正确的题目数
            foreach($exams as $value){
                $ecid = $value->ec_id;
                $ans = $value->ec_answer;
                $timubianhao = $questionsFlip[$ecid];//题目编号
                if(isset($_POST["answer"][$timubianhao])){
                    $choose = substr($orders[$timubianhao], $_POST["answer"][$timubianhao], 1);
                }else{
                    $choose = 100;
                }
                if($choose==$ans){
                    $zhqueNum +=1 ;
                }
            }
            $maxNum = $this->saveSource($zhqueNum, $type);
            $this->redirect(array("examsuccess",
                    "num"=>$zhqueNum,
                    "maxNum"=>$maxNum,
            ));
        }

        $criteria=new CDbCriteria;
        $criteria->addColumnCondition(array("ec_type"=>$type));
        $criteria->limit = 10;
        $criteria->order = "rand()";
        $allExam = Examchoice::model()->findAll($criteria);
        $this->render('beginexam',array(
                "allExam"=>$allExam,
        ));
    }
    /**
     * 保存成绩
     */
    public function saveSource($zhqueNum,$type){
        $source = $zhqueNum*2;//每题2分，算总分。
        $model = Exam::model()->findByAttributes(array("e_uid"=>Yii::app()->user->id));
        if(!$model){//还没有考过试
            $model = new Exam();
            $model->e_uid = Yii::app()->user->id;
        }
        $source>20?$source=20:"";//如果任何时候总分大于20。都只取20。
        $maxNum = 0;
        switch ($type){
            case 1://房产知识
                $model->e_fctime = time();
                $maxNum = $model->e_fc = $model->e_fc>$source?$model->e_fc:$source;
                break;
            case 2://政策行情
                $model->e_zctime = time();
                $maxNum = $model->e_zc = $model->e_zc>$source?$model->e_zc:$source;
                break;
            case 3://熟悉楼盘
                $model->e_lptime = time();
                $maxNum = $model->e_lp = $model->e_lp>$source?$model->e_lp:$source;
                break;
            case 4://销售技巧
                $model->e_xstime = time();
                $maxNum = $model->e_xs = $model->e_xs>$source?$model->e_xs:$source;
                break;
            case 5://服务质量
                $model->e_fwtime = time();
                $maxNum = $model->e_fw = $model->e_fw>$source?$model->e_fw:$source;
                break;
        }
        $model->save();
        //更新总分
        $all = $model->e_fc + $model->e_zc + $model->e_lp + $model->e_xs + $model->e_fw;
        $uagent = Uagent::model()->findByAttributes(array("ua_uid"=>Yii::app()->user->id));
        if($all!=$uagent->ua_source){
            $uagent->ua_source = $all;
            $uagent->update();
        }
        return $maxNum;
    }
    public function actionExamSuccess(){
        $zhque = isset($_GET['num'])?$_GET['num']:0;
        $maxNum = isset($_GET['maxNum'])?$_GET['maxNum']:0;
        $nextArr = Exam::model()->getCanExam();//还能继续考试的
        $this->render('examsuccess',array(
                "nextArr"=>$nextArr,
                "zhque"=>$zhque,
                "maxNum"=>$maxNum
        ));
    }
}
