<ul onmouseout="this.className='threeline_boxleftulthree  addserach'" onmouseover="this.className='threeline_boxleftulfour  addserach'" class="threeline_boxleftulthree  addserach">
    <li class="ulthreeone"> 
        <a href="<?=Yii::app()->createUrl("communitybaseinfo/view",array("id"=>$data->comy_id))?>">
            <img alt="<?=$data->comy_name?>" src="<?=Picture::model()->getPicByTitleInt($data->comy_titlepic,"_small");?>" style="width: 114px; height: 76px; margin-top: 8px;">
        </a>
    </li>
    <li class="ulthreetwo"> 
        <strong><a href="<?=Yii::app()->createUrl("communitybaseinfo/view",array("id"=>$data->comy_id))?>"><?=CHtml::encode($data->comy_name);?></a></strong>
        <span style="color: black;" class="tjxxtb">
            地址：<?=Region::model()->getNameById($data->comy_district);?>&nbsp;&nbsp;
            <?=Region::model()->getNameById($data->comy_section);?>&nbsp;&nbsp;<?=CHtml::encode($data->comy_address);?>
        </span>
            <ul class="pneir">
                <li><p style="float:left; width: 40px; display: inline-block;">交通：</p>
                    <?php
                        if($data->comy_traffic){
                            $trafficArray = split(",",$data->comy_traffic);
                            $arraySize = count($trafficArray);
                            $trafficNum = 1;
                            for($i = 0; $i < $arraySize; $i++){
                               $Info = Subway::model()->getInfoById($trafficArray[$i]);
                               if($Info != ""){
                    ?>
                            <a href="<?=Yii::app()->createUrl("map/map/coordinate/".$trafficArray[$i])?>" target="_blank"><?php echo @$Info->sw_stationname."(".Subway::model()->getInfoById($Info->sw_parentid)->sw_stationname.")";?></a>
                    <?php
                                    if($trafficNum != 0 && $trafficNum%3==0){
                                        echo "<br/>";
                                    }
                                    $trafficNum++;
                                }
                            }
                        }else{
                            echo "暂无资料";
                        }
                    ?>
                </li>
            </ul>
        <br/>
        <ul class="pneir">
            <li>
                <p>二手房：</p>
                <a href="<?=Yii::app()->createUrl("communitybaseinfo/sellIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($data->comy_name)))?>" style="color:red">
                    <?php echo Communitybaseinfo::model()->getNums($data->comy_id,2);?>套
                </a>
                <p style="margin-left: 15px;">出租房：</p>
                <a href="<?=Yii::app()->createUrl("communitybaseinfo/rentIndex",SearchMenu::dealOptions(array(), "keyword", urlencode($data->comy_name)))?>" style="color:red"><?php echo Communitybaseinfo::model()->getNums($data->comy_id,1);?>套</a>
            </li>
        </ul>
        <!--<p class="pneir">二手房：&nbsp;&nbsp;<span class="red">2666套</span>&nbsp;&nbsp;出租房：&nbsp;&nbsp;<span class="red">2666套</span>
        </p>-->
    </li>
    <li class="ulthreethree"><span class="show_price"><?=CHtml::encode($data->comy_avgsellprice);?></span>
        <span style="color: black;">元/平米</span>
    </li>
</ul>