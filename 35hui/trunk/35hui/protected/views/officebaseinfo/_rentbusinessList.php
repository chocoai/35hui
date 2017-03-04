<ul class="threeline_boxleftulthree addserach"   onmouseover="this.className='threeline_boxleftulfour  addserach'" onmouseout="this.className='threeline_boxleftulthree  addserach'">
    <li class="ulthreeone">
        <?
            $sourceUrl = Yii::app()->createUrl("/officebaseinfo/businessSummarize",array('opid'=>$data->ob_officeid));//房源详细页面链接
        ?>
        <a href="<?=$sourceUrl?>" title="" target="_blank">
        <?php
            $url = Picture::model()->getPicByTitleInt($data->presentInfo->op_titlepicurl,"_small");
            echo CHtml::image($url,$data->ob_officename,array('style'=>'height:76px;width:114px;margin-top:7px;'));
        ?>
        </a>
    </li>
    <li class="ulthreetwo">
        <strong><a href="<?=$sourceUrl?>" target="_blank"><?=CHtml::encode($data->presentInfo['op_officetitle'])?></a></strong><div class="tj"> <?=Officetag::model()->showFourFeatures($data->ob_officeid,true)?></div>
        <span class="tjxxtb" style="color:black"><?=CHtml::encode($data->ob_officename);?></span>
        <p style="color:black">[<?=Region::model()->getNameById($data->ob_district)?>]<?=CHtml::encode($data->ob_officeaddress)?>[<?=Searchcondition::model()->getLoopName($data->ob_loop)?>]</p>
        <span style="color:black"><?=Officebaseinfo::model()->getOfficeLevel($data->ob_officedegree)?>  <?=Officebaseinfo::model()->getFitment($data->ob_adrondegree)?>&nbsp;&nbsp;楼层：<?=Officebaseinfo::$ob_floortype[$data->ob_floortype]?></span><br />
        新地标&nbsp;&nbsp;<span><?=date("Y-m-d",$data->ob_releasedate)?>发布</span>
    </li>
    <li class="ulthreefour"><span class="show_price"><?=$data->rentInfo['or_rentprice']?></span><br /><span style="color:black">元/间·月</span></li>
</ul>




