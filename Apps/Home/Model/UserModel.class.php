<?php
namespace Home\Model;
use Think\Model\MongoModel;
class UserModel extends MongoModel {
	var $tableName = 'youdaos';
	
	/**
	 * 查询用户列表
	 * @author Iversong
	 * @param
	 * @return array
	 */
    public function getAllUsers(){
        return $this->field('name')->order('_id desc')->select();
    }
}