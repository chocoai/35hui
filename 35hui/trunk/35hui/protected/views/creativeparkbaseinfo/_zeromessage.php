<div class="schcont">
    <div class="zerocontent">
        <?php
        if(isset($options["keyword"])){//如果有关键词搜索.要查看是否存在这个创意园区。
            $model = Creativeparkbaseinfo::model()->findByAttributes(array("cp_name"=>urldecode($options["keyword"])));
            if($model){//表明有创意园区，却没发布过房源
                ?>
        <div class="sorry_title">抱歉，您查找的创意园区暂时没有房源！点击浏览创意园区概况！</div>
        <ul class="noresult">
            <li style="line-height:auto">
                <div>
                    <a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$model->cp_id))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($model->cp_titlepic,"_large");?>" width="170px" height="130px"/></a><br />
                    <a href="<?=Yii::app()->createUrl("creativeparkbaseinfo/view",array("id"=>$model->cp_id))?>" target="_blank"><?=$model->cp_name?></a>
                </div>
            </li>
        </ul>
                <?php
            }else{//没有创意园区。要去看看楼盘表
                ?>
        <div class="sorry_title">抱歉，没有找到符合搜索条件的创意园区!</div>
        <ul class="noresult">
            <li style="font-weight: bold;">您是不是要找</li>
                    <?php
                    $model = Systembuildinginfo::model()->findByAttributes(array("sbi_buildingname"=>urldecode($options["keyword"])));
                    if($model){
                        ?>
            <li style="line-height:auto">
                <div>
                    <a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$model->sbi_buildingid))?>" target="_blank"><img src="<?=Picture::model()->getPicByTitleInt($model->sbi_titlepic,"_large");?>" width="170px" height="130px"/></a><br />
                    <a href="<?=Yii::app()->createUrl("systembuildinginfo/view",array("id"=>$model->sbi_buildingid))?>" target="_blank"><?=$model->sbi_buildingname?></a>
                </div>
            </li>
                        <?php
                    }
                    ?>

        </ul>
                <?php
            }
        }else{
            ?>
        <div class="sorry_title">抱歉，没有找到符合搜索条件的创意园区!</div>
        <ul class="noresult">
            <li style="font-weight: bold;">您可以</li>
            
            <li>·重新修改搜索条件后再进行搜索</li>
            <li>·适当减少一些搜索条件，以便能够获得更多的结果</li>
        </ul>
            <?php
        }
        ?>

    </div>
</div>