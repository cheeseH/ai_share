<?php

namespace Home\Model;
use Think\Model\RelationModel;

class ExampleModel extends RelationModel{
	protected $tableName = 'example';
	protected $_link = array(
		'author'=>array(
			'mapping_type' => self::BELONGS_TO,
			'class_name'     =>'User',
			'foreign_key'     =>'author_id',
		),

	);
}