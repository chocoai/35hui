<?php

class LogoForm extends CFormModel
{
    public $logo;
    public static $types = "";//允许的图片类型
    public function __construct($types="jpg, gif, png"){
        self::$types = $types;
     }
 
    public function rules()
    {
        return array(
            array('logo', 
            	  'file', 
            	  'types'=>self::$types,
            	  'maxSize'=>1024 * 1024, //1M max size
           		  'tooLarge'=>'上传文件必须小于1M',
            ),
    
        );
    }
    
    /**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'logo'=>'图片',
		);
	}
    
	/**
	 * get the real path by decoded url path
	 * @param $savepath
	 * @return realpath $basepath
	 */
	public function findrealpath($savepath)
	{
		$decodepath = urldecode($savepath);
		if($decodepath[0]==='/') //起始位不为‘/’
		{
			$decodepath = substr($decodepath,1);				
		}
		$stokens = explode('/',$decodepath);
		$basepath = dirname(dirname(dirname(__FILE__)));
		foreach($stokens as $tok)
		{
			$basepath.=DIRECTORY_SEPARATOR.$tok;
		}
		return $basepath;
	}
	
}
?>