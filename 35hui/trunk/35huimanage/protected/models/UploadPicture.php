<?php

class UploadPicture extends CFormModel
{
    public $pic;

    public function rules()
    {
        return array(
            array('pic', 
            	  'file', 
            	  'types'=>'jpg', 
            	  'maxSize'=>1024 * 1024 * 2, //2M max size
           		  'tooLarge'=>'上传文件必须小于2M',
            ),
    
        );
    }
    
    /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'pic'=>'上传图片',
		);
	}
	
}
?>