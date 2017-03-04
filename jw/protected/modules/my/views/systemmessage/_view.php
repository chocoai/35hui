<div class="dxline">
    <span class="dx_01"><input type="checkbox" name="id[]" value="<?=$data->sm_id?>"></span>
    <span class="dx_03" style="width:620px">
        <h5><code><?=date("Y-m-d H:i",$data->sm_createtime)?></code><em>系统消息</em></h5>
        <p><?=$data->sm_content?></p>
    </span>
</div>