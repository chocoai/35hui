<?=$this->renderPartial('_leftmenu');?>
<div class="zfmain">
    <div class="yue">我的账户余额：<em><?=$userModel->u_goldnum?></em>金币</div>
    <div class="czmain">
        <table class="zftab" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td width="150px"><strong>消费时间</strong></td>
                <td width="80px"><strong>金币</strong></td>
                <td><strong>消费内容</strong></td>
            </tr>
            <?php
            foreach($dataProvider->getData() as $data) {
                $this->renderPartial('_consumelog', array(
                        'data'=>$data,
                ));
            }
            ?>
        </table>
    </div>
</div>

<?php
$this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "cssFile"=>"/css/pager.css"
));
?>