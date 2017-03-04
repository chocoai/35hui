<?php
$this->breadcrumbs=array(
	'Votes',
);

$this->menu=array(
	array('label'=>'新建调查', 'url'=>array('create')),
    array('label'=>'返回', 'url'=>array('index')),
);
?>

<h1>Votes</h1>
<?php if($vote_parent){ 
    $this->breadcrumbs[]=$vote_parent->vt_vote
?>
<div class="view">
    <p><?php echo CHtml::link(CHtml::encode($vote_parent->vt_vote), array('update', 'parent'=>$vote_parent->vt_parent, 'id'=>$vote_parent->vt_id));?></p>
    <?php
    echo '选择模式：',$vote_parent->vt_num?'多选':'单选';
    ?>
</div>
<?php
}

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'viewData'=>array(
        'vote_parent'=>$vote_parent,
    ),
)); ?>
