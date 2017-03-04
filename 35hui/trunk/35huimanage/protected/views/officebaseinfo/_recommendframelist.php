<div style="width: 120px;height: 120px;float: left;margin-bottom: 10px;overflow: hidden">
    <a href="javascript:choosesource(<?=$data->ob_officeid ?>)">
        <?=CHtml::image(Picture::model()->getPicByTitleInt($data->presentInfo->op_titlepicurl,"_small"),"",array("width"=>'100px',"height"=>"100px"))?>
    </a>
    <br />
    <?=common::strCut($data->presentInfo->op_officetitle, 18) ?>
</div>