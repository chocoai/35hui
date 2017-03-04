<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
?>
<div class="search">
    <div class="sctit">
        <form method="post" id="headSearchForm" action="<?php echo Yii::app()->createUrl('site/shopheadsearch'); ?>" onsubmit="changeValue('submit')">
            <?php
            $get = SearchMenu::explodeAllParamsToArray();
            $this->widget('CAutoComplete',
                    array(
                        'name' => 'kwords',
                        "id" => "searchkwords",
                        'url' => array('site/ajaxautocomplete'),
                        "value" => isset($get['keyword']) && $get['keyword'] ? urldecode($get['keyword']) : "请输入商铺名称",
                        'max' => 10, //显示最大数
                        'minChars' => 1, //最小输入多少开始匹配
                        'delay' => 500, //两次按键间隔小于此值，则启动等待
                        'scrollHeight' => 200,
                        "extraParams" => array("type" =>"6"), //表示是楼盘、商业广场还是小区
                        'htmlOptions' => array('class' => 'txt_1', "onfocus" => "changeValue('on')", "onblur" => "changeValue('out')",),
                        "methodChain" => ".result(function(event,item){\$(\"#headSearchForm\").submit()})", //回调函数
            ));
            ?>
            <input type="hidden" name="sellorrent" value="<?=$type=='rent'?1:3;?>" />
            <input type="hidden" name="type" value="1" />
            <input type="submit" class="btn_1" value="" />
        </form>
    </div>
