<?php
class dealPic {
    public static $picType = array(
        'jpg','JPG',
        'jpeg','JPEG',
        'png','PNG',
        'gif','GIF',
        'bmp','BMP',
    );
    public static function model()
	{
		$dealPic = new dealPic();
        return $dealPic;
	}
    public function getPicturesByDir($folderUrl){
        $picArray = array();
        $dirUrl = $this->dealDirUrl($folderUrl);
        if(is_dir($dirUrl)){
            if ($handle = opendir($dirUrl)) {
                //读取文件夹里的文件
                while (false !== ($file = readdir($handle)))
                {
                    $boolCheck = $this->checkPic($file);
                    if($boolCheck){
                        array_push($picArray,PIC_URL.$folderUrl.DIRECTORY_SEPARATOR.$file);
                    }
                }
                //关闭文件夹
                closedir($handle);
            }
        }
        return $picArray;
    }
    /**
     * 去掉文件夹目录开头的分隔符
     * @param <string> $url 文件夹目录
     * @return <string>
     */
    public function dealDirUrl($url){
        $firstChar = substr($url,0,1);
        if($firstChar==DIRECTORY_SEPARATOR){
            return substr($url,1);
        }else{
            return $url;
        }
    }
    /**
     * 检验图片是否符合标准
     * @param <type> $filename
     * @return <type>
     */
    public function checkPic($filename){
        $suffix = substr(strstr($filename,"."),1);
        if(in_array($suffix,self::$picType)){
            return true;
        }
        return false;
    }
}
?>