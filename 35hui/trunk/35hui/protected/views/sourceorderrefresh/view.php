<?php
$this->temp=$menu;
$this->breadcrumbs=array(
	"我的新地标"=>array('/site/userindex'),
	'预约刷新详细',
);
?>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">预约刷新详细</div>
    <div class="manage_rightboxthree">
        <div id="receiveBox" style="width:95%;margin-left: 10px" class="manage_tabletwo">
            <div style="color:#F60">
                <?=$title;?>
            </div>
            <div style="clear:both;width:80%;float:left">
                此房源设置预约时间为<font style="color:#F60"><?=$sourceOrderRefresh?date("Y-m-d H:i", $sourceOrderRefresh[0]->sor_releasetime):"暂无"?></font>，预约刷新将在方案设置后进行。
            </div>
            <div style="width:20%;float:left">
                <?=CHtml::link("查看房源详细",array($url,"id"=>$sourceId),array("target"=>"_blank","style"=>"color:blue"));?>
            </div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="maintb" style="padding-top: 10px">
                <tr bgcolor="#D4E8FF">
                    <td width="50%" align="center">日期</td>
                    <td align="center">预约时间点</td>
                </tr>
                <?php
                if($sourceOrderRefresh){
                    foreach($sourceOrderRefresh as $value){
                ?>
                <tr>
                    <td align="center"><?=date("Y-m-d", $value->sor_releasetime)?>&nbsp;到&nbsp;<?=date("Y-m-d", $value->sor_deadline)?></td>
                    <td align="center"><?=Sourceorderrefresh::model()->formatOrderTime($value->sor_ordertime);?></td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <div class="manage_righttwoline"></div>
</div>