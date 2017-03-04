<div class="allgoldgroup">
    <?php
    foreach($allGoldHomeGroup as $value) {
        ?>
    <div class="sfg_tit">
        <input type="checkbox" value="<?=$value->ghg_id?>" name="goldgroup"> <?=$value->ghg_groupname?>
    </div>
        <?php
    }
    ?>
</div>
<div class="sfg_line addnewgoldgroup_btn" >
    <a href="javascript:;"onclick="addnewgoldgroup()">创建分组</a>
</div>
<div class="sfg_line addnewgoldgroup" style="display:none">
    <p><input type="text" class="txt_05" name="newgroupname" maxlength="7" /></p>
    <p style="text-align:center;"><a href="javascript:;" onclick="savenewgoldgroup()">保存</a>&nbsp;&nbsp;<a href="javascript:;" onclick="cancelnewgoldgroup()">取消</a></p>
</div>