<?php

namespace Admin\Model;
use Think\Model;

class UserModel extends Model {
	protected $tableName = 'permission';

	protected $_map = array(
		'pername' => 'per_name',
		'peract' => 'per_act'
		); 
}