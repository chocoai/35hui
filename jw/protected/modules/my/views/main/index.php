<div class="mright">
    <div class="mess">
        <div class="header">
            <a href="/my/info/photo"><img src="<?=User::model()->getUserHeadPhoto($model,"_130x140")?>" width="130px" /></a>
        </div>
        <div class="me">
            <p>
                <strong class="ft_18"><?=$model->u_nickname?></strong> <b class="active ft_18"><?=Memberlevel::model()->getUserLevelName($model->u_id)?></b>
                身高： <?=$memberModel->mem_height?$memberModel->mem_height."CM":""?>
                <em>|</em> 体重：<?=$memberModel->mem_weight?$memberModel->mem_weight."KG":""?>
                <em>|</em> 三围：<?php
                if($memberModel->mem_threesize) {
                    $threesize = explode(",",$memberModel->mem_threesize);
                    echo $threesize[0]."-".$threesize[1]."-".$threesize[2];
                }
                ?>
            </p>
            <p>
                籍贯： <?=Region::model()->getNameById($model->u_district)?>
                <em>|</em> 目前所在：  <?=Region::model()->getNameById($model->u_section)?>
                <em>|</em> 公司：<?=Member::model()->getMemberCompany($memberModel)?>
            </p>
            <div style="width:550px;overflow: hidden">
                <?php
                $allLevel = Memberlevel::model()->getAllLevle();
                if($allLevel&&count($allLevel)>1) {
                    $this->renderPartial("_boardlevel",array("allLevel"=>$allLevel));
                }
                ?>
                <!--<img src="/images/jdt.jpg" />-->
            </div>
        </div>
    </div>
    <form method="post" id="userspeakform">
        <div class="metit"><img src="/images/xxs.jpg" /></div>
        <div class="metit"><textarea class="taxt" name="speak"></textarea></div>
        <div class="metit" id="userspeakform_msg" style="display: none;background-color: #FFFAE2;border: 1px solid #F5E190;height: 18px;font-size: 12px;padding-top: 2px;">
            <img src="/images/cuo.jpg" />
            <span></span>
        </div>
        <div class="mebtn"><input type="button" value="提 交" class="btn_01" onclick="submitUserSpeakCheck()" /></div>
    </form>
    <div class="metnav">
        <ul>
            <li>好友动态</li>
        </ul>
    </div>
    <div class="jbmain" >
        <div id="dynamic_user_content"></div>
        <div id="dynamic_user_loading" style="clear: both;width: 100%;text-align: center;display: none"><img src="/images/loading.gif" width="25px"/></div>
    </div>
</div>

<script type="text/javascript">
    var def_speak_message = "说说新鲜事吧！";
    var canGet = true;
    $(document).ready(function(){
        $("#userspeakform textarea[name='speak']").val(def_speak_message);
        $("#userspeakform textarea").focus(function(){
            var content =  $.trim($("#userspeakform textarea[name='speak']").val());
            if(content==def_speak_message){
                $("#userspeakform textarea[name='speak']").val("");
            }
        }).blur(function(){
            var content =  $.trim($("#userspeakform textarea[name='speak']").val());
            if(content==""){
                $("#userspeakform textarea[name='speak']").val(def_speak_message);
            }
        });
        //查找动态
        getContent();
        var range = 50;             //距下边界长度/单位px
        $(window).scroll(function(){
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)
            var dbHiht = $("body").height();          //页面(约等于窗体)高度/单位px
            var mainHiht = $("#dynamic_user_content").height();               //主体元素高度/单位px
            if((srollPos + dbHiht) >= (mainHiht-range)&&canGet){
                getContent();
            }
        });
    });
    function submitUserSpeakCheck(){
        var content =  $.trim($("#userspeakform textarea[name='speak']").val());
        if(content==def_speak_message||content==""){
            showUserSpeakCheckMessage("先随便说两句吧......");
            return false;
        }
        var num = txtNum_func(content);
        if(num>300){
            showUserSpeakCheckMessage("输入了"+num+"个字，大于300，请删减了再提交！");
            return false;
        }
        submitUserSpeak()
    }
    function showUserSpeakCheckMessage(msg){
        $("#userspeakform_msg").css("display","block");
        $("#userspeakform_msg span").html(msg);
    }
    function submitUserSpeak(){
        $.post("<?=Yii::app()->createUrl("/my/userspeak/create");?>", $("#userspeakform").serialize(), function(msg){
            var info = "";
            if(msg=="success"){
                info = "发布成功！";
            }else{
                info = "发布失败！";
            }
            jw.pop.alert(info,{
                icon: 1,
                autoClose:1000
            });
            setTimeout(function(){window.location.reload()},1500);
        }, "html");
    }
    function getContent(){
        canGet = false;
        var currentnum = $("#dynamic_user_content").children().length;
        $("#dynamic_my_loading").css("display","block");
        $.post("/my/dynamicuser/getinfo",{"currentnum":currentnum},function(msg){
            if(msg!="zero"){
                $("#dynamic_user_content").append(msg);
                canGet = true;
            }else{
                $("#dynamic_user_content").append("<div style='width:100%;margin-top:10px'><center>已经没有更多的动态了！</center></div>");
                canGet = false;
            }
            $("#dynamic_user_loading").css("display","none");

        },"html");
    }
</script>
<?php Yii::app()->clientScript->registerScriptFile('/js/punlun.js',CClientScript::POS_END );?>