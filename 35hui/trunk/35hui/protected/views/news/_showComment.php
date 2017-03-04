<div>
    <ul class="con">
        <li>
            <dl><dt><?php echo CHtml::encode($data->user['user_name']);?></dt>
                <dd>发表时间：<?php echo date("Y-m-d H:i",$data->c_date); ?></dd>
            </dl>
        </li>
        <li class="bg1"><?php echo CHtml::encode($data['c_comment']);?></li>
    </ul>

</div>