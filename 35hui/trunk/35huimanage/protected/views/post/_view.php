<div class="view">
    <table>
        <tr>
            <td width="%5"><?php echo CHtml::link(CHtml::encode($data->post_id), array('view', 'id'=>$data->post_id)); ?></td>
            <td width="35%"><?php echo CHtml::encode($data->post_title); ?></td>
            <td width="40%"><?php echo CHtml::encode($data->post_content); ?></td>
            <td width="10%"><?php echo CHtml::encode(Post::$roleDescription[$data->post_role]); ?></td>
            <td ><?php echo CHtml::encode(showFormatDateTime($data->post_time)); ?></td>
        </tr>
    </table>
</div>