<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
?>
<div class="search">
    <div class="sctit">
        <form method="post" id="headSearchForm" action="<?php echo Yii::app()->createUrl('site/creativeheadsearch');?>" onsubmit="changeValue('submit')">
            <?php
            $get = SearchMenu::explodeAllParamsToArray();
            $this->widget('CAutoComplete',
                    array(
                    'name'=>'kwords',
                    "id"=>"searchkwords",
                    'url'=>array('site/ajaxautocomplete'),
                    "value"=>isset($get['keyword'])&&$get['keyword']?urldecode($get['keyword']):"请输入写字楼名称",
                    'max'=>10,//显示最大数
                    'minChars'=>1,//最小输入多少开始匹配
                    'delay'=>500, //两次按键间隔小于此值，则启动等待
                    'scrollHeight'=>200,
                    "extraParams"=>array("type"=>"5"),//表示是楼盘、商业广场还是小区
                    'htmlOptions'=>array('class'=>'txt_1',"onfocus"=>"changeValue('on')","onblur"=>"changeValue('out')",),
                    "methodChain"=>".result(function(event,item){\$(\"#headSearchForm\").submit()})",//回调函数
            ));
            ?>
            <input type="submit" class="btn_1" value="" />
        </form>
    </div>
    <?php
    $this->widget('SearchMenuCondition',array(
            'options'=>$options,
            "saveCondition"=>false,
    ));
    $this->widget('SearchMenu',array(
            'showMenu'=>array(1,3,6),//显示的条件
            'url'=>$url,//url
            "showSection"=>false,
            'userOption'=>array(
                "links"=>array(
                    "物业",
                    "写字楼"=>"/officebaseinfo/rentIndex",
                    "商务中心"=>"/businesscenter/index",
                    "创意园区"=>"/creativesource/index",
                ),
                "selected"=>"创意园区",
                "pos"=>"HEAD",
            ),
    ));

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
                                $options["order"]=="wa"?$select="按物业管理费从低到高":"";//物业管理费从低到高
                                $options["order"]=="wd"?$select="按物业管理费由高到低":"";//物业管理费从高到低
                                $options["order"]=="da"?$select="按得房率由低到高":"";//得房率从低到高
                                $options["order"]=="dd"?$select="按得房率由高到低":"";//得房率从高到低
                            }
                            echo $select;
                            ?></h5>
                        <div class="ul" style="display:none">
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", ""))?>">默认排序</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "wa"))?>">按物业管理费从低到高</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "wd"))?>">按物业管理费由高到低</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "da"))?>">按得房率由低到高</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "dd"))?>">按得房率由高到低</a></p>
                        </div>
                    </div>
                </div>
                <div class="sch_2">
                    <div class="zjpaixu" style="width:50px;">
                        <?php
                            if(isset ($options['order'])&&$options['order']=="zu") {
                                $options_tmp = 'zd';
                                $class = "mrenup";
                            }else if(isset ($options['order'])&&$options['order']=="zd") {
                                $options_tmp = '';
                                $class = "mrendown";
                            }else {
                                $options_tmp = "zu";
                                $class = "mren";
                            }
                            echo CHtml::link("租金",Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp)),array("class"=>"listbg ".$class));
                        ?>
                    </div>
                </div>
                <div class="sch_2">
                    <div class="zjpaixu" style="width:72px;">
                        <?php
                        if(isset ($options['order'])&&$options['order']=="ju") {
                            $options_tmp = 'jd';
                            $class = "jmrenup";
                        }else if(isset ($options['order'])&&$options['order']=="jd") {
                            $options_tmp = '';
                            $class = "jmrendown";
                        }else {
                            $options_tmp = "ju";
                            $class = "jmren";
                        }
                        ?>
                        <a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp))?>" class="listbg <?=$class?>">竣工年月</a>

                    </div>
                </div>
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
                $this->renderPartial('_rentview', array('data'=>$data));
            }
        }else{
            $this->renderPartial('_zeromessage',array("options"=>$options));
        }
        
        ?>
        <div class="pager">
            <?php
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "cssFile"=>"/css/pager.css"
            ));
            ?>
        </div>
    </div>
</div>


<div class="pk" style="display: none">
    <div><img src="/images/pktit.jpg" /></div>
    <div class="pkmain">
        <h2><a href="javascript:void(0)">删除全部</a>写字楼</h2>
        <div class="pkmcont"></div>
        <div class="pkbot"><a href="javascript:voie(0)"><img src="/images/btnpk.jpg" id="pkbtn" /></a></div>
    </div>
    <div><img src="/images/pkbot.jpg" /></div>
</div>
<?php Yii::app()->clientScript->registerScriptFile("/js/pk.js",CClientScript::POS_END);?>
<script type="text/javascript">
    function changeValue(type){
        var obj = $("#headSearchForm input:[name='kwords']");
        if($(obj).val()=="请输入写字楼名称"&&type=="on"){
            $(obj).val("");
        }else if($(obj).val()==""&&type=="out"){
            $(obj).val("请输入写字楼名称");
        }else if($(obj).val()=="请输入写字楼名称"&&type=="submit"){
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
            var build = $(obj).attr("attr");
            if(typeof(build)=="undefined"){
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
                    url:"/creativesource/ajaxgetsource",
                    type:"GET",
                    data:{"start":start,"buildid":build,"condition":condition},
                    success:function (msg){
                        $(table).find("tr").last().remove();
                        $(obj).next("span").css("display","block");
                        var msg = eval(msg);
                        var danwei = "元/平米·天";
                        for(var i=0;i<msg.length;i++){
                            var html = "<tr>";
                            html +='<td class="txt">'+msg[i].dongname+'</td>';
                            html +='<td class="txt">'+msg[i].floortype+'</td>';
                            html +='<td class="txt">'+msg[i].area+'平米</td>';
                            html +='<td class="txt">'+msg[i].price+danwei+'</td>';
                            html +='<td class="txt"> <a href="'+msg[i].namelink+'" target="_blank">'+msg[i].name+'</a></td>';
                            html +='<td class="txt">'+msg[i].tel+'</td>';
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

        var cookieName = "creativeparkrent";
        var danwei = "元/平米•天";
        $.pk.pkcheck_Init(cookieName,danwei,"<?=Yii::app()->createUrl("/creativeparkbaseinfo/view",array("id"=>"tmp"));?>","/creativeparkbaseinfo/compare");
        $(".schcont .schpk input:checkbox").bind("change",function(){//点击选择框
            $.pk.pkcheck_onclick(this,$(this).val(),$(this).attr("attrname"),$(this).attr("attrprice"));
        })
        $(".pk a").eq(0).bind("click",function(){//删除全部
            $.pk.removeAllPKItem()
        })
        $("#pkbtn").click(function(){
            $.pk.gotoPkNow();
        });
    })
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F579bf00bc2e83979133ed98063c70f99' type='text/javascript'%3E%3C/script%3E"));
</script> 