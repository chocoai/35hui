<br />
<br />
<center>页面跳转中，请稍后！</center>
<br />
<?php
echo $return;
?>
<script type="text/javascript" language="javascript">
<?php
if(Yii::app()->user->hasFlash('message')){
    echo "alert('".Yii::app()->user->getFlash('message')."');";
}
?>
</script>