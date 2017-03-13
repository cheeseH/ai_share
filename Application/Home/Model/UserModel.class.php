<?php

namespace Home\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel{
	protected $tableName = 'user';
	protected $_link = array(
		'group' => array(
			'mapping_type'=>self::BELONGS_TO,
			'class_name'=>'Group',
			'foreign_key'=>'group_id',
		),
	);
}