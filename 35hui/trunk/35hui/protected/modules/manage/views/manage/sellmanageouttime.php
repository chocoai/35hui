<?php
if($sr=="sell"){
    $this->breadcrumbs=array(
        '房源管理',
        '管理出售房源',
        '过期房源',
    );
}else{
    $this->breadcrumbs=array(
        '房源管理',
        '管理出租房源',
        '过期房源',
    );
}
?>
<?php $this->renderPartial('_managetop',array("url"=>$url,"tab"=>"4","show"=>$show));?>
<div  id="manbrightChild1" class="rgcont">
    <form method="post" action="<?=$url?>" id="searchform">
        <?php $this->renderPartial('_managesearchdiv',array("show"=>$show,"sr"=>$sr));?>
        <table border="0" cellpadding="0" cellspacing="0" class="table_01">
            <tr>
                <td class="ftit" colspan="2">房源基本信息</td>
                <td class="ftit" width="15%">重新发布</td>
                <td class="ftit" width="10%">录入时间</td>
                <td class="ftit" width="10%">过期时间</td>
            </tr>
            <?php
            foreach($dataProvider->getData() as $data){
                $this->renderPartial('_sellmanageouttime', array(
                    'data'=>$data,
                    'sourceType'=>$show['sourceType'],
                    )
                );
            }
            ?>
        </table>
    <input type="hidden" name="tag" value="outtime"/>
    </form>
</div>
<div class="jefenpage">
    <?php
        $this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "htmlOptions"=>array("style"=>"float:right"),
        ));
    ?>
</div>
<div class="thline" style="padding-left:14px;">
	<div class="thinpt">
        <input id="chkAll" name="chkAll" type="checkbox" onclick='checkAll(this.checked)' /><label for="chkAll">全选</label>
        <input type="button" class="btn_01" value="发布房源" onclick="javascript:opration(4)" />
        <input type="button" class="btn_01" value="删除房源" onclick="javascript:opration(1)" />
</div>
</div>