<?php
//$this->temp=$menu;
$this->breadcrumbs=array(
        "我的新地标"=>array('/site/userindex'),
);
?>
<style type="text/css">
    .errorMessage{ color: red;}
    .suggest_link{ background-color: #FFFFFF; padding: 2px 6px 2px 6px;}
    .suggest_link_over{ cursor: pointer; background-color: #A8F2FE;  padding: 2px 6px 2px 6px;}
    #search_suggest{ position: absolute;left: 73px;  _left: 63px;top: 102px;  _top: 107px;width: auto;  background-color: #FFFFFF; text-align: left; border: 1px solid #000000;margin-left: 2px}
    .required_title{ color:red}
    th{ border-top: 1px solid #0d6990;}
    .hidden{ display: none;}
    .show{ display:block;}
</style>
<div style="margin:0 auto;width:742px;">
    <div class="manage_righttitleone">楼盘播报</div>
    <div class="manage_rightboxthree">
        <?php if(Yii::app()->user->hasFlash('showMessage')): ?>
        <div style="width:100%;padding: 10px 0px 10px;background-color: #D8E5EB;color: red;margin-bottom: 10px">
            <font style="margin-left:20px"><?php echo Yii::app()->user->getFlash('showMessage'); ?></font>
        </div>
        <?php endif; ?>
        <form action="/twittersuggest/suggest" method="post" enctype="multipart/form-data" onSubmit="return validateForm(this)">
            <table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo" style="margin-top:20px">
                <tr>
                    <td>
                        楼盘性质：<?php echo CHtml::dropDownList('buidtype',$buid_type,array('1'=>'写字楼','2'=>'小区'),array('onchange'=>'resetFrom()'));?>
                    </td>
                </tr>
                <tr>
                    <td>
                        楼盘名称：<?php echo CHtml::textField('buidname',$name,array('id'=>'id_buidname','autocomplete'=>'off','onkeyup'=>'searchBuildName()'));?>
                        <div id="search_suggest" style="display:none">
                            <span>
                                <font style='color:red'>加载中</font>
                                <img src='<?=IMAGE_URL?>/uploadPicLoad.gif' alt=""/>
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea cols="50" rows="5" name="content"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                            <?php echo CHtml::submitButton('播报',array('name'=>'submit','class'=>"manage_input_button")); ?>
                    </td>
                </tr>
            </table>
            <input type="hidden" id="id_buidid" name="buidid" value="<?=$buid_id ?>" />

        </form>

        <h4>我的播报记录</h4> 
        <a href="<?php echo Yii::app()->createUrl("/twittersuggest/index",array('suggest'=>1))?>" style="color:blue">等待采纳</a> /
        <a href="<?php echo Yii::app()->createUrl("/twittersuggest/index",array('suggest'=>2)); ?>" style="color:blue">已采纳</a>
        <hr />
        <?php if(Yii::app()->user->hasFlash('showMessage2')): ?>
        <div style="width:100%;padding: 10px 0px 10px;background-color: #D8E5EB;color: red;margin-bottom: 10px">
            <font style="margin-left:20px"><?php echo Yii::app()->user->getFlash('showMessage2'); ?></font>
        </div>
        <?php endif; ?>
        <div style="width:100%;border-bottom: 1px dotted #CCCCCC;line-height: 25px">
            <table width="100%">
<?php
                $itemView=isset($_GET['suggest'])&&$_GET['suggest']=='2'?'_list2':'_list';
                $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>$itemView,
                ));
?>
            </table>
        </div>
    </div>
    <div class="manage_righttwoline"></div>
</div>
<script type="text/javascript">
    function validateForm(obj){
        var bid = $("#id_buidid").val();
        var file = $.trim(obj.content.value).length;
        if(bid == 0){
            alert("请指定楼盘。");
            return false;
        }
        if( ! file){
            alert("播报的内容不能为空");
            return false;
        }
        if(file>180){
            alert("播报的内容不能超过180汉字");
            return false;
        }
        return true;
    }
    //查询楼盘名称
    function searchBuildName() {
        $("#search_suggest").css("display", "");
        $("#add_build").css("display","none");
        var inputField = document.getElementById( "id_buidname");
        var suggestText = document.getElementById( "search_suggest");
        $("#id_buidid").val("0");
        if (inputField.value.length > 0) {
            if(typeof(uu) !== "undefined") uu.abort();
            var type = $("#buidtype").val();
            uu = $.ajax({
                url: '<?php echo Yii::app()->createUrl("manage/buiddata");?>',
                data: {"keyw":$.trim(inputField.value),"type":type},
                type: 'GET',
                success: function(msg){
                    msg = eval("("+msg+")");
                    if(msg.length >0){
                        suggestText.style.display= "";
                        suggestText.innerHTML = "";
                        for(var i=0;i <msg.length;i++) {
                            var html=' <div onmouseover="javascript:this.className=\'suggest_link_over\';"'+
                                ' onmouseout= "javascript:this.className=\'suggest_link\';" '+
                                ' onclick= "javascript:setBuid('+msg[i]['id']+',\''+msg[i]['name']+'\');" '+
                                ' class= "suggest_link">' +msg[i]['name']+'&nbsp;&nbsp;'+
                                '</div>';
                            suggestText.innerHTML += html;
                        }
                    }else {
                        $("#search_suggest").css("display", "none");
                        suggestText.innerHTML = '';
                    }
                }
            });
        }
        else {
            suggestText.style.display= "none";
        }
    }
    function resetFrom(){
        $("#id_buidid").val('0');
        $("#id_buidname").val('');
    }
    function setBuid(id,name){
        $("#search_suggest").css("display", "none");
        $("#id_buidname").val(name);
        $("#id_buidid").val(id);
    }
</script>