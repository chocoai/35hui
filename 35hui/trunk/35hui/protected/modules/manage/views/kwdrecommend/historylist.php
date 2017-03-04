<?php
$this->breadcrumbs=array(
    '关键词推广',
	'我的购买记录',
);
?>
<div class="htit">我的购买记录</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="60%" class="tit">关键词</td>
            <td width="20%" class="tit">购买时间</td>
            <td width="20%" class="tit">过期时间</td>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
            $this->renderPartial('_historylist', array('data'=>$data));
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