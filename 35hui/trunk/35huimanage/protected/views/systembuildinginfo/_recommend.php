<div class="view">
    <table width="100%" border="0">
        <tr>
            <td width="20%"><?=Productgrid::model()->getPageName($data->p_page)?></td>
            <td width="50%"><?=Productgrid::model()->getPositionName($data->p_position)?></td>
            <td><a href="<?php echo Productgrid::model()->getRecommendImageByPageAndPosition($data->p_page, $data->p_position) ?>" target="_blank">查看</a></td>
        </tr>
        <tr>
            <td colspan="3">
                <?php
                    $list = Productgrid::model()->getIndex($data->p_page, $data->p_position);
                    foreach($list as $key=>$value){
                        if(Productgrid::model()->checkPositionCanBuy($value->p_id)){
                        ?>
                            <a href='javascript:buyposition(<?php echo $value->p_id.",".$type ;?>)'>立刻设置</a>&nbsp;&nbsp;
                        <?php
                        }else{
                            echo "<a href='javascript:unbuyposition(".$value->p_id.")'>取消</a>&nbsp;&nbsp;";
                        }
                    }
                ?>
            </td>
        </tr>
    </table>
</div>
<br />




    