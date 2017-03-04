<li style="width:750px;height:100px;">
    <table width="100%" style="float:left;background-color: white;height: 100px;">
        <tr>
            <td style="width:100px;"><?php
            $url = Picture::model()->getPicByTitleInt($data->sbi_titlepic,"_small");
            echo CHtml::image($url,'',array("style"=>"width:114px;height:76px;"));
            ?></td>
            <td style="width:380px;">
                <div class="details" style="height:90px;">
                    <?php echo CHtml::link(CHtml::encode($data->sbi_buildingname), array('buildingView', 'id'=>$data->sbi_buildingid)); ?><br/>
                    地址:<?=$data->sbi_address?><br>
                    开盘日期:<?=date('Y年m月d日',$data->sbi_openingtime)?>
                    <p></p>
                </div>
            </td>
            <td style="width:170px;"><h3 style="color:orange"><?=$data->sbi_avgrentprice?>元/月</h3></td>
            <td style="width:100px;"><h3 style="color:orange"><?=$data->sbi_avgsellprice/10000?>万元/平米</h3></td>
        </tr>
    </table>
</li>