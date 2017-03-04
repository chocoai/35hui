<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
?>
<div class="search">
    <div class="sctit">
        <form method="post" id="headSearchForm" action="<?php echo Yii::app()->createUrl('site/officeheadsearch');?>" onsubmit="changeValue('submit')">
            <?php
            $get = SearchMenu::explodeAllParamsToArray();
            ?>
            <input type="text" name="kwords" value="<?=isset($get['keyword'])&&$get['keyword']?urldecode($get['keyword']):"请输入经纪人名称"?>" class="txt_1" onblur="changeValue('out')" onfocus="changeValue('on')"/>
            <input type="hidden" name="type" id="form_type" value="3" />
            <input type="hidden" name="sellorrent" id="form_sellorrent" value="<?=$saleOrRent?>" />
            <input type="submit" class="btn_1" value="" />
        </form>
    </div>
    <?php
    $this->widget('SearchMenuCondition',array(
            'options'=>$options,
            'officeType'=>Findcondition::office,
            'rentorsell'=>$saleOrRent,
    ));
    if($saleOrRent==1){
        $this->widget('SearchMenu',array(
                'showMenu'=>array(1,3,6,7),//显示的条件
                'url'=>$url,//url
        ));
    }else{
        $this->widget('SearchMenu',array(
                'showMenu'=>array(1,3,5,7),//显示的条件
                'url'=>$url,//url
        ));
    }
    ?>
</div>


