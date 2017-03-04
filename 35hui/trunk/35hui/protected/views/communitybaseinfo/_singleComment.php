<ul style="clear: both">
    <li class="one">
         <?php
            $headPic = User::model()->getUserHeadPic($data->comyc_uid, "_small");
            echo CHtml::image($headPic,'',array('width'=>'50px','height'=>'50'));
        ?>
    </li>
    <li class="two">
        <p>
            <span class="zise"><?=User::model()->getNamebyid($data->comyc_uid)?>：</span>
            <?=CHtml::encode($data->comyc_comment)?>
        </p>
    <p class="pltime"><?=date("Y-m-d H:i",$data->comyc_comdate)?></p>
    </li>
</ul>
