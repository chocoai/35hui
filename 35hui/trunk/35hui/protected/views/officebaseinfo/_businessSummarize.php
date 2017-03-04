<ul class="serach_moremenu">
    <li class="one"><strong>商务中心概述</strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心详情",array("businessDetail",'opid'=>$officeBaseinfo->ob_officeid),array('name'=>'tab'))?></strong></li>
    <li class="two"><strong><?=CHtml::link("平面图",array("businessIchnography",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("房源照片",array("businessOtherPicture",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
    <li class="two"><strong><?=CHtml::link("商务中心点评",array("businessComments",'opid'=>$officeBaseinfo->ob_officeid))?></strong></li>
</ul>
<div class="serach_morelefttwobox">
    <!--hiddenone start-->
    <div id="brightChild1" class="nohidden">
        <ul class="serach_moreleftulone">
            <li class="one"><a href="#" title="">
                        <?php
                        $url = Picture::model()->getPicByTitleInt($officePresentInfo->op_titlepicurl,"_normal");
                        echo CHtml::image($url,$officeBaseinfo->ob_officename,array('height'=>'266px','width'=>'399px','border'=>'0px'));
                        ?>
                </a></li>
            <li class="two">
                <span style="font-size: 12px;">地址：</span><font  style="font-size:12px"><?=CHtml::encode($officeBaseinfo->ob_officeaddress)?></font><br />
                <span style="font-size: 12px;">租金：</span><font color="red"><?=$officeBaseinfo->rentInfo->or_rentprice;?></font>&nbsp;<font  style="font-size:12px">元/间·月(起)</font><br />
                <span style="font-size: 12px;">所在楼：<?=CHtml::link($officeBaseinfo->ob_officename,array('systembuildinginfo/view','id'=>$officeBaseinfo->ob_sysid),array("style"=>"color:blue"));?></span>
                <p style="margin-top: 0;">021-68880551</p>
            </li>
        </ul>

        <h3><strong>商务中心介绍</strong></h3>
        <div class="serach_moreleftthreebox">
                <?php echo $officePresentInfo->op_officedesc;?>
        </div>
        <h3><strong>商务中心地图</strong></h3>
        <div class="serach_moreleftfourbox">
                <?php
                $this->widget('ShowSmallMap',array('x'=>$sysbuildinfo->sbi_x,
                    'y'=>$sysbuildinfo->sbi_y,
                    'name'=>$officeBaseinfo->ob_officename,
                    'width'=>'672px',
                    'height'=>'233px',
                ));
                ?>
        </div>
    </div>
</div>
       