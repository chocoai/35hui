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
                'userOption'=>array(
                    "links"=>array(
                        "物业",
                        "写字楼"=>"/uagent/officerent",
                        "创意园区"=>"/uagent/creativesource",
                    ),
                    "selected"=>"写字楼",
                    "pos"=>"HEAD",
                ),
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
  <div class="ggrihgt">
                        <div class="allbd" id="allbd" >
                            <h5><em style="line-height:24px;width:100%">没有合适的房源？</em></h5>
                            <div>
                <?php
                            $form = $this->beginWidget('CActiveForm', array(
                                        'id' => 'Quickrequire-form',
                                        'action' => '/quickrequire/addrequire',
                                        'enableAjaxValidation' => true,
                                        'htmlOptions' => array('onSubmit' => 'return false;')
                                    ));
                            $newComment = new Quickrequire;
                            $newComment->qrq_require = "请在这里写下您的寻租或投资需求，我们将在一个工作日之内与您联系。（如：浦东新区 小陆家嘴附近 8块以下 高层）";
                            echo $form->textArea($newComment, 'qrq_require', array("id" => "user_require", 'style' => 'color: rgb(153, 153, 153);', "title" => "请在这里写下您的寻租需求，我们将在1个工作日内与您联系。（例如，黄浦区，近地铁，6块之内）", 'maxlength' => "300")); ?>
                            <div class="soh" id="soh" style="display:none">
                    <?
                            echo $form->textField($newComment, 'qrq_name', array("id" => "user_name", "style" => "color: rgb(153, 153, 153)", "title" => "请输入您的姓名", "value" => "请输入您的姓名")) . "<br/>";
                            echo $form->textField($newComment, 'qrq_tel', array("id" => "user_tel", "style" => "color: rgb(153, 153, 153)", "title" => "请输入您的联系方式", "value" => "请输入您的联系方式")) . "<br/>";
                            echo $form->textField($newComment, 'qrq_email', array("id" => "user_email", "style" => "color: rgb(153, 153, 153)", "title" => "请输入您的邮箱", "value" => "请输入您的邮箱")) . "<br/>"; ?>
                        </div>
                        <div class="tjxq" id="tjxq"style="display:none">
                    <? echo CHtml::Button('', array('onclick' => 'addRequire()', "style" => "background:url(/images/tjxq.png) no-repeat;width:90px;height:24px")); ?>
                            <em>我们将尽快与您联系。</em>
                        </div>
                    </div>
                </div>

        <?php $this->endWidget(); ?>
</div>
<div class="Tip" id="tipbox" style="background: #F6F6F7;position:fixed;left:45%;top:45%;width:200px;border: 1px #CCC solid;display: none;text-align: center;line-height: 22px;padding: 15px 10px;color: #222;font-size: 14px;"></div>

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
    function alertTip(msg){
        $(".Tip").html(msg);
        $(".Tip").fadeIn(500,function(){
            $(".Tip").fadeOut(3000);
        });
    }
    function addRequire(){
        if(checkUName($("#user_require"),true)&&checkUName($("#user_name"),true)&&checkUName($("#user_tel"),true)){
            $.ajax({
                type:"post",
                url:"<?= Yii::app()->createUrl('/quickrequire/addrequire') ?>",
                data: $("#Quickrequire-form").serialize(),
                success: function(Msg){
                    alertTip(Msg);
                   $("#user_require").val("");
                   $("#user_name").val("");
                   $("#user_tel").val("");
                   $("#user_email").val("");
                    if(Msg=="您的需求已成功提交，我们会再1个工作日之内联系您，谢谢!"){
                        document.getElementById("soh").style.display = "none";
                        document.getElementById("tjxq").style.display = "none";
                    }
                }
            });
        }else{
             alertTip("请填写完整您的需求信息、您的姓名以及联系方式")
        }
    }
    function addListener(element, e, fn) {
        if (element.addEventListener) {
            element.addEventListener(e, fn, false);
        } else {
            element.attachEvent("on" + e, fn);
        }
    }

    function checkUName(obj,check){
        if(obj.val()==""||obj.val()=="请在这里写下您的寻租或投资需求，我们将在一个工作日之内与您联系。（如：浦东新区 小陆家嘴附近 8块以下 高层）"||obj.val()=="请输入您的邮箱"||obj.val()=="请输入您的姓名"||obj.val()=="请输入您的联系方式"){
                if(check)return false;
                obj.val("").css("color","black");
        }
        return true;
    }
    $(document).ready(function(){
        addListener(document, "click",function(evt) {
        var evt = window.event ? window.event: evt,
        target = evt.srcElement || evt.target;
        if (target.id == "user_require") {
            document.getElementById("soh").style.display = "";
            document.getElementById("tjxq").style.display = "";
            return;
        } else {
            while (target.nodeName.toLowerCase() != "div" && target.nodeName.toLowerCase() != "html") {
                target = target.parentNode;
            }
            if (target.nodeName.toLowerCase() == "html") {
                document.getElementById("soh").style.display = "none";
                document.getElementById("tjxq").style.display = "none";
            }
        }
    })
        $("#user_require").focus(function(){
             checkUName($("#user_require"),false);
        })
        $("#user_name").focus(function(){
            checkUName($("#user_name"),false);
        })
        $("#user_tel").focus(function(){
            checkUName($("#user_tel"),false);
        })
        $("#user_email").focus(function(){
            checkUName($("#user_email"),false);
        })
        
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
                    if($(table).find("tr").length>3){
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