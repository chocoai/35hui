<?php
$criteria=new CDbCriteria();
$criteria->select = "sbi_titlepic,sbi_buildingname,sbi_buildingid,sbi_district,sbi_section,sbi_address,sbi_propertydegree,sbi_defanglv,sbi_avgrentprice,sbi_propertyprice,sbi_openingtime,sbi_propertyname,sbi_developer,sbi_danyuanfenge,sbi_buildingarea,sbi_floorinfo,sbi_biaozhun,sbi_carport,sbi_liftinfo,sbi_roommating,sbi_avgsellprice";
$buildinfo = Systembuildinginfo::model()->findByPk($data->sbi_buildingid,$criteria);
if($buildinfo){
    //获取租售信息
    $allz = Officebaseinfo::model()->getSaleOrRentSourceByCondition($buildinfo->sbi_buildingid, 1, @$_GET["search"]);
	$alls = Officebaseinfo::model()->getSaleOrRentSourceByCondition($buildinfo->sbi_buildingid, 2, @$_GET["search"]);
	$all = Officebaseinfo::model()->getSourceByBuildid($buildinfo->sbi_buildingid);
	?>
<div class="schcont">
    <div class="schdes" style="height:210px;">
					<div class="xppic"style="position:relative">
					<a href="<?=Yii::app()->createUrl("newsystembuildinfo/view",array("type"=>$type,"id"=>$data->sbi_buildingid,))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($buildinfo->sbi_titlepic,"_large");?>" width="272px" height="190px"/>
					<div style="background:url(/images/xp.png) no-repeat;border:0px solid;height:63px;width:63px;position:absolute;left:0px"></div>
					</a></div>
					<div class="cytxt">
						<h2>
                            <a href="<?=Yii::app()->createUrl("newsystembuildinfo/view",array("type"=>$type,"id"=>$data->sbi_buildingid))?>" target="_blank"><?=$buildinfo->sbi_buildingname?></a>
                            <em><?php echo "[ ".Region::model()->getNameById($buildinfo->sbi_district)." ".Region::model()->getNameById($buildinfo->sbi_section)." ]&nbsp;&nbsp;&nbsp;";?></em>
                        </h2>
                        <?if($buildinfo->sbi_avgrentprice||$buildinfo->sbi_avgsellprice){?>
						<p>
                            <?=$buildinfo->sbi_avgrentprice?'<span class="cy_1">租金：<code class="fts">'.$buildinfo->sbi_avgrentprice."</code>元/m.月</span>":""?>
                            <?=$buildinfo->sbi_avgsellprice?'<span class="cy_2">售价：<code class="fts">'.$buildinfo->sbi_avgsellprice."</code>元/平方</span>":""?>
                        </p>
                        <?}?>
						<p>
                            <span class="cy_1">得房率：<?=$buildinfo->sbi_defanglv?$buildinfo->sbi_defanglv."%":"暂无"?></span>
                            <span class="cy_2">开盘时间：<?=$buildinfo->sbi_openingtime&&$buildinfo->sbi_openingtime!=0?date("Y-m",$buildinfo->sbi_openingtime):"暂无"?></span></p>
						<div class="xp" style="height:84px" title="<?=$buildinfo->new->nb_youshi?>"><?=common::strCut($buildinfo->new->nb_youshi,330)?></div>
                        <p><span class="cy_2">咨询热线：<em>400-820-9181</em></span><span class="cy_1" style=" text-align: right; color: #ff6600;"><input type="checkbox" /> <code>加入比较</code></span></p>
					</div>
					<div class="schtan" style="display:none;">
						<div class="schbord">
							<div class="cyycont" style="display:none;">
								<a href="<?=Yii::app()->createUrl("newsystembuildinfo/view",array("type"=>$type,"id"=>$data->sbi_buildingid))?>"
                                target="_blank"><img src="<?=Picture::model()->getOnePicExceptTitleInt($data->sbi_buildingid,1,
                                $buildinfo->sbi_titlepic,"_large");?>" width="286px" height="200px"/></a>
								<div class="tb_up">
                                        <table class="table_09" border="0" cellpadding="0" cellspace="0">
                                            <tr>
                                        <?=$buildinfo->sbi_developer?' <td width="24%" class=tit>开发商</td><td width="76%">'.$buildinfo->sbi_developer.'</td>':""?></tr>
                                            <tr>
                                        <?=$buildinfo->sbi_danyuanfenge?' <td width="24%" class=tit>单元分割</td><td width="76%">'.$buildinfo->sbi_danyuanfenge."平米".'</td>':""?></tr>
                                            <tr>
                                        <?=$buildinfo->sbi_buildingarea?'<td width="24%" class=tit>面积</td><td width="76%">'.$buildinfo->sbi_buildingarea."平米".'</td>':""?></tr>
                                        <?php
                                        $tmp="";
                                        if($buildinfo->sbi_floorinfo){
                                            $floorInfo = unserialize($buildinfo->sbi_floorinfo);
                                            if(isset($floorInfo["层高"])&&$floorInfo["层高"]){
                                                $tmp = $floorInfo["层高"]."米";
                                            }
                                        }
                                        if(trim($tmp)){
                                            echo "<tr><td width='24%' class=tit>层高</td><td width='76%'>".$tmp."</td></tr>";
                                        }
                                        $tmp="";
                                        if($buildinfo->sbi_biaozhun){
                                            $biaozhunInfo = unserialize($buildinfo->sbi_biaozhun);
                                            $tmp = implode(" ", $biaozhunInfo);

                                        }
                                        if(trim($tmp)){
                                            echo "<tr><td width='24%' class=tit>交屋标准</td><td width='76%'>".$tmp."</td></tr>";
                                        }
                                        $tmp="";
                                        if($buildinfo->sbi_carport){
                                            $carportInfo = unserialize($buildinfo->sbi_carport);
                                            if(isset($carportInfo["地上"])&&$carportInfo["地上"]){
                                                $tmp .= "地上".$carportInfo["地上"]."个";
                                            }
                                            if(isset($carportInfo["地下"])&&$carportInfo["地下"]){
                                                $tmp .= " 地下".$carportInfo["地下"]."个";
                                            }
                                        }
                                        if(trim($tmp)){
                                            echo "<tr><td width='24%' class=tit>车位配置</td><td width='76%'>".$tmp."</td></tr>";
                                        }
                                        $tmp="";
                                        if($buildinfo->sbi_liftinfo){
                                            $liftInfo = unserialize($buildinfo->sbi_liftinfo);
                                            if(isset($liftInfo["客梯"])&&$liftInfo["客梯"]){
                                                $tmp .= "客梯".$liftInfo["客梯"]."部";
                                            }
                                            if(isset($carportInfo["货梯"])&&$carportInfo["货梯"]){
                                                $tmp .= " 货梯".$liftInfo["货梯"]."部";
                                            }
                                        }
                                        if(trim($tmp)){
                                            echo"<tr><td width='24%' class=tit>电梯配置</td><td width='76%'>".$tmp."</td></tr>";
                                        }
                                        $tmp="";
                                        if($buildinfo->sbi_roommating){
                                            $roomInfo = unserialize($buildinfo->sbi_roommating);
                                            foreach($roomInfo as $key=>$value){
                                                if($value){
                                                    $tmp.=$key." ";
                                                }
                                            }
                                        }
                                        if(trim($tmp)){
                                            echo"<tr><td width='24%' class=tit>楼内配置</td><td width='76%'>".$tmp."</td></tr>";
                                        }
                                        ?>
                                        </table>
                                  </div>
							</div>
							<img src="/images/ltip.jpg" />
						</div>
					</div>
				</div>
 
</div>
<?php
}
?>
			