<?php
         $this->widget('SearchMenuCondition',array(
				'options'=>$options,
				'officeType'=>Findcondition::shop,
				'rentorsell'=>Findcondition::rent,
			));

        ?>

				<?php
				$this->widget('SearchMenu',array(
					'showMenu'=>array(1,21,3,22),//显示的条件
					'url'=>$url,//url
                    "sourceType"=>1,
                    "inputSearchBoolean"=>false,//不要输入框搜索
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
                                $options["order"]=="rtime"?$select="时间从新倒旧":"";//得房率从高到低
                                $options["order"]=="ru"?$select="租金由低到高":"";//物业管理费从低到高
                                $options["order"]=="rd"?$select="租金由高到低":"";//物业管理费从高到低
                                $options["order"]=="au"?$select="面积由旧到新":"";//得房率从低到高
                                $options["order"]=="ad"?$select="面积由新到旧":"";//得房率从高到低
                            }
                            echo $select;
                            ?></h5>
                        <div class="ul" style="display:none">
                            <? $actionID = $this->getAction()->getId();?>
                            <p><a href="/shop/<?=$actionID?>">默认排序</a></p>
                            <p><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", 'rtime'))?>">时间从新倒旧</a></p>
                            <p><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", 'ru'))?>">租金由低到高</a></p>
                            <p><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", 'rd'))?>">租金由高到低</a></p>
                            <p><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", 'au'))?>">面积由旧到新</a></p>
                            <p><a href="<?php echo Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", 'ad'))?>">面积由新到旧</a></p>
                        </div>
                    </div>
                </div>
                <div class="sch_2">
                    <div class="zjpaixu" style="width:50px;">
                        <?php
                        if($saleOrRent==1){//出租，显示租金
                            if(isset ($options['order'])&&$options['order']=="ru") {
                                $options_tmp = 'zd';
                                $class = "mrenup";
                            }else if(isset ($options['order'])&&$options['order']=="rd") {
                                $options_tmp = '';
                                $class = "mrendown";
                            }else {
                                $options_tmp = "ru";
                                $class = "mren";
                            }
                            echo CHtml::link("租金",Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp)),array("class"=>"listbg ".$class));
                        }else{
                            if(isset ($options['order'])&&$options['order']=="su") {
                                $options_tmp = 'sd';
                                $class = "mrenup";
                            }else if(isset ($options['order'])&&$options['order']=="sd") {
                                $options_tmp = '';
                                $class = "mrendown";
                            }else {
                                $options_tmp = "su";
                                $class = "mren";
                            }
                            echo CHtml::link("售价",Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", $options_tmp)),array("class"=>"listbg ".$class));
                        }

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
            <div class="schtrt">
                <?php
                
                if($saleOrRent==1){
                    echo CHtml::link("切换到经纪人找房模式",array("/uagent/shoprent"),array("class"=>"listbg"));
                }else{
                    echo CHtml::link("切换到经纪人找房模式",array("/uagent/shoptransfer"),array("class"=>"listbg"));
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

        <?
        if($allSource){

        foreach($allSource as $data){
            $this->renderPartial("_{$type}Index", array('data'=>$data));
        }
        
        }else{?>
         <div class="schcont">
                                    <div class="zerocontent">
                                        <div class="sorry_title">抱歉，没有找到符合搜索条件的商铺!</div>
                                        <ul class="noresult">
                                            <li style="font-weight: bold;">您可以</li>
                                            <li>·重新修改搜索条件后再进行搜索</li>
                                            <li>·适当减少一些搜索条件，以便能够获得更多的结果</li>
                                        </ul>
                                    </div>
                                </div>
        <?
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

  <div class="ggrihgt">
                        <div class="allbd" id="allbd" >
                            <h5><em style="line-height:24px;width:100%">没有合适的房源？</em></h5>
                            <div>
                <form onSubmit="return false;" id="Quickrequire-form" action="/quickrequire/addrequire" method="post"><textarea id="user_require" style="color: rgb(153, 153, 153);" title="请在这里写下您的寻租需求，我们将在1个工作日内与您联系。（例如，黄浦区，近地铁，6块之内）" maxlength="300" name="Quickrequire[qrq_require]">请在这里写下您的寻租或投资需求，我们将在一个工作日之内与您联系。（如：浦东新区 小陆家嘴附近 8块以下 高层）</textarea>                            <div class="soh" id="soh" style="display:none">
                    <input id="user_name" style="color: rgb(153, 153, 153)" title="请输入您的姓名" value="请输入您的姓名" name="Quickrequire[qrq_name]" type="text" maxlength="100" /><br/><input id="user_tel" style="color: rgb(153, 153, 153)" title="请输入您的联系方式" value="请输入您的联系方式" name="Quickrequire[qrq_tel]" type="text" maxlength="20" /><br/><input id="user_email" style="color: rgb(153, 153, 153)" title="请输入您的邮箱" value="请输入您的邮箱" name="Quickrequire[qrq_email]" type="text" maxlength="30" /><br/>                        </div>
                        <div class="tjxq" id="tjxq"style="display:none">
                    <input onclick="addRequire()" style="background:url(/images/tjxq.png) no-repeat;width:90px;height:24px" name="yt0" type="button" value="" />                            <em>我们将尽快与您联系。</em>
                        </div>
                    </div>
                </div>

        </form>

</div>
<div class="Tip" id="tipbox" style="background: #F6F6F7;position:fixed;left:45%;top:45%;width:200px;border: 1px #CCC solid;display: none;text-align: center;line-height: 22px;padding: 15px 10px;color: #222;font-size: 14px;"></div>
<script type="text/javascript">
    function changeValue(type){
        var obj = $("#headSearchForm input:[name='kwords']");
        if($(obj).val()=="请输入商铺名称"&&type=="on"){
            $(obj).val("");
        }else if($(obj).val()==""&&type=="out"){
            $(obj).val("请输入商铺名称");
        }else if($(obj).val()=="请输入商铺名称"&&type=="submit"){
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
                url:"/quickrequire/addrequire",
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

        $(".schcont .schdes").bind("mouseenter", function(){
            $(this).find(".schtan").css("display","block");
        }).bind("mouseleave", "", function(){
            $(this).find(".schtan").css("display","none");
        });

        $(".schcont .schtan").bind("mouseenter", function(){
            $(this).find(".swdcont").css("display","block");
        }).bind("mouseleave", "", function(){
            $(this).find(".swdcont").css("display","none");
        });
        //排序
        $(".scmain .sch_2").eq(0).bind("mouseenter",function(){
            $(this).find(".ul").css("display","block");
        }).bind("mouseleave","",function(){
            $(this).find(".ul").css("display","none");
        });

        //比较
        $.pk.pkcheck_Init("business_index","元/工位•月","/business/tmp.html","/businesscenter/compare");
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