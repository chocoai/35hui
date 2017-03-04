<div class="schcont">
		<div class="schdes">
			<div class="cypic"><a target="_blank" title="<?=$data->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$data->sb_shopid))?>"><img src="<?=Picture::model()->getPicByTitleInt($data->presentInfo->sp_titlepicurl,"_large")?>" /></a></div>
			<div class="sp_txt">
				<h2><a target="_blank" title="<?=$data->presentInfo->sp_shoptitle?>" href="<?=Yii::app()->createUrl("shop/view",array("id"=>$data->sb_shopid))?>"><?=@common::strCut($data->presentInfo->sp_shoptitle,39);?></a></h2>
				<p>[ <?=Region::model()->getNameById($data->sb_district)?>&nbsp;<?=Region::model()->getNameById($data->sb_section)?>]&nbsp;&nbsp;&nbsp;<span title="<?=$data->sb_shopaddress?>"><?=common::strCut($data->sb_shopaddress,33)?></span></p>
                <?php $floor=explode(",",$data->sb_floor);?>
                <p><?=@Shopbaseinfo::$sb_shoptype[$data->sb_shoptype]?><?if($floor[0]==1)echo "（第".$floor[1]."层）";else if($floor[0]==2)echo "（第".$floor[1]."-".$floor[2]."层）";else if($floor[0]==3)echo "（共".$floor[1]."层）";?></p>
				<p><?=$data->sb_businesstype!=3?Shopbaseinfo::$sb_profession[$data->sb_profession]."，":""?><?=Shopbaseinfo::$sb_businesstype[$data->sb_businesstype]?></p>
				<p>咨询热线：
                    <?
                $cdb=new CDbCriteria();
				$cdb->select = "ua_id,ua_realname,ua_uid";
				$cdb->addColumnCondition(array("ua_uid"=>$data['sb_uid']));
				$uagent = Uagent::model()->find($cdb);
                if($uagent){?>
                <a href="<?=Yii::app()->createUrl("uagent/index",array("id"=>$uagent->ua_id));?>" target="_blank"><?=$uagent?$uagent->ua_realname:"";?></a>
                <code><?=@$uagent->userInfo->user_tel?$uagent->userInfo->user_tel:"400-820-9181";?></code>
                <?}?>
                </p>
			</div>
			<div class="sp_sell"><em><?=$data->sb_shoparea?></em>㎡</div>
			<div class="sp_sell"><em><?=@$data->rentInfo->sr_monthrentprice?></em>元/㎡•月</div>
		</div>
	</div>