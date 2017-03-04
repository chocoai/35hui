<li class="clearfix news_li_list">
    <div class="li_article_list_a"><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$data['n_id']))?>" title="<?php echo CHtml::encode($data['n_title']);?>" target="_blank"><?php echo common::strCut(CHtml::encode($data['n_title']),120);?></a></div>
    <div class="li_article_list_b"><?php echo date('Y-m-d',$data['n_date']); ?></div>
</li>