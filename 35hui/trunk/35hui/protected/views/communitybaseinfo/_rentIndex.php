<ul onmouseout="this.className='threeline_boxleftulthree  addserach'" onmouseover="this.className='threeline_boxleftulfour  addserach'" class="threeline_boxleftulthree  addserach">
    <li class="ulthreeone"> 
        <a href="<?=Yii::app()->createUrl("/communitybaseinfo/viewResidence",array("id"=>$data->rbi_id))?>">
            <img alt="<?=@$data->community->comy_name?>" src="<?=Picture::model()->getPicByTitleInt($data->rbi_titlepicurl,"_small");?>" style="width: 114px; height: 76px; margin-top: 8px;">
        </a>
    </li>
    <li class="ulthreetwo">
        <strong>
            <a href="<?=Yii::app()->createUrl("/communitybaseinfo/viewResidence",array("id"=>$data->rbi_id))?>"><?php echo $data->rbi_title; ?></a>
            <?php
            if(isset($isrecommend)&&$isrecommend){
                echo '<font style="font-size:12px;font-weight: normal;background-color: #54A70D;color:white">&nbsp;置顶&nbsp;</font>';
            }
            if(isset($isKwdRecommend)&&$isKwdRecommend){
                echo '<font style="font-size:12px;font-weight: normal;background-color: #54A70D;color:white">&nbsp;推广&nbsp;</font>';
            }
            if($data->residenceTag->rt_isbuyregion==1){
                echo '<font style="font-size:12px;font-weight: normal;background-color: #54A70D;color:white">&nbsp;版块精选&nbsp;</font>';
            }
            ?>
        </strong>
        <div class="tj"><?=Residencetag::model()->showFourFeatures($data->rbi_id,true)?></div>
        <span style="color: black;" class="tjxxtb"><?=@$data->community->comy_name?></span>
        <span style="color: black;" class="tjxxtb">[<?=Region::model()->getNameById($data->community->comy_district)?>]<?=$data->community->comy_address?></span>
        <p class="pneir">
            <?=$data->rbi_room?>室<?=$data->rbi_office?>厅&nbsp;&nbsp;
            <?=Residencebaseinfo::model()->getFitment($data->rbi_decoration)?>&nbsp;&nbsp;
            楼层：<?=$data->rbi_floor?>/<?=$data->rbi_allfloor?>
            <font class="red"> </font>
        </p>
        <br>
        <p> 
            <a style="color: rgb(153, 153, 153);" title="" href="<?=User::model()->getUserShowIndexUrl($data->rbi_uid);?>">
               <?php 
                @$userRole=$data->user->user_role;
                @$userName=$userRole==2?$data->user->agentinfo['ua_realname']:($userRole==3?$data->user->companyinfo['uc_fullname']:'个人');
                echo CHtml::encode($userName);
               ?>
            </a>&nbsp;&nbsp;
            <span class="gray"><?=date("Y-m-d",$data->rbi_releasedate)?>&nbsp;发布&nbsp;<?=common::dealShowTime($data->rbi_updatedate)?>&nbsp;更新</span>
        </p>
    </li>
    <li class="ulthreefour"><span class="show_price"><?=$data->rbi_area?></span><span style="color: black;"><br>
            平方米</span></li>
    <li class="ulthreethree"><span class="show_price"><?=$data->rentInfo->rr_rentprice?></span><br>
        <span style="color: black;">元/月</span></li>
</ul>
