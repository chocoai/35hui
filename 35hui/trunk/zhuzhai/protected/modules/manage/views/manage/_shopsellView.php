<ul onmouseout="this.className='threeline_boxleftulthree  addserach'" onmouseover="this.className='threeline_boxleftulfour  addserach'" class="threeline_boxleftulthree  addserach">
    <li class="ulthreeone" >
        <div class="tag_sale"></div>
        <?php echo CHtml::link(CHtml::image(Picture::model()->getPicByTitleInt($data->presentInfo->sp_titlepicurl,'_small'),'TitleLogo',array('height'=>'76px','width'=>'114px')),array('/shop/view','id'=>$data->sb_shopid),array("target"=>"_blank")); ?>
    </li>
    <li class="ulthreetwo">
        <strong>
        <?php echo CHtml::link(CHtml::encode($data->presentInfo->sp_shoptitle),array('/shop/view','id'=>$data->sb_shopid),array("target"=>"_blank"));?><br />
        </strong>
        <div class="tj">
            <?=Shoptag::model()->showFourFeatures($data->sb_shopid,true)?>
        </div>
        <p style="color: black;">[<?=Region::model()->getNameById($data->sb_district)?>]<?=$data->sb_shopaddress?>[<?=Searchcondition::model()->getLoopName($data->sb_loop)?>]</p>
        <span style="color: black;"><?=Officebaseinfo::model()->getFitment($data->sb_adrondegree)?>&nbsp;&nbsp;楼层：<?=$data->sb_floor."/".$data->sb_allfloor?>&nbsp;均价：<?=$data->sellInfo['ss_avgprice']?'<font color="red">'.$data->sellInfo['ss_avgprice'].'</font>元/平米':"暂无资料"?> </span><br>
        <span><?=date("Y-m-d",$data->sb_releasedate)?>&nbsp;发布&nbsp;<?=common::dealShowTime($data->sb_updatedate)?>&nbsp;更新</span>
    </li>
    <li class="ulthreefour">
        <span class="show_price"><?=CHtml::encode($data->sb_shoparea)?></span><span style="color: black;"><br>
            平方米</span>
    </li>
    <li class="ulthreethree"><span class="show_price"><?php echo $data->sellInfo->ss_sumprice;?></span><br>
        <span style="color: black;">万元/套</span>
    </li>
</ul>