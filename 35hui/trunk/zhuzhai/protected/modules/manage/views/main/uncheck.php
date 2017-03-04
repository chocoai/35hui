<?php $this->breadcrumbs=array("管理首页");?>
<div class="msg">
    <?php
    if($type==2){//审核未通过
        echo "<p style='color:red'>您的账户审核未通过，不能进行任何操作！感谢您的支持！</p>";
    }else{//还未审核
        echo "<p>您的账户还未通过审核，暂时不能进行任何操作！请等待审核！感谢您的支持！</p>";
    }
    ?>
    <p>如有任何疑问，请联系新地标客服！客服热线：021-68880132</p>
</div>