<div class="dlmtit">
				<ul>
					<li class="clk"><a href="">商铺分布</a></li>
				</ul>
			</div>
            <div >
            <?$criteria=new CDbCriteria;
            $criteria->condition="sb_check=4 and sb_uid =".$_userModel->user_id." and sb_sellorrent =1";?>
            <div style="margin:10px">出租房源<em style="color:#f00000"><?php echo Shopbaseinfo::model()->count($criteria)?></em>套 |
                <?$criteria->condition="sb_check=4 and sb_uid =".$_userModel->user_id." and sb_sellorrent =2";?>
                出售房源<em style="color:#f00000"><?php echo Shopbaseinfo::model()->count($criteria)?></em>套</div>
             <table cellspacing="0" cellpadding="0" border="0" class="table_01">
                    <tr style="background:#E7F1FA;">
                            <td class="titl" style="width:70px" >类型</td>
                            <td class="titl" style="width:100px">标题</td>
                            <td class="titl" style="width:60px">区域</td>
                            <td class="titl" style="width:70px">面积</td>
                            <td class="titl" style="width:80px">总价/月租</td>
                            <td class="titl" style="width:55px">单价/转让</td>
                            <td class="titl" >选铺</td>
                    </tr>
            </table>
            <?php
            $criteria=new CDbCriteria;
            $criteria->condition="sb_check=4 and sb_uid =".$_userModel->user_id;

            $dataProvider = new CActiveDataProvider('Shopbaseinfo',array(
            'pagination'=>array(
                                'pageSize'=>10,
                        ),
            'criteria'=>$criteria,
        ));?>
           <div><?
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_sellorrentshop',
                'summaryText'=>'',
                'summaryCssClass'=>'',
                //"cssFile"=>"/css/pager.css",
            ));
            ?>
           </div>
    </div>