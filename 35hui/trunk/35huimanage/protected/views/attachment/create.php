<?php
$this->breadcrumbs=array(
	'Attachments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attachment', 'url'=>array('index')),
	array('label'=>'Manage Attachment', 'url'=>array('admin')),
);
?>

<h1>Create Attachment</h1>

<div class="form">
    <form action="" method="post" enctype="multipart/form-data" onSubmit="return validateForm(this)">
            <table width="100%" border="0" cellpadding="5" cellspacing="5" class="manage_tabletwo" style="margin-top:20px">
                <tr>
                    <td>
                        楼盘性质:<b><?php echo $buidtype == 1?'写字楼':'小区';?></b> 附件类型:<b><?php echo $atttype == 1?'楼书':'合同';?></b>
                    </td>
                </tr>
                <tr>
                    <td>
                         下载需要的商务币:<?php echo CHtml::textField('downloadmoney','',array('size'=>4,'maxlength'=>3));?>
                    </td>
                </tr>
                <tr>
                    <td>
                         楼盘名称：<?php echo CHtml::textField('buidname',$name,array('readonly'=>true,'id'=>'id_buidname'));?>
                         <div id="search_suggest" style="display:none">
                             <span>
                                 <font style='color:red'>加载中</font>
                                 <img src='<?=IMAGE_URL?>/uploadPicLoad.gif' alt=""/>
                             </span>
                         </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="attachment" />
                    </td>
                </tr>
            </table>
            <input type="hidden" id="id_buidid" name="buidid" value="<?php echo $buidid ?>"  />
            <input type="hidden" id="buidtype" name="buidtype" value="<?php echo $buidtype ?>"  />
            <input type="hidden" id="atttype" name="atttype" value="<?php echo $atttype ?>"  />
            <div style="float:right;margin-right: 55px ">
                <?php echo CHtml::submitButton('上传附件',array('name'=>'submit')); ?>
            </div>
        </form>
</div>