<div class="scmain">
    <div class="scleft">
        <div class="schtit">
            <div class="schtlt">
                <div class="sch_1">排序：</div>
                <div class="sch_2">
                    <div class="scmoren listbg">
                        <h5><?php
                            $select = "默认排序";
                            if(isset($options["order"])){
                                $options["order"]=="sa"?$select="按综合能力由低到高":"";//按经纪人综合分由低到高
                                $options["order"]=="sd"?$select="按综合能力由高到低":"";//按经纪人综合分由高到低
                                $options["order"]=="ya"?$select="按从业年限由低到高":"";//按从业年限由低到高
                                $options["order"]=="yd"?$select="按从业年限由高到低":"";//按从业年限由高到低
                            }
                            echo $select;
                            ?></h5>
                        <div class="ul" style="display:none">
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", ""))?>">默认排序</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "sa"))?>">按综合能力由低到高</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "sd"))?>">按综合能力由高到低</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "ya"))?>">按从业年限由低到高</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "yd"))?>">按从业年限由高到低</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="schtrt">
                <?php
                if($saleOrRent==1){
                    echo CHtml::link("切换到经典找房模式",array("/officebaseinfo/rentIndex"),array("class"=>"listbg"));
                }else{
                    echo CHtml::link("切换到经典找房模式",array("/officebaseinfo/saleIndex"),array("class"=>"listbg"));
                }
                ?>
            </div>
            <div class="schtpage">
                <?php
                    $allSource = $dataProvider->getData();
                    $this->widget('CDibiaoLinkPager',array(
                        'pages'=>$dataProvider->pagination,
                        "htmlOptions"=>array("style"=>"float:right","class"=>"dibiaoPage",),
                        "nextPageLabel"=>"下一页",
                        "prevPageLabel"=>"上一页",
                        "cssFile"=>"/css/pager.css",
                    ));
                ?>
            </div>
        </div>
        <?php
        if($allSource){
            foreach($allSource as $data){
                $this->renderPartial('_officesearchindex', array('data'=>$data,"saleOrRent"=>$saleOrRent,'onlineUser'=>$onlineUser,));
            }
        }else{
        ?>
        <div class="schcont">
            <div class="zerocontent">
                <div class="sorry_title">抱歉，没有找到符合搜索条件的经纪人!</div>
                <ul class="noresult">
                    <li style="font-weight: bold;">您可以</li>
                    <li>·重新修改搜索条件后再进行搜索</li>
                    <li>·适当减少一些搜索条件，以便能够获得更多的结果</li>
                </ul>
            </div>
        </div>
        <?php
        }
        
        ?>
        <div class="pager">
            <?php
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "cssFile"=>"/css/pager.css",
                    "header"=>"",
            ));
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    function changeValue(type){
        var obj = $("#headSearchForm input:[name='kwords']");
        if($(obj).val()=="请输入经纪人名称"&&type=="on"){
            $(obj).val("");
        }else if($(obj).val()==""&&type=="out"){
            $(obj).val("请输入经纪人名称");
        }else if($(obj).val()=="请输入经纪人名称"&&type=="submit"){
            $(obj).val("");
        }
    }
    $(document).ready(function(){
        $(".schcont .schtan").bind("mouseenter", function(){
            $(this).find(".rtcont").css("display","block");
        }).bind("mouseleave", "", function(){
            $(this).find(".rtcont").css("display","none");
        });
        $(".schcont .schdes").bind("mouseenter", function(){
            $(this).find(".schtan").css("display","block");
        }).bind("mouseleave", "", function(){
            $(this).find(".schtan").css("display","none");
        });

        $(".schcont .gemore span").bind("click", function(){
            var obj = $(this);
            var userId = $(obj).attr("attr");
            if(typeof(userId)=="undefined"){
                var table = $(this).parent().prev(".tabcont").find("table");
                for(var i=5;i>0;i--){
                    if($(table).find("tr").length>6){
                        $(table).find("tr").last().remove();
                    }
                }
                if($(table).find("tr").length<=6){//点击收起按钮
                    $(obj).css("display","none");
                }
                var maxNum = $(obj).prev("span").attr("max");
                if(($(table).find("tr").length-1)<maxNum){//查看更多按钮
                    $(obj).prev("span").css("display","block");
                }
            }else{
                $(obj).css("display","none");
                var table = $(obj).parent().prev(".tabcont").find("table");
                var start = $(table).find("tr").length-1;
                var loading = "<tr><td class='txt' colspan='10'><img src='/images/loading.gif' /></td></tr>";
                var condition = "<?=@$_GET["search"]?>"
                table.append(loading);
                $.ajax({
                    url:"/uagent/ajaxgetofficesource",
                    type:"GET",
                    data:{"start":start,"saleOrRent":"<?=$saleOrRent?>","userId":userId,"condition":condition},
                    success:function (msg){
                        $(table).find("tr").last().remove();
                        $(obj).next("span").css("display","block");
                        var msg = eval(msg);
                        for(var i=0;i<msg.length;i++){
                            var html = "<tr>";
                            html +='<td class="txt"><a href="'+msg[i].namelink+'" target="_blank">'+msg[i].name+'</a></td>';
                            html +='<td class="txt">'+msg[i].floortype+'</td>';
                            html +='<td class="txt">'+msg[i].officearea+'平米</td>';
                            html +='<td class="txt">'+msg[i].price+'</td>';
                            html +='<td class="txt">'+msg[i].propertyprice+'</td>';
                            html +='<td class="txt"><a href="'+msg[i].link+'" target="_blank">详细</a></td>';
                            html +='</tr>';
                            table.append(html);
                        }
                        var maxNum = $(obj).attr("max");
                        if(($(table).find("tr").length-1)<maxNum){
                            $(obj).css("display","block");
                        }
                    }
                })
            }
        });
        $(".scmain .sch_2").eq(0).bind("mouseenter",function(){
            $(this).find(".ul").css("display","block");
        }).bind("mouseleave","",function(){
            $(this).find(".ul").css("display","none");
        });
        $("table.table_01 tr").live('mouseover',function(){
            $(this).addClass("trbg");
        }).live('mouseout',function(){
            $(this).removeClass("trbg");
        });
    })
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F579bf00bc2e83979133ed98063c70f99' type='text/javascript'%3E%3C/script%3E"));
</script> 