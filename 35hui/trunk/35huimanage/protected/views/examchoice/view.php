<?php
$this->breadcrumbs=array(
        'Examchoices'=>array('index'),
        $model->ec_id,
);

$this->menu=array(
        array('label'=>'列表', 'url'=>array('index')),
        array('label'=>'新建题目', 'url'=>array('create')),
        array('label'=>'修改题目', 'url'=>array('update', 'id'=>$model->ec_id)),
        array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ec_id),'confirm'=>'确定要删除吗？')),
        array('label'=>'管理', 'url'=>array('admin')),
);
?>

<h1>View Examchoice #<?php echo $model->ec_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
        'data'=>$model,
        'attributes'=>array(
                'ec_id',
                'ec_question',
                'ec_a',
                'ec_b',
                'ec_c',
                'ec_d',
                array(
                        "name"=>"ec_answer",
                        "value"=>Examchoice::model()->getTrueAnswerCode($model->ec_answer)
                ),
                array(
                        "name"=>"ec_type",
                        "value"=>Examchoice::$ec_type[$model->ec_type],
                ),
                array(
                        "name"=>"ec_time",
                        "value"=>date("Y-m-d:H:i",$model->ec_time),
                ),
        ),
)); ?>
