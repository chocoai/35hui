<div class="tcmain">
    <div class="tccontent">
        <h5><a href="javascript:void(0)" onclick="parent.window.closeTip(true)"><img src="/images/3.gif" /></a><font size="1">选择房源</font></h5>
        <form action="" method="post">
            <div class="tcmtit">
                <?php
                if($type=="office"){
                    ?>
                <span class="tcm_01">房源编号：</span>
                <span class="tcm_01">
                    <input type="text" name="name" class="txt_04" value="<?=isset($show['name'])?$show['name']:""?>"/>
                </span>
                    <?php
                }
                ?>

                <span class="tcm_01">标题：</span>
                <span class="tcm_01">
                    <input type="text" name="title" class="txt_04" value="<?=isset($show['title'])?$show['title']:""?>"/>
                </span>
                <span class="tcm_01"><input type="submit" value="搜索" /></span>
            </div>
        </form>
        <div class="tcmcont">
            <table cellspacing="0" cellpadding="0" border="0" class="table_02">
                <?php
                foreach($dataProvider->getData() as $data){
                    $this->renderPartial('_choosesource', array('data'=>$data,"type"=>$type));
                }
                ?>
            </table>
        </div>

        <div class="fenye">
            <?php
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "htmlOptions"=>array("style"=>"float:right"),
            ));
            ?>
        </div>

    </div>
</div>
<script type="text/javascript">
    function setSource(sourceid){
        if(confirm("确定要设置此房源吗？")){
            $.ajax({
               type: "GET",
               url: "<?php echo Yii::app()->createUrl('/manage/buyproduct/setsource');?>",
               data:{"sourceid":sourceid,"id":<?=$id?>},
               async: false,
               success:function(msg){
                   if(msg=="success"){
                        alert("设置成功！");
                        window.parent.window.closeTip(true);
                    }else{
                        alert(msg);
                    }
               }
            });
        }
    }
</script>