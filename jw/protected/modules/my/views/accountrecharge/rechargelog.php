<?=$this->renderPartial('_leftmenu');?>
<div class="zfmain">
    <div class="yue">我的账户余额：<em><?=$userModel->u_goldnum?></em>金币</div>
    <div class="czmain">
        <table class="zftab" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td><strong>充值时间</strong></td>
                <td><strong>充值金额</strong></td>
                <td><strong>获得金币</strong></td>
                <td><strong>流水号</strong></td>
            </tr>
            <?php
            foreach($dataProvider->getData() as $data) {
                $this->renderPartial('_rechargelog', array(
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