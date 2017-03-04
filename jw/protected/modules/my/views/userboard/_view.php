<tr>
    <td><?=($page-1)*$pageSize+($number+1)?></td>
    <td>
        <?php 
        $userModel = User::model()->getUserInfoById($data->ub_userid);
        echo CHtml::link($userModel->u_nickname,array("/user/view","id"=>$data->ub_userid),array("target"=>"_blank"));
        ?>
    </td>
    <td>
        <?php
        if($data->ub_albumid){
            $return = "相册";
            $album = Album::model()->findByPk($data->ub_albumid);
            if($album){
                $return .= "(".CHtml::link($album->am_albumtitle,array("/album/view","id"=>$data->ub_albumid),array("target"=>"_blank")).")";
            }else{
                $return .="(已删除)";
            }
        }else{
            $return = "本身";
        }
        echo $return;
        ?>
    </td>
    <td>
        <?=date("Y年m月d日 H:i",$data->ub_createtime)?>
    </td>
    <td>
        <?php
        echo Userboard::model()->getBoardImgSrc($data->ub_boardtype,"30px");
        ?>
    </td>
</tr>