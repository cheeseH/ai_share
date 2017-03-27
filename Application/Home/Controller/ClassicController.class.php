<?php
namespace Home\Controller;
use Think\Controller;

class ClassicController extends Controller{
	public function add(){
		$classicName = I('post.name');
		$Classic = D('classic');
		$data = array('name'=>$classicName);
		$Classic->data($data)->add();
	}
	public function delete(){
		$classId = I('post.id');
		$Classic = D('classic');
		$Classic->delete($classId);
	}

	public function listAll(){
		$Classic = D('classic');
		$data = $Classic->select();
		$stringArray = array();
		foreach ($data as $key => $classic) {
			# code...
			array_push($stringArray,$classic['name']);
		}
		$result = array("data"=>$stringArray);
		$this->assign("result",json_encode($result));
		$this->display("./classicAjax");
	}
}