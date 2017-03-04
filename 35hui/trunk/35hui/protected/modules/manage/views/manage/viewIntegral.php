<?php
$this->breadcrumbs=array(
        '付币服务',
        '积分记录'
);
?>
<div class="htit">我的积分</div>
<div class="jifentit">
    <div class="ji_01"style="width:800px;height:100px;border:1xp solid;">
        <div style="float:left;width:200px;line-height:40px;" >
        <p>我当前的等级：<?php echo User::model()->getUserLevelByUserId(Yii::app()->user->id);?></p>
        <p>我当前的积分：<em class="red"><?=$userProperty->m_point?></em></p>　　
        </div>
        <div style="float:left;width:467px;height:70px;">

                <?
                $keyarr=array_keys(User::$pointArr);
                    $valarr=array_values(User::$pointArr);
                   for($i=0;$i<count($keyarr);$i++){
                        if($userProperty->m_point<$keyarr[$i])break;                        
                   }
                   if($i>count($keyarr)-1)$i=count($keyarr)-1;
                   if($i==1){
                       $a=$userProperty->m_point;
                       $b=$keyarr[$i];
                   }else{
                   $a=$userProperty->m_point-$keyarr[$i-1];
                   $b=$keyarr[$i]-$keyarr[$i-1];
                   }
                   $ratio1=($a/$b)*25>25?50:($a/$b)*25;
                   $ratio2=($i-1)*25;
                   $radio=$ratio1+$ratio2;
               ?>
            <div style="color:#ffffff;width:100px;height:30px;left:<?=$radio<=100?$radio-1.5:"98.5"?>%;position:relative;background: url('/images/info_w.gif')no-repeat;text-align:center;line-height:20px;"><?=$userProperty->m_point."/".$keyarr[$i]?></div>
            <div style="padding-left:9px;;height: 19px;width: 469px;">
                <div style="display: inline;float: left;height: 23px;width: 468px;padding: 1px 0px;background: url('/images/bar_2.gif') repeat-x;overflow: hidden">
                    <div style="float:left;width:<?=$radio?>%;height: 17px;float: left;background: url('/images/bar_1.gif') no-repeat;color: white;text-align: right;">
                        
                    </div>
                </div>
            </div>
            <table>
                <tr>
                <?
                for($i=0;$i<4;$i++){?>
                    <td width="117px"><?php
                    $title=substr(User::$titleArr[$i],0,12);
                    if($userProperty->m_point>=$keyarr[$i]){
                        echo CHtml::image(IMAGE_URL."/up_2.jpg","",array("title"=>$title))."<br/>";
                        echo CHtml::image(IMAGE_URL."/level/lv".($i+1).".gif","",array("title"=>$title))."(<span style='color:#ff0000'>{$keyarr[$i]}</span>)";
                    }else{
                        echo CHtml::image(IMAGE_URL."/up_1.jpg","",array("title"=>$title))."<br/>";
                        echo CHtml::image(IMAGE_URL."/level/".$valarr[$i],"",array("title"=>$title))."(<span style='color:#ff0000'>{$keyarr[$i]}</span>)";
                    }
                    ?></td>
                <?}?>
                    </tr>
            </table>
        </div>
    </div>
  　<div class="ji_02"style="float:left;clear:both">
       本日获取：<em class="red"><?=$userProperty->m_todaypoint?></em>　
       每日获取积分上限：<em class="red"><?=Oprationconfig::model()->getConfigByName("oneday_get_max_point",0)?></em>
    <a href="/help/money" target="_blank">查看积分规则</a>
    <a href="#" onclick="clearLog('<?=Log::integral?>')">清除陈旧记录</a></div>
</div>
<div class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_02">
        <tr>
            <td width="20%" class="tit">日期</td>
            <td width="10%" class="tit">积分</td>
            <td width="70%" class="tit">说明</td>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
            $this->renderPartial('_log', array('data'=>$data));
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
<script type="text/javascript">
    function clearLog(type){
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createUrl("/manage/log/ajaxClearLog");?>',
            data: {"type":type},
            success: function(msg){
                if(msg==1){
                    alert("清除成功");
                    window.location.reload();
                }else if(msg==3){
                    alert("请先登录");
                    window.location.reload();
                }else{
                    alert("清除失败");
                }
            }
        });
    }
</script>