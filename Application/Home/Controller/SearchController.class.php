<?php
namespace Home\Controller;

use Think\Controller;

class SearchController extends Controller{
	public function index(){
		$this->assign('resultPage',false);
		$this->display('./search');
	}

	public function search(){
		$text = I('post.searchKey');
		echo $text;
		$Example = D('Example');
		$where = array();
		$where['title'] = array('like',"%$text%");
		$where['content'] = array('like',"%$text%");
		$where['_logic'] = 'OR';
		$list = $Example->where($where)->select();
		foreach ($list as $id => $example) {
	    		# code...
	    		$list[$id]['brief'] = substr(strip_tags($list[$id]['content']), 0,25);


	    	}
	    	//dump($Example->_sql());
		$this->assign('list',$list);
		$this->assign('resultPage',true);
		$this->display('./search');		
	}
}