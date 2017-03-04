<div style="width: 120px;height: 120px;float: left;margin-bottom: 10px;overflow: hidden">
    <a href="javascript:choosesource(<?=$data->sbi_buildingid ?>)">
        <?=CHtml::image(Picture::model()->getPicByTitleInt($data->sbi_titlepic),"",array("width"=>'100px',"height"=>"100px"))?>
    </a>
    <br />
    <?=common::strCut($data->sbi_buildingname, 18) ?>
</div>
