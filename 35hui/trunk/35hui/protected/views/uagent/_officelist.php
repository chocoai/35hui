
<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">写字楼房源分布</a></li>
				</ul>
			</div>
			<div class="jjr_fen">
				<div class="jjr_lfen"><p><em><?php echo $allNumes ?></em>套房源</p></div>
				<div class="jjr_fenbu"><?php
                    echo CHtml::image($this->createUrl('chart/pie',array('data'=>implode(',', $pieDate))));
                ?></div>
			</div>
            <div >
            <?$criteria=new CDbCriteria;
            $criteria->condition="ob_check=4 and ob_uid =".$_userModel->user_id." and ob_sellorrent =1";?>
            <div style="margin:10px">出租房源<em style="color:#f00000"><?php echo Officebaseinfo::model()->count($criteria)?></em>套 |
                <?$criteria->condition="ob_check=4 and ob_uid =".$_userModel->user_id." and ob_sellorrent =2";?>
                出售房源<em style="color:#f00000"><?php echo Officebaseinfo::model()->count($criteria)?></em>套</div>
             <table cellspacing="0" cellpadding="0" border="0" class="table_01">
                    <tr style="background:#E7F1FA;">
                            <td class="titl" style="width:70px" >类型</td>
                            <td class="titl" style="width:100px">大楼</td>
                            <td class="titl" style="width:60px">位置</td>
                            <td class="titl" style="width:70px">面积</td>
                            <td class="titl" style="width:80px">报价</td>
                            <td class="titl" style="width:55px">物业费</td>
                            <td class="titl" >看房</td>
                    </tr>
            </table>
            <?php
            $criteria=new CDbCriteria;
            $criteria->condition="ob_check=4 and ob_uid =".$_userModel->user_id;

            $dataProvider = new CActiveDataProvider('Officebaseinfo',array(
            'pagination'=>array(
                                'pageSize'=>10,
                        ),
            'criteria'=>$criteria,
        ));?>
           <div><?
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_sellorrentoffice',
                'summaryText'=>'',
                'summaryCssClass'=>'',
                //"cssFile"=>"/css/pager.css",
            ));
            ?>
           </div>
</div>