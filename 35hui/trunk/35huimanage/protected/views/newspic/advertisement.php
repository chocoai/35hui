<?php
$this->breadcrumbs=array(
    '广告图片'=>array('advertisement'),
);
$this->currentMenu = 29;
?>

<h1>图片新闻</h1>
<div class="items">
    <div class="view">
        <table>
            <tr>
                <td width="70%">
                    <b>上海写字楼政策</b>
                <td>
                    <img width="126px" height="90px" src="<?php $row = Newspic::model()->getOnePicByType(Newspic::newszc);if(!empty($row))echo PIC_URL.$row->np_picurl; ?>" />
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl("/newspic/updateadvertisement",array("type"=>Newspic::newszc)) ?>">更改</a>
                </td>
            </tr>
        </table>
    </div>
    <div class="view">
        <table>
            <tr>
                <td width="70%">
                    <b>上海写字楼成交数据</b>
                <td>
                    <img width="126px" height="90px" src="<?php $row = Newspic::model()->getOnePicByType(Newspic::newscj);if(!empty($row))echo PIC_URL.$row->np_picurl; ?>" />
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl("/newspic/updateadvertisement",array("type"=>Newspic::newscj)) ?>">更改</a>
                </td>
            </tr>
        </table>
    </div>
    <div class="view">
        <table>
            <tr>
                <td width="70%">
                    <b>上海写字楼调查报告</b>
                <td>
                    <img width="126px" height="90px" src="<?php $row = Newspic::model()->getOnePicByType(Newspic::newsdc);if(!empty($row))echo PIC_URL.$row->np_picurl; ?>" />
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl("/newspic/updateadvertisement",array("type"=>Newspic::newsdc)) ?>">更改</a>
                </td>
            </tr>
        </table>
    </div>
    <div class="view">
        <table>
            <tr>
                <td width="70%">
                    <b>上海写字楼研究报告</b>
                <td>
                    <img width="126px" height="90px" src="<?php $row = Newspic::model()->getOnePicByType(Newspic::newsyj);if(!empty($row))echo PIC_URL.$row->np_picurl; ?>" />
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl("/newspic/updateadvertisement",array("type"=>Newspic::newsyj)) ?>">更改</a>
                </td>
            </tr>
        </table>
    </div>
</div>