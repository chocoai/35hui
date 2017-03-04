<ul class="threeline_boxleftulthree addserach"   onmouseover="this.className='threeline_boxleftulfour  addserach'" onmouseout="this.className='threeline_boxleftulthree  addserach'">
    <li class="ulthreeone">
        <a target="_blank" href="<?=Yii::app()->createUrl("/systembuildinginfo/viewshop",array("id"=>$data->sbi_buildingid))?>"  title="">
           <img src="<?=Picture::model()->getPicByTitleInt($data->sbi_titlepic,"_small");?>" alt="<?=$data->sbi_buildingname?>" width="114px" height="76px" style="margin-top:7px;"/>
        </a>
    </li>
    <li class="ulthreetwo">
        <strong><a target="_blank" href="<?=Yii::app()->createUrl("/systembuildinginfo/viewshop",array("id"=>$data->sbi_buildingid))?>" title=""><?=CHtml::encode($data->sbi_buildingname);?></a></strong>
        <font style="color:black">[<?=Region::model()->getNameById($data->sbi_district)?>]<?=CHtml::encode($data->sbi_address);?>[<?=Searchcondition::model()->getLoopName($data->sbi_loop)?>]</font><br />
        <font style="color:black">开盘时间：<?=$data->sbi_openingtime?date("Y-m-d", $data->sbi_openingtime):"暂无资料";?></font>
    </li>
    <li class="ulthreefour" style="padding-top:28px;width:100px;margin-left:30px;">
       <?php if($data->sbi_avgsellprice<=0){ ?>
        <span style="color:black">暂无</span>
        <?php
        } else{ ?> 
        <span class="show_price"><?php echo $data->sbi_avgsellprice;?></span><br /><span style="color:black">元/平米</span>
        <?php } ?>   
    </li>
    <li class="ulthreethree" style="width:100px;margin-left:0px">
        <?php if($data->sbi_avgrentprice<=0){ ?>
        <span style="color:black">暂无</span>
        <?php
        } else{ ?>
        <span class="show_price"><?php echo $data->sbi_avgrentprice;?></span><br /><span style="color:black">元/平米·天</span>
        <?php } ?>
   
    </li>
</ul>