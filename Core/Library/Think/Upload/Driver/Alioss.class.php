<?php
namespace Think\Upload\Driver;
/**
 * @name 阿里云储存上传驱动
 * @author 娃娃脾气
 * 
 *
 */
use Aliyun\OSS\OSSClient;
require_once 'Aliyun/aliyun.php';

class Alioss{
	
	
    private $rootPath;
    
    private $config;
    
    private $error = ''; //上传错误信息

    private $aliyun;
    
    /**
     * 构造函数，用于设置上传根路径
     */
    public function __construct($config = array()){
    	$this->config = C('FILE_UPLOAD_CONFIG.' . Alioss);
    	$this -> aliyun = OSSClient::factory(array(
	        'AccessKeyId' => $this->config['access_key_id'],
	        'AccessKeySecret' => $this->config['access_key_secret'],
    		'Endpoint' => 'http://oss-cn-beijing.aliyuncs.com',
    		
	    ));
    }



    /**
     * 保存指定文件
     * @param  array   $file    保存的文件信息
     * @param  boolean $replace 同名文件是否覆盖
     * @return boolean          保存状态，true-成功，false-失败
     */
    public function save($file, $replace=true) {
    	$filename = $this->rootPath . $file['savepath'] . $file['savename'];
    	$fh = fopen($file['tmp_name'], 'rb');
    	$size = filesize($file['tmp_name']);
    	
    	$result = $this -> aliyun -> putObject(array(
    			'Bucket' => $this->config['bucket_name'],
    			'Key' => $filename,
    			'Content' => $fh,
    			'ContentLength' => $size,
    	));
    	
    	fclose($fh);
    	
        return (bool)$result;
    }
    
    public function checkRootPath($rootpath){
    	return true;
    }
    public function checkSavePath($savepath){
    	return true;
    }
    public function mkdir($savepath){
    	return true;
    }
    public function getError(){
    	return '';
    }



}
