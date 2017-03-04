<style type="text/css">
    *{margin:0; padding:0;}
    #box{width:610px; height:530px; padding:15px 10px; border:1px solid #666; margin:0 auto; text-align:center; margin-top:5px; position:relative;}
    #top{width:610px}
    input[type="text"]{border:1px solid #666; height:18px; line-height:18px; widows:100px;}
    input[type="submit"]{background:url(/images/red_search.gif) no-repeat; width:59px; height:18px; border:0;cursor: pointer}
    .dtail{margin-top:15px;}
    .gridview {width:610px;margin:8px 0;font:normal 12px/22px Courier New; border:1px solid #C7DEDD;height: auto}
    .gridview table {padding: 1px;margin-left:5px}
    .gridview  table tr td {font:normal 12px Arail;text-align:left;line-height: 21px;}
    .gridview  table.even {background:#eef5fd;}
    .gridview  table.odd {background:#FFF;}
    fieldset{width:610px; text-align:left; padding-bottom:12px; padding-top:12px; border:1px solid #C7DEDD; margin-top:10px;}
    fieldset form{text-indent:15px;}
    legend{azimuth:left; margin-left:25px; color:#4F6B72;}
    .closed{position:absolute; right:15px; top:10px;}
    .l15px{margin-left:15px;}
    .pager{height: 30px}
</style>
<div id="box">
    <div id="top">
        <div class="closed"><?=CHtml::image(IMAGE_URL."/red_close.gif","",array("onClick"=>"parent.closetip()","style"=>"cursor:pointer"))?></div>
        <fieldset>
            <legend>查询</legend>
            <form action="" method="post">
                <?php
                if($typeName=="office"){
                    ?>
                <label>写字楼名称：<input type="text" name="name" value="<?=isset($show['name'])?$show['name']:""?>"/></label>
                    <?php
                }
                ?>
                <label class="l15px" >标题：<input type="text" name="title" value="<?=isset($show['title'])?$show['title']:""?>"/></label>
                <label style="text-align:center;" class="l15px"><input type="submit" value="" /></label>
            </form>
        </fieldset>
    </div>
    <div class="gridview">
        <?php
        $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_choosesource',
                'summaryText'=>'',
                'summaryCssClass'=>'',
                'viewData'=>array("typeName"=>$typeName),
                'afterAjaxUpdate'=>"updateStyle",
        ));
        ?>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        updateStyle();
    });
    function updateStyle(){
        $(".gridview table:odd").addClass("odd"); //奇数行设定为 "odd" 样式
        $(".gridview table:even").addClass("even"); //偶数行设定为 "even" 样式
    }
    function setSource(sourceid){
        if(confirm("确定要设置此房源吗？")){
            $.ajax({
               type: "GET",
               url: "<?php echo Yii::app()->createUrl('/manage/applyhighsource/setsource');?>",
               data:{"sourceid":sourceid,"type":<?=$type?>},
               async: false,
               success:function(msg){
                   if(msg=="success"){
                        alert("设置成功！");
                        window.parent.location.reload();
                   }else{
                        alert(msg);
                   }
               }
            });
        }
    }
</script>