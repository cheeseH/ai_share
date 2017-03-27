<?php
namespace Home\Controller;
use Think\Controller;

class ExampleController extends Controller{
	private function unique_number()
	{
		return $_SESSION['user_id'].":".date('Y-m-d h:i:s') . substr(implode(NULL, array_map('ord', str_split(strrev(substr(uniqid(), 7, 13)), 1))), 0, 8);
	}
	private function check_login(){
		if(!isset($_SESSION['userId'])){
			$this->error('请先登陆',U('/Home/Index'),3);
			die();
		}
		
	}
	private function deleteAttachment($temp_id){
		// $Attachment = D('attachment');
		// $Attachment->deleteFile($temp_id);
	}
	public function post(){
		$this->check_login();
		if(isset($_SESSION['temp_post_id'])){
			$Example = D('example');
			$where = array(
				'temp_id' => $_SESSION['temp_post_id']
			);
			$data = $Example->where($where)->find();
			if(!$data){
				$this->deleteAttachment($_SESSION['temp_post_id']);
			}
		}
		$_SESSION['temp_post_id'] = $this->unique_number();
		$this->display('./post');
	}
	public function postStatic(){
		$this->display('./post');
	}
	public function examplePost(){
		 $this->check_login();
		 $title = I('post.title');
		 $content = $_POST['content'];
		 $code = I('post.j_verify');
		 $author = $_POST['zuozhe'];
		 $authorData = json_decode($author,true);
		 $authorDB = array();
		 foreach ($authorData as $key => $auth) {
		 	# code...
		 	$imgData = $auth['touxiang'];
		 	$Img = D('author_img');
		 	$data = array('data'=>$imgData);
		 	$result = $Img->data($data)->add();
		 	$auth['touxiang'] = $result;
		 	array_push($authorDB,$auth);
		 }
		 $author = json_encode($authorDB);
		
		 $classic = trim(I('post.checkbox'),'[]');
		 $tag = trim(I('post.tags'),'[]');
		$pc = new PublicController();
		if(!$pc->check_verify($code)){
			$ar = array('status'=>'验证码错误');
			$this->assign('result',json_encode($ar));
			$this->display('./classicAjax');
			die();
		}

		//分类处理
		$Classic = D('classic');
		$classicNameArray = explode(",",$classic);
		$classicIdArray = array();
		foreach ($classicNameArray as $key => $classicName) {
			# code...
			$where = array('name'=>$classicName);
			$data = $Classic->field('id')->where($where)->find();
			array_push($classicIdArray,$data['id']);
		}
		$classicIds = implode(",",$classicIdArray);
		
		$Example = D('example');
		$data = array(
			'title' => $title,
			'content' => $content,
			'author_id' => $_SESSION['userId'],
			'authors' => $author,
			'tag' => $tag,
			'classic' => $classicIds
		);
		$result = $Example->data($data)->add();
		if(!$result){
			die();
		}
		$Attachment = D('attachment');
		$update = array(
			'finished' => 1,
			'example_id' =>$result
		);	
		$Attachment->where("`temp_id` = '$_SESSION[temp_post_id]'")->save($update);
		$ajaxResult = array('status'=>'ok','url'=>U("Home/Example/exampleDetail/$result"));
		$this->assign('result',json_encode($ajaxResult));
		$this->display('./classicAjax');
	}

	public function myExample(){
		$this->check_login();
		$Example = D('example');
	    	$page;
	    	if(I('get.page'))
	    	{
	    		$page = I('get.page');
	    	}
	    	$exampleCount = $Example->where("`author_id` = $_SESSION[userId]")->count();

	    	$totalPage = intval($exampleCount/9) + ($exampleCount%9 == 0 ? 0 : 1);
	    	$list = $Example->page("$page,9")->where("`author_id` = $_SESSION[userId]")->select();
	    	$count = count($list);
	    	$nextEnable = ($page<$totalPage);
	    	$listPageCount = $totalPage > 5 ? 5 :$totalPage;
	    	$listBeginPage = $page > 5 ? $page-5 : 1;
	    	$prevEnable = ($page>1);

	    	foreach ($list as $id => $example) {
	    		# code...
	    		$list[$id]['brief'] = substr(strip_tags($list[$id]['content']), 0,25);


	    	}

	    	$this->assign('list',$list);
	    	$this->assign('beginPage',$listBeginPage);
	    	$this->assign('pageCount',$listPageCount);
	    	$this->assign('nextEnable' , $nextEnable);
	    	$this->assign('prevEnable',$prevEnable);
	    	$this->display('./myexample');

	}

	public function exampleDetail(){
		$exampleId = I('path.2');
		$Example = D('example');
		$data = $Example->where("`id` = $exampleId")->find();
		$htmlContent = $data['content'];
		$tag = $data['tag'];
		$this->assign('tag',$tag);
		$this->assign('htmlContent' , $htmlContent);
		$user = D('User');
		$userData = $user->where("`id` = $data[author_id]")->find();
		$this->assign('author',$userData['nickname']);
		$this->assign('time',$data['create_time']);
		$this->assign('title',$data['title']);
		$checked = false;
		$data['state'] == 1? $checked = true : $checked = false;
		if(!$checked){
			if(!isset($_SESSION['userId'])){
				//$this->error("您无权查看",U('/Home/Index'),3);
				echo '1';
				dump($_SESSION);
				die();
			}
			if($_SESSION['level'] != 0 && $_SESSION['userId'] != $data['author_id']){
				//$this->error("您无权查看",U('/Home/Index'),3);
				echo '2';
				die();
			}
		}
		$this->assign('postChecked' , $checked);
		$this->display('./detail_backup');
	}



}