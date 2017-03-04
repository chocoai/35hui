                <tr>
                    <td wid="30"><?php echo $widget->dataProvider->pagination->currentPage*$widget->dataProvider->pagination->pageSize+$index+1;?></td>
                    <td><?php echo Twittersuggest::model()->getBuildName($data->ts_buildingid,$data->ts_type)?></td>
                    <td><?php echo CHtml::encode($data->ts_content)?></td>
                    <td><?php echo date('Y-m-d H:i',$data->ts_suggesttime)?></td>
                    <td width="30"><?php echo CHtml::link('删除',array('/twittersuggest/delete','id'=>$data->ts_id));?></td>
                </tr>