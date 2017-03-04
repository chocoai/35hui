                <tr>
                    <td><?php echo $widget->dataProvider->pagination->currentPage*$widget->dataProvider->pagination->pageSize+$index+1;?></td>
                    <td><?php echo Twittersuggest::model()->getBuildName($data->t_sourceid,$data->t_type);?></td>
                    <td><?php echo CHtml::encode($data->t_message)?></td>
                    <td><?php echo date('Y-m-d H:i',$data->t_recordtime)?></td>
                </tr>