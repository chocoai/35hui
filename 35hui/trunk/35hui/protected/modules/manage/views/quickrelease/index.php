<?php
$this->breadcrumbs=array(
    '经纪人合作',
);
$uagent = Uagent::model()->find('ua_uid='.Yii::app()->user->id);
if(!($uagent&&$uagent->ua_combo)){
?>

<div class="msg">
    经纪人您好,业主委托房源只有付费会员才能看到,<a href="<?php echo $this->createUrl('buycombo/index') ?>" style="color:blue">点击了解付费信息</a>
</div>
<?php }else{ ?>
<div class="htit">
    <strong>业主委托列表</strong>
</div>
<!-- date list -->
<div id="manbrightChild1" class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <td class="ftit" width="4%">ID</td>
            <td class="ftit" width="7%">租售</td>
            <td class="ftit" width="12%">楼盘名称</td>
            <td class="ftit" width="8%">楼层</td>
            <td class="ftit" width="8%">面积</td>
            <td class="ftit" width="12%">装修情况</td>
            <td class="ftit" width="8%">联系人</td>
            <td class="ftit" width="12%">联系方式</td>
            <td class="ftit" width="21%">备注</td>
            <td class="ftit" width="12%">发布时间</td>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
        ?>
        <tr>
            <td class="txt" width="4%"><?php echo $data->qrl_id?></td>
            <td class="txt" width="7%"><?php echo $data->qrl_srtp=='1'?'租':'售'?></td>
            <td class="txt" width="12%"><?php echo CHtml::encode($data->buildname->sbi_buildingname)?></td>
            <td class="txt" width="8%"><?php echo $data->qrl_floor?></td>
            <td class="txt" width="8%"><?php echo $data->qrl_area?>m<sup>2</sup></td>
            <td class="txt" width="12%"><?php echo isset(Officebaseinfo::$adrondegree[$data->qrl_zhuang])?Officebaseinfo::$adrondegree[$data->qrl_zhuang]:$data->qrl_zhuang ?></td>
            <td class="txt" width="8%"><?php echo CHtml::encode($data->qrl_contact) ?></td>
            <td class="txt" width="12%"><?php echo CHtml::encode($data->qrl_tel)?></td>
            <td class="txt" style=" text-align: left;" width="21%"><?php echo CHtml::encode($data->qrl_remark)?></td>
            <td class="txt" width="12%"><?php echo date("Y-m-d H:i",$data->qrl_timestamp);?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>
<div class="jefenpage">
    <?php
        $this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        ));
    ?>
</div>
<?php } ?>

