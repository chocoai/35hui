<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;


?>
<div class="search">
    <?php
    $this->widget('SearchMenuCondition',array(
            'options'=>$options,
            'saveCondition'=>false,
    ));
    $this->widget('SearchMenu',array(
            'showMenu'=>array(13,14,7,1),//显示的条件
            'url'=>$url,//url
     ));
    ?>
</div>
<div class="scmain">
    <div class="scleft">
        <div class="schtit">
            <div class="schtlt">
                <div class="sch_1">排序：</div>
                <div class="sch_2">
                    <div class="scmoren listbg" style="z-index:100">
                        <h5><?php
                            $select = "默认排序";
                            if(isset($options["order"])){
                                $options["order"]=="wa"?$select="按物业管理费从低到高":"";//物业管理费从低到高
                                $options["order"]=="wd"?$select="按物业管理费由高到低":"";//物业管理费从高到低
                                $options["order"]=="da"?$select="按得房率由低到高":"";//得房率从低到高
                                $options["order"]=="dd"?$select="按得房率由高到低":"";//得房率从高到低
								$options["order"]=="ju"?$select="按竣工时间由新到旧":"";//按竣工时间由新到旧
                                $options["order"]=="jd"?$select="按竣工时间由旧到新":"";//按竣工时间由旧到新
                            }
                            echo $select;
                            ?></h5>
                        <div class="ul" style="display:none">
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", ""))?>">默认排序</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "wa"))?>">按物业管理费从低到高</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "wd"))?>">按物业管理费由高到低</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "da"))?>">按得房率由低到高</a></p>
                            <p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "dd"))?>">按得房率由高到低</a></p>
							<p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "ju"))?>">按竣工时间由新到旧</a></p>
							<p><a href="<?=Yii::app()->createUrl($url,SearchMenu::dealOptions($options, "order", "jd"))?>">按竣工时间由旧到新</a></p>
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
                    <div class="zjpaixu" style="width:50px;">
                        <?php
 
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
                        ?>     
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
                    $this->renderPartial('_buildview', array('data'=>$data,'type'=>$type));
            }
        }else{
        ?>
        <div class="schcont">
            <div class="zerocontent">
                <div class="sorry_title">抱歉，没有找到符合搜索条件的新盘！</div>
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
                    "cssFile"=>"/css/pager.css"
            ));
            ?>
        </div>
    </div>
    <div class="ggrihgt">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-7790193278112816";
/* aaa */
google_ad_slot = "3876112710";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
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
		
        $(".schdes ").bind("mouseenter", function(){
            $(this).find(".schtan").css("display","block");
        }).bind("mouseleave", "", function(){
            $(this).find(".schtan").css("display","none");
        });
        $(".schtan").bind("mouseenter", function(){
            $(this).find(".cyycont").css("display","block");
        }).bind("mouseleave", "", function(){
            $(this).find(".cyycont").css("display","none");
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
	
        var cookieName = "buildlist";
        var danwei = "元/平米";
        $.pk.pkcheck_Init(cookieName,danwei,"<?=Yii::app()->createUrl("/systembuildinginfo/view",array("id"=>"tmp"));?>","/systembuildinginfo/compare");
		
		
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
