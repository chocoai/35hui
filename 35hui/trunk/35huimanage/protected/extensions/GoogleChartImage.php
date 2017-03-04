<?php
/**
 * GoogleChartImage class file.
 *
 * @author skding
 * @version 1.0
 * @link http://www.360dibiao.com/
 * @copyright Copyright &copy; 2011 360dibiao.com
 *
 * Copyright (C) 2011 360dibiao.com.
 *
 * 	This program is free software: you can redistribute it and/or modify
 * 	it under the terms of the GNU Lesser General Public License as published by
 * 	the Free Software Foundation, either version 2.1 of the License, or
 * 	(at your option) any later version.
 *
 * 	This program is distributed in the hope that it will be useful,
 * 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 * 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * 	GNU Lesser General Public License for more details.
 *
 * 	You should have received a copy of the GNU Lesser General Public License
 * 	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * For third party licenses and copyrights, please see phpmailer/LICENSE
 *
 */

class GoogleChartImage{
    public $isHTTPS=true;
    public $apiUrl;
    public $protocol;
    public $cachingDuration=0;
    public $cachingPath='/chartcaching';

    private $_data=array();
    private $_chart=array();

    public function  __construct($config=null) {
        if(gettype($config)==='array'){
            foreach($config as $key=>$value){
                $this->$key=$value;
            }
        }
        $this->protocol=$this->isHTTPS?'https://':'http://';
        $this->apiUrl=$this->protocol.($this->isHTTPS?'chart.googleapis.com/chart?':'chart.apis.google.com/chart?');
    }
    public function setData(array $data){
        $this->_data=$data;
        return $this;
    }
    public function getData(){
        return $this->_data;
    }
    public function addData($key,$value){
        $this->_data[$key]=$value;
        return $this;
    }
    public function delData($key){
        unset($this->_data[$key]);
        return $this;
    }
    private function createParams(){
        $params=array();
        ksort($this->_data);
        foreach ($this->_data as $key => $value) {
            $params[]=$key.'='.$value;
        }
        return implode('&', $params);
    }
    public function getChart(){//serialize
        $params=$this->createParams();
        $md5params=md5($params);
        if(!isset($this->_chart[$md5params])){
            $this->_chart[$md5params]=$this->apiUrl.$params;
        }
        if($this->cachingDuration){
            $basePath=$_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.ltrim($this->cachingPath,'\/');
            !is_dir($basePath) && mkdir($basePath);
            $file=$basePath.DIRECTORY_SEPARATOR.$md5params.'.png';
            $returnFile=DIRECTORY_SEPARATOR.ltrim($this->cachingPath,'\/').DIRECTORY_SEPARATOR.$md5params.'.png';
            if(file_exists($file) && filemtime($file)+$this->cachingDuration < time() ){
                return $returnFile;
            }else{
                if( ($picData=file_get_contents( $this->_chart[$md5params] )) ){
                    //@unlink($file);
                    file_put_contents($file, $picData);
                }
                return $returnFile;
            }
        }
        return $this->_chart[$md5params];
    }
/*****************************/
    public function __get($name)
	{
		$getter='get'.$name;
		if(method_exists($this,$getter))
			return $this->$getter();
		throw new Exception('Property "'.get_class($this).'.'.$name.'" is not defined.');
	}
    public function __set($name,$value)
	{
		$setter='set'.$name;
		if(method_exists($this,$setter))
			return $this->$setter($value);
		throw new Exception('Property "'.get_class($this).'.'.$name.'" is not defined.');
	}
}
