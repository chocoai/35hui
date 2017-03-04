<?
class ZipPeter extends CApplicationComponent
{
	var $_zip_hander = null;
	function __construct(){
		
	}
	function get_List($zip_name){
		$file_list = array();
		$this->_zip_hander = zip_open($zip_name);
		if ( $this->_zip_hander ) {
			while ( $zip_entry = zip_read($this->_zip_hander) ) {
				$file_list[] = array('filename'=>zip_entry_name($zip_entry),
									'size'=>zip_entry_filesize($zip_entry),
									'compressed_size'=>zip_entry_compressedsize($zip_entry)
									);
    		}
   			zip_close($this->_zip_hander);
		}
		return $file_list;
	}
	function Extract($zip_name,$folder_name){
		$this->_zip_hander = zip_open($zip_name);
		if ( !$this->checkDirAndMk($folder_name) ){
			return false;
		}
		if ( substr($folder_name,-1)!="/" ){
			$folder_name .= "/";
		}
		if ( $this->_zip_hander ) {
			while ( $zip_entry = zip_read($this->_zip_hander) ) {
				$file_info = array('filename'=>zip_entry_name($zip_entry),
									'size'=>zip_entry_filesize($zip_entry),
									'compressed_size'=>zip_entry_compressedsize($zip_entry)
									);
				$new_file_name = $folder_name.$file_info['filename'];
				$buf = "";
				if (zip_entry_open($this->_zip_hander, $zip_entry, "r")) {
					$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
					zip_entry_close($zip_entry);
				}
				if ( $fp = fopen($new_file_name,"w") ){
					fwrite($fp,$buf);
					fclose($fp);
				}
    		}
   			zip_close($this->_zip_hander);
   			return true;
		}
		else {
			return false;
		}
	}
	/**
	 * 检查目录是否存在，如果不存在是否建立
	 *
	 * @param string $dirname		完整的实际路径
	 * @param bool $mk				如果不存在是否创建
	 * @param int $mode				创建权限
	 * @return bool					是否创建成功
	 */
	function checkDirAndMk($dirname,$mk=false,$mode=0777){
		if ( is_dir($dirname)==true ){
			return true;
		}
		else {
			if ($mk==false){
				return false;
			}
			else {
				$dirpath_a = explode('/',$dirname);
				for ($i=0;$i<count($dirpath_a);$i++){
					if ( $dirpath_a[$i]=="" ){
						continue;
					}
					if ( $path==""||is_dir($path) ){
						if ( $path=="" ){
							if ( substr(PHP_OS, 0, 3)=="WIN" ){
								$path = $dirpath_a[$i];
							}
							else {
								$path .= "/".$dirpath_a[$i];
							}
						}
						else {
							$path .= "/".$dirpath_a[$i];
						}
						if ( is_dir($path) ){
							continue;
						}
						else {
							@mkdir($path,$mode);
						}
					}
					else {
						return false;
					}
				}
				return true;
			}
		}
	}
}
?>