<div class="thlinee">
    <div class="thinpunt"><div class="thinpuntt"><?php $sourceType = isset($show['sourceType'])?$show['sourceType']:1; ?>
        <select name="sourceType" id="sourceType" onchange="changeSource(this)">
            <option value="1"<?php echo $sourceType ==1 ? ' selected' : '';?>>写字楼</option>
            <option value="2"<?php echo $sourceType ==2 ? ' selected' : '';?>>商　铺</option>
            <option value="3"<?php echo $sourceType ==3 ? ' selected' : '';?>>住　宅</option>
            <?php
            if($sr!="sell"){//创意园区只有出租
            ?>
            <option value="4"<?php echo $sourceType ==4 ? ' selected' : '';?>>创意园区</option>
            <?php
            }
            ?>
        </select>
        <select name="officeState" onchange="search()"><?php $officeState = isset($show['officeState'])?$show['officeState']:1000; ?>
            <option value="0">显示所有</option>
            <option value="1"<?php echo $officeState ==1 ? ' selected' : '';?>>显示全景房源</option>
        </select>
<?php
echo CHtml::dropDownList('od',isset($show['od'])?$show['od']:'',
        array('排序方式','更新时间升序','更新时间降序','发布时间升序','发布时间降序'),
        array('onchange'=>'search()'));

    if(isset($buildTypeInfo)){
        $showName = '楼盘';
        if($sourceType==3){
             $showName = '小区';
        }
        if($sourceType==1||$sourceType==3){
            $buildTypeId = isset($show['buildTypeId'])?$show['buildTypeId']:'';
?>
</div>
    <div class="thinpuntt">按<?=$showName;?>查询：
    <select name="buildTypeId" id="buildTypeId" onchange="changeBuildType(this)">
        <option value=""<?php echo $buildTypeId =='' ? ' selected' : '';?>>全部</option>
        <?php
            if($sourceType==1){
                foreach ($buildTypeInfo as $item) {
            ?>
        <option value="<?php echo $item['sbi_buildingid']; ?>"<?php echo $buildTypeId ==$item['sbi_buildingid'] ? ' selected' : '';?>><?php echo $item['sbi_buildingname'];?></option>
        <?php
                }
            }else{
                 foreach ($buildTypeInfo as $item) {
        ?>
        <option value="<?php echo $item['comy_id']; ?>"<?php echo $buildTypeId ==$item['comy_id'] ? ' selected' : '';?>><?php echo $item['comy_name'];?></option>
        <?php
            }
            }
        ?>
    </select>
<?php }
} ?>
    </div>
        </div>
    <div class="thpage" style="text-align: right;">
        关键字：<input type="text" name="kwd" value="<?php if(isset($show['kwd']))echo $show['kwd'];?>"/>
        <input type="submit" value="搜索" class="btn_01"/>
    </div>
</div>


