<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style_map.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/map.css" />
       

        <?php
        Yii::app()->clientScript->registerCoreScript('jquery');
        ?>
    </head>
    <body>
        <div id="wrap">
            <div id="header" style="overflow: visible;width:1300px;">
                <h1>
                    <a href="<?=DOMAIN;?>">
                        <img src="/images/maplogo.gif" style="margin-top:10px; margin-left:10px;" />
                    </a>
                </h1>
                <div class="city">
                    <strong class="orange"></strong>
                </div>
                <div class="search">
                    <li class="nav">
                    <?php
                    $this->widget('application.components.Map_MainMenu',array(
                        'items'=>array(
                            array('label'=>'楼盘地图', 'url'=>array('/map/map')),
                            array('label'=>'二手房地图', 'url'=>array('/map/sendHand')),
                            array('label'=>'租房地图', 'url'=>array('/map/rent'))
                        ),
                    )); ?>
                    </li>
                    <form action="#" method="post" id="searchform" onSubmit="return searchBykeyword()" style="margin:0px;padding: 0px">
                        <li>
                            <input value="请输入地域名或楼盘全称" class="input" id="exact" name="exact" style="color: Gray; font-size: 12px;" type="text" />
                            <input onmouseout="this.className='btn_out'" onmouseover="this.className='btn_over'" class="btn_out" value="" onclick="searchBykeyword()" type="button" />
                        </li>
                        <li class="quick" style="z-index:999">
                            <div class="floatl">快速定位:</div>
                            <div id="district" class="town" onmouseover="listshow(this);" onmouseout="listhidden(this);">
                                <span id="districtTitle">选择区域</span>
                                <dl style="position: absolute; left:72px;" class="hidden">
                                    <?php
                                    $regin = Region::model()->getArea();
                                    foreach($regin as $value){
                                    ?>
                                    <dd>
                                        <div style="width: 100%;">
                                            <span onClick="changeArea(this)" attr="<?=$value->re_id?>"><?=$value->re_name?></span>
                                        </div>
                                    </dd>
                                    <?php
                                    }
                                    ?>
                                </dl>
                            </div>
                            <div id="track" class="subwaysh" onmouseover="listshow(this);" onmouseout="listhidden(this);">
                                <span id="trackTitle">选择地铁</span>
                                <dl style=" left: 207px; position: absolute;" class="hidden">
                                    <?php
                                    $metros = Searchcondition::model()->getAllMetros("1");
                                    foreach($metros as $key=>$value){
                                    ?>
                                    <dd>
                                        <div style="width: 100%;">
                                            <span onClick="changeLine(this)" attr="<?=$key?>"><?=$value?></span>
                                        </div>
                                    </dd>
                                    <?php
                                    }
                                    ?>
                                </dl>
                            </div>
                            <div class="filter">
                                <?php
                                $actionID = strtolower($this->getAction()->getId());
                                if($actionID=="map"){
                                    $this->renderPartial('_mapFormSearch');
                                }elseif($actionID=="sendhand"){
                                    $this->renderPartial('_secondFormSearch');
                                }elseif($actionID=="rent"){
                                    $this->renderPartial('_rentFormSearch');
                                }
                                ?>
                            </div>
                        </li>
                    </form>
                </div>
                
            </div>
            <div id="bheaderbg" ></div>
            <?php echo $content; ?>
        </div>
        <script type="text/javascript">
            $(function(){
                autoFrame();//自动根据浏览器大小构建折叠窗口
                $("#exact").click(function(){
                    changeSearchKeyValue('over');
                }).mouseout(function(){
                    changeSearchKeyValue('out');
                })
            });
            $(window).resize(function(){
                autoFrame();
            });
//            //构建框架结构
            function autoFrame(){
                
                var width = document.body.clientWidth;//获取窗口宽度
                
                var height = pageHeight();//获取窗口高度
                var rightWidth = 0;
                var headHeight = 100;//页头高度
               
                $("#container").css('width',(width-rightWidth)+"px").css('height',(height-headHeight)+"px");//地图高度
                //$("#frame").css('height',(height-headHeight)+"px");//代码ifame高度
            }
            function pageHeight(){//返回页面高度
                if($.browser.msie){
                    return document.compatMode == "CSS1Compat"? document.documentElement.clientHeight : document.body.clientHeight;
                }else{
                    return self.innerHeight;
                }
            };
            function listshow(obj){
                $(obj).children("dl").removeClass("hidden").addClass("show");
            }
            function listhidden(obj){
                $(obj).children("dl").removeClass("show").addClass("hidden");
            }
            /**
             * 改变区域
             */
            function changeArea(obj){
                $("#track").children("span").html("选择地铁");//区域和地铁只能选择一个
                $("#district").children("span").html($(obj).html());
                listhidden($("#district"));
                //alert($(obj).attr("attr"));
                searchByDistrict($(obj).attr("attr"));
            }
            /**
             * 改变地铁
             */
            function changeLine(obj){
                $("#district").children("span").html("选择区域");//区域和地铁只能选择一个
                $("#track").children("span").html($(obj).html());
                listhidden($("#track"));
                searchByMetroLine($(obj).attr("attr"));
            }
        </script>
        <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F306fe6e44f34941fd008214b147aa51d' type='text/javascript'%3E%3C/script%3E"));
</script>
    </body>
</html>