<?php
$this->breadcrumbs=array(
        '推广方案',
);
?>


<div class="htit">推广方案</div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tbody>
            <tr>
                <td class="itit">&nbsp;</td>
                <td class="itit">可发布总数</td>
                <td class="itit">可录入总数</td>
                <td class="itit">最大日刷新数</td>
                <td class="itit">费用</td>
                <td class="itit">标签</td>
            </tr>
            <?php
            foreach($combo as $key=>$value){
                ?>
            <tr>
                <td class="txt"><?=$value['cb_name']?></td>
                <td class="txt"><?=$value['cb_issuednum']?></td>
                <td class="txt"><?=$value['cb_inputnum']?></td>
                <td class="txt"><?=$value['cb_refreshnum']?></td>
                <td class="txt"><?=$value['cb_comboprice']?>元/月</td>
                <td class="txt"><?=CHtml::image($value['cb_iconurl'])?></td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div class="hytit">当前方案：<em><?php
if($comboModel){
    echo "<font color='black'>您购买了&nbsp;&nbsp;".$comboModel->cb_name."&nbsp;&nbsp;".CHtml::image(Combo::model()->getComboIconUrl($comboModel))."&nbsp;&nbsp;过期时间：".date("Y-m-d",$model->ua_combotime)."</font>";
}else{
    echo "您还没有购买任何推广方案";
}
?></em></div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_02">
        <tbody>
            <tr>
                <td class="tit">可发布房源总数</td>
                <td class="tit">可录入房源总数</td>
                <td class="tit">每日最大可刷新数</td>
            </tr>
            <tr>
                <td class="txt"><?=$allNum[0]?></td>
                <td class="txt"><?=$allNum[1]?></td>
                <td class="txt"><?=$allNum[2]?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="hyservice">购买电话：<em class="red">400-820-9181</em></div>
