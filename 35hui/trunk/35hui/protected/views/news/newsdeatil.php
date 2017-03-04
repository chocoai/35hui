<style type="text/css">
    .gz_title { LINE-HEIGHT:27px; MARGIN-TOP:5px; TEXT-INDENT:50px; WIDTH:180px; HEIGHT:27px; COLOR:#333;  MARGIN-LEFT:10px;FONT-SIZE:14px; FONT-WEIGHT:bold; margin-bottom:5px;  }
    .searchTool .btnSearch input { background:url(/images/bg.gif) 0 -1760px no-repeat; display:block; text-decoration:none; height:31px; overflow:hidden; width:65px; cursor:pointer; border:none; }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lou.css" />
<?php
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_keyword,'keywords');
Yii::app()->clientScript->registerMetaTag($seotkd->stkd_dec,'description');
$this->pageTitle = $seotkd->stkd_title;
$this->breadcrumbs = array(
        '资讯'=>array("/news/day"),
        '正文'
);
?>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/news.css" />
<div id="center">

    <Div id="loup">
        <div id="two_left">
            <h1 style="line-height: 25px; margin-bottom: 5px;"><?php echo CHtml::encode($newsdeatil->n_title); ?></h1>
            <span class="news_info"><?php echo date("Y-m-d H:i",$newsdeatil->n_date) ?>　来源: <?php echo $newsdeatil->n_from; ?>　点击 <?php echo $newsdeatil->n_click; ?> 次</span>

            <p class="news_summary">
		[核心提示] <?php echo CHtml::encode($newsdeatil->n_summary); ?>
            </p>
            <div id="news_text">
                <?php echo Keywordlink::model()->regContentByAllKeyword($newsdeatil->n_content); ?>
            </div>
            <div id="news_rel_title"><b>相关新闻</b></div>
            <div id="news_rel_body">
                <ul class="">
                    <?php
                    if(!empty($newslike)) {
                        foreach($newslike as $value) {
                            ?>
                    <li><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$value['n_id']));?>"><?php echo common::strCut(CHtml::encode($value->n_title), 120) ?></a> <span class=""><?php echo date("Y/m/d",$value->n_date); ?></span></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div>
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-7790193278112816";
                /* 图片广告 */
                google_ad_slot = "3250767977";
                google_ad_width = 728;
                google_ad_height = 90;
                //-->
                </script>
                <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
            </div><br/>
            <div id="news_cmt_area">
                <div class="tit">
                    <h3 id="news_cmt_head">最新评论</h3>
                </div>
                <p style="padding-left:15px; padding-bottom:5px;">网友评论仅供其表达个人看法，并不表明新地标同意其观点或证实其描述。</p>
                <div class="reply">
                    <div class="inner">
                        <?php
                        $this->widget('zii.widgets.CListView', array(
                                'dataProvider'=>$Comment,
                                'itemView'=>'_showComment',
                                'summaryText'=>'<font style="margin-left:15px">共有<strong>{count}</strong>条</font>',
                                'summaryCssClass'=>'',
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <div class="news_add_cmt">
                <form action="<?php echo Yii::app()->createUrl("/news/addcommend") ?>" method="post" name="commentform" onSubmit="if(!check_comment(this))return false;">
                    <input type="hidden" name="nid" value="<?php echo $newsdeatil->n_id; ?>" />
                    <div class="sp2">
                        <textarea name="comment" class="new_te3" onblur="hintAction(this,false)" onfocus="hintAction(this,true)">文明上网，登录发贴！字数不能少于2。</textarea></div>
                    <div class="send">
                        <?php
                        if(Yii::app()->user->id==null) {
                            ?>
                        <span>
                            <label>用户名：<input style="width:60px;" type="text" name="username" id="username" /></label>
                            <label>密码：<input style="width:60px;"type="password" name="userpwd" id="userpwd"/></label>
                            <input type="submit" onclick="return login()"  name="sub" value="提交" style="margin-right:15px;"/><a href="<?php echo Yii::app()->createUrl('site/register'); ?>">快速注册新用户</a>
                        </span>
                            <?php
                        }else {
                            ?>
                        <input type="submit"  name="sub" value="发表回复" style="_width:76px; _height: 21px; _background: none; _border: 1px solid #999;"/>
                            <?php
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div><!--two_left end-->

        <div id="two_right">
            <div class="margintop"></div>
            <!--qjss end-->
            <div class="qjss">
                <div class="in_qjss"></div>

                <div class="gz_title" style="_padding-bottom:20px;">资讯搜索</div>
                <div class="c"></div>
                <ul class="ulmargin">
                    <form action="/site/searchmenu" method="post">
                        <li>
                            <div class="searchTool">
                                <input class="txtSearch" name="title" type="text" value="" />
                                <div class="btnSearch"> <input value="" type="submit" /> </div>
                            </div>
                        </li>
                        <li class="ss_wz"><span>示例：  人民广场   中融恒瑞 </span></li>
                        <input type="hidden" name="action" value="/news/newslist" />
                    </form>
                </ul>
                <div class="qjss_bottom" style="_float:left;_padding-bottom:23px;"></div>
                <div class="c"></div>
            </div><!--qjss end-->
            <div class="qjss">
                <div class="in_qjss"></div>

                <div class="gz_title"> 热点资讯</div>
                <div class="c"></div>
                <div class="zs4_list" style="margin-top:0;">
                    <ul >
                        <?php
                        if(!empty($hotnews)) {
                            foreach($hotnews as $value) {
                                ?>
                        <li><span class="nr"><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$value['n_id']));?>" title="<?=$value->n_title?>" ><?php echo common::strCut(CHtml::encode($value->n_title), 42); ?></a></span> <span class="td_R"><?=$value->n_click; ?>次</span></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                </div> <div class="c"></div>
                <div class="qjss_bottom"></div>
                <div class="c"></div>
            </div><!--qjss end-->
            <div class="qjss" style="margin-bottom:-5px;">
                <div class="in_qjss"></div>

                <div class="gz_title"> 最新资讯</div>
                <div class="c"></div>
                <div class="zs4_list" style="margin-top: 0;">
                    <ul >
                        <?php
                        if(!empty($recentnews)) {
                            foreach($recentnews as $value) {
                                ?>
                        <li><span class="nrf"><a href="<?php echo Yii::app()->createUrl("/news/newsbyid",array('nid'=>$value['n_id']));?>" title="<?=$value->n_title?>" ><?php echo common::strCut(CHtml::encode($value->n_title), 48); ?></a></span></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                </div> <div class="c"></div>
                <div class="qjss_bottom"></div>
                <div class="c"></div>
            </div><!--qjss end-->
             <div class="qjss" style="margin-bottom:-5px;">
                <div class="in_qjss"></div>
                <script type="text/javascript"><!--
                google_ad_client = "ca-pub-7790193278112816";
                /* 文字广告 */
                google_ad_slot = "1656658047";
                google_ad_width = 250;
                google_ad_height = 250;
                //-->
                </script>
                <script type="text/javascript"
                src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                </script>
                <div class="qjss_bottom"></div>
                <div class="c"></div>
            </div><!--qjss end-->
        </div>
    </Div>
    <Div class="clear5"></Div>
    <div class="zs"> </div>
</div> <!--center end--> 
<script type="text/javascript">
    /**
     * 先ajax去登陆。
     */
    function login(){
        var username = $("#username").val();
        var userpwd = $("#userpwd").val();
        if(username==""||userpwd==""){
            alert("请填写用户名和密码");
            return false;
        }else{//登陆。
            var state = 0;
            $.ajax({
                url:"<?php echo Yii::app()->createUrl("/site/ajaxlogin") ?>",
                type:"POST",
                async:false,
                data:"username="+username+"&password="+userpwd,
                success:function(msg){
                    if(msg!="login_fail"){
                        state = 1;
                    }
                }
            });
            if(state==0){
                alert("登录失败！");
                return false;
            }
        }
    }
    function hintAction(obj,onFocus){
        if($(obj).val()=='文明上网，登录发贴！字数不能少于2。' && onFocus){
            $(obj).val('');
        }else if($(obj).val()=='' && !onFocus){
            $(obj).val('文明上网，登录发贴！字数不能少于2。');
        }
    }
    function check_comment(obj){
        var comment=$(obj).find('textarea[name="comment"]').val();
        if(comment=='文明上网，登录发贴！字数不能少于2。'){
            alert('您未输入任何内容！');
            return false;
        }
        if(comment.length<=2){
            alert('回复字数不能少于2个，请重新输入！');
            return false;
        }
        return true;
    }

    $(document).ready(function(){$('span[class="empty"]').css('padding-left','15px')});
</script>