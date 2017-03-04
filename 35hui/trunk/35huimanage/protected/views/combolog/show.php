<?php
$this->breadcrumbs=array(
    '会员管理'=>array('user/index/'),
	'套餐管理',
);

$this->menu=array(
    array('label'=>'管理套餐信息', 'url'=>array('admin')),
    array('label'=>'所有用户套餐', 'url'=>array('showall')),
    array('label'=>'使用中的套餐', 'url'=>array('showused')),
    array('label'=>'过期的的套餐', 'url'=>array('showoverdue')),
);

    if(isset($_GET['order'])&&$_GET['order']=="desc") {
            $options_tmp = '↓';
            $class = "";
     }else if(isset ($_GET['order'])&&$_GET['order']=="") {
            $options_tmp = '↑';
            $class = "desc";
     }else {
            $options_tmp = "↑";
            $class = "desc";
     }
?>
<script type="text/javascript">
   $(document).ready(function(){
      $("#cbl_content").attr("style","width:200px");
      $("#grade").attr("style","width:70px");
       $("#mangeuser").attr("style","width:110px");
       $("#grade").change(function(){
          over();
      })
      $("#mangeuser").change(function(){
          over();
      })
      $("#cbl_content").change(function(){
          over();
      })
   })
function over(){
    var uid=document.getElementById("cbl_uid").value;
    var username=document.getElementById("username").value;
    var content=document.getElementById("cbl_content").value;
    var muid=document.getElementById("mangeuser").value;
    var grade=document.getElementById("grade").value;
    var html="<?=Yii::app()->createUrl($url,array())?>"
    if(uid){
        html+="/cbl_uid/"+uid;
    }
    if(username){
        html+="/user_name/"+username;
    }
    if(content){
        html+="/cbl_content/"+content;
    }
    if(muid){
        html+="/cbl_muid/"+muid;
    }
    if(grade){
        html+="/grade/"+grade;
    };
    window.location.href=html;
}</script>
<b class="problock">&nbsp;&nbsp;&nbsp;ID</b><b class="problock">&nbsp;&nbsp;&nbsp;用户</b><b class="problock" style="width:200px">&nbsp;&nbsp;&nbsp;套餐</b><b class="problock">&nbsp;&nbsp;&nbsp;专属客服</b> <b class="problock">&nbsp;&nbsp;&nbsp;级别</b><div style="clear:both"></div>
<div >
   
<input type="text" size="13" id="cbl_uid" value="<?=isset($_GET['cbl_uid'])?$_GET['cbl_uid']:''?>" onchange="over()">
<input type="text" size="13" id="username" value="<?=isset($_GET['user_name'])?$_GET['user_name']:''?>" onchange="over()">
<!--<input type="text" size="25" id="cbl_content"value="<?//=isset($_GET['cbl_content'])?$_GET['cbl_content']:''?>"  onchange="over()">-->
<?=CHtml::dropDownList("cbl_content",isset($_GET['cbl_content'])?$_GET['cbl_content']:'',$combo,array("empty"=>""))?>
<?=CHtml::dropDownList("mangeuser",isset($_GET['cbl_muid'])?$_GET['cbl_muid']:'',$mangeuser,array("empty"=>""))?>
<?=CHtml::dropDownList("grade",isset($_GET['grade'])?$_GET['grade']:'',User::$titleArr,array("empty"=>""))?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
     echo CHtml::link("排序".$options_tmp,Yii::app()->createUrl($url,array("order"=>$class)));
?>
</div>
<div style="width:100%">
<?php
    $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>"_show",
));
    ?>
</div>

