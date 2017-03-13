<?php
namespace Home\Controller;
use Think\Controller;

class AdminController extends Controller{
	public function index(){
		if(!isset($_SESSION['userId']) || ($_SESSION['level'] != 0)){
			$this->error('请先登陆',U('/Home/Index'),3);
		}
		$example = D('example');
	    	$page;
	    	if(I('get.page'))
	    	{
	    		$page = I('get.page');
	    	}
	    	$exampleCount = $example->where('state = 0')->count();

	    	$totalPage = intval($exampleCount/9) + ($exampleCount%9 == 0 ? 0 : 1);
	    	$list = $example->page("$page,9")->where('`state` = 0')->relation(true)->select();
	    	$count = count($list);
	    	$nextEnable = ($page<$totalPage);
	    	$listPageCount = $totalPage > 5 ? 5 :$totalPage;
	    	$listBeginPage = $page > 5 ? $page-5 : 1;
	    	$prevEnable = ($page>1);
	    	

	    	foreach ($list as $id => $example) {
	    		# code...
	    		$list[$id]['brief'] = substr(strip_tags($list[$id]['content']), 0,25);
	    		$list[$id]['authorName'] = $list[$id]['author']['nickname'];

	    	}


	    	$this->assign('list',$list);
	    	$this->assign('beginPage',$listBeginPage);
	    	$this->assign('pageCount',$listPageCount);
	    	$this->assign('nextEnable' , $nextEnable);
	    	$this->assign('prevEnable',$prevEnable);	
		$this->display('./admin');
	}

	public function exampleJudge(){
		$Example=D('example');
		$exampleId = I('path.2');
		$where = array('id'=>$exampleId);
		$data = array('state'=>1);
		$Example->where($where)->save($data);
		$this->redirect("/Home/Admin");

	}

	public function exampleJudgePost(){
		
	}
}