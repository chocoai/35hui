<?php
$this->breadcrumbs=array('成功案例',);
?>
<?php
if(Yii::app()->user->hasFlash('message')){
    echo '<div class="msg" style="color:red">'.Yii::app()->user->getFlash('message').'</div>';
}
?>
<div class="msg">您录入的成功案例将会被本站抽点检查，虚假信息将导致积分扣除 <span class="red">1000</span> 点，请慎重填写！</div>
<div class="htit">成功案例</div>
<form action="/manage/successinfo/delete" method="post">
<div class="rgcont">
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr>
                <td class="ftit" colspan="2" width="30%">写字楼</td>
                <td width="7%" class="ftit">楼层</td>
                <td width="10%" class="ftit">面积</td>
                <td  class="ftit">客户公司</td>
                <td width="15%" class="ftit">成交时间</td>
                <td width="11%" class="ftit">操作</td>
            </tr>
            <?php
            foreach($dataProvider->getData() as $data){
                $this->renderPartial('_view', array('data'=>$data));
            }
            ?>
        </table>
    </div>
    <div class="thline">
        <div class="thinpunt" style="padding-left:18px;">
            <input type="checkbox" id="checkall" onchange="funcheckall()" /><label for="checkall">全选本页</label>
            <input type="submit" value="删除" class="btn_01" onclick="return confirm('确定要删除所选记录吗？')"/>
            
            <div style="float:right"><?=CHtml::link("添加新案例","create",array("style"=>"color:#0F29C8"));?></div>
        </div>
        <div class="thpage" style="text-align:right;">
            <?php
            echo "<div style='clear:both; height:35px; padding-top:15px;'>";
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "htmlOptions"=>array("style"=>"float:right"),
            ));
            ?>
        </div>
    </div>
   
</form>
<script type="text/javascript">
    function funcheckall(){
        $("table input[type='checkbox']").attr("checked",$("#checkall").attr("checked"));
    }
</script>