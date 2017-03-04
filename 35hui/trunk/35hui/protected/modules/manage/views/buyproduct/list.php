<?php
$this->breadcrumbs=array('历史购买记录');
?>

<div class="htit">历史购买记录</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td width="15%" class="ftit">页面</td>
            <td width="15%" class="ftit">模块</td>
            <td width="10%" class="ftit">购买价</td>
            <td width="7%" class="ftit">天数</td>
            <td width="20%" class="ftit">购买时间</td>
            <td width="20%" class="ftit">结束时间</td>
            <td class="ftit">返回新币</td>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
            $this->renderPartial('_list', array('data'=>$data));
        }
        ?>
    </table>
</div>
<div class="jefenpage">
    <?php
    $this->widget('CLinkPager',array(
            'pages'=>$dataProvider->pagination,
            "htmlOptions"=>array("style"=>"float:right"),
    ));
    ?>
</div>