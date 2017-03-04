<?php
//上传全景文件验证类
class UploadPanoramaFileForm extends CFormModel
{
    public $panoramaFile;
    public function rules()
    {
        return array(
            array('panoramaFile',
            	  'file',
            	  'types'=>'zip',
            	  'maxSize'=>1024*1024*10, //10M max size
           		  'tooLarge'=>'上传文件必须小于10M',
            ),
        );
    }

    /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'panoramaFile'=>'全景文件',
		);
	}
    
}