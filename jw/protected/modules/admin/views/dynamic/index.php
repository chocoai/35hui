<?php
$this->breadcrumbs=array(
        '清除过期动态',
);?>
<div style="width: 300px">
    <table width="100%">
        <tr>
            <th colspan="2">
                动态有效期：<?=Config::model()->getValueByKey("dynamic_outtime");?>天
            </th>
        </tr>
        <tr>
            <td width="150px">用户本身动态：</td>
            <td><?=$my?>条</td>
        </tr>
        <tr>
            <td>用户好友动态：</td>
            <td><?=$friend?>条</td>
        </tr>
        <tr>
            <th colspan="2">
                未付款充值信息保存时间：<?=Config::model()->getValueByKey("recharge_unpay_outtime");?>天
            </th>
        </tr>
        <tr>
            <td>过期的未付款充值信息：</td>
            <td><?=Accountrecharge::model()->countOutTimeUnPayInfo()?>条</td>
        </tr>
    </table>
    <center>
        <input type="button" value="全部删除" onclick="delAllDynamic()" /><br />
        <img src="/images/loading.gif" id="loadingPic" style="display: none" alt="" />
    </center>
</div>



<script type="text/javascript">
    function delAllDynamic(){
        $("#loadingPic").css("display","block");
        $.post("/admin/dynamic/del", "", function(msg){
            $("#loadingPic").css("display","none");
            jw.pop.alert("清除过期信息成功！",{autoClose:1000});
            setTimeout(function(){
                window.location.reload();
            },1000);
        }, "text");
    }
</script>