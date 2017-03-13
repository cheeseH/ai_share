<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
	private function unique_number()
	{
		return $_SESSION['user_id'].":".date('Y-m-d h:i:s') . substr(implode(NULL, array_map('ord', str_split(strrev(substr(uniqid(), 7, 13)), 1))), 0, 8);
	}
	public function register(){
		$this->display('./register');
	}

	private function registerError($error){
		echo '?';
		$this->assign('error',$error);
		$this->assign('iserror',true);
		$this->display('./register');
	}
	private function pri_get($str){
		return I($str,'','htmlspecialchars');
	}

	private function innerLogin($username,$password){
		if(!$username){
			$this->loginError('用户名不能为空');
		}
		$User = D('user');
		$where = array(
			'username' =>$username
		);
		$data = $User->where($where)->relation(true)->find();
		if(!$data){
			$this->loginError('用户名不存在');
		}
		
		if(md5($password) != $data['password']){
			$this->loginError('密码错误');
		}
		$_SESSION['userId'] = $data['id'];
		$_SESSION['nickname'] = $data['nickname'];
		$_SESSION['level'] = $data['group']['level'];
		//跳到首页
		$this->redirect('/Home/Index/');
	}


	public function registerPost(){
		$User = D('user');
		$username = $this->pri_get('post.username');
		$array = array();
		$array['username'] = $username;
		$data = $User->where($array)->find();
		if($data){
			//
			$this->registerError('用户名已存在');
			die();

		}

		$password = $this->pri_get('post.password');
		$repeat = $this->pri_get('post.repeat-password');
		if($password != $repeat){
			$this->registerError('两次输入密码不一致');
			die();
		}

		$nickname = $this->pri_get('post.nickname');
		$array2 = array();
		$array2['nickname'] = $nickname;
		$data = $User->where($array2)->find();

		if($data){
			echo '6';
			$this->registerError('昵称已被占用');
			die();
		}
		$sex = $this->pri_get('post.sex');
		$code = $this->pri_get('post.j_verify');
		$pc = new PublicController();

		if(!$pc->check_verify($code)){
			$this->registerError('验证码初一我也');
			die();
		}

		$newData = array();
		$newData['username'] = $username;
		$newData['password'] = md5($password);
		$newData['sex'] = $sex;
		$newData['nickname'] = $nickname;
		$User->data($newData)->add();
		$this->innerLogin($username,$password);
		

	}

	public function login(){
		$this->display('./login');
	}



	private function loginError($error){
		$this->assign('error',$error);
		$this->assign('iserror',true);
		$this->display('./login');
		die();
	}

	public function loginPost(){
		$username = $this->pri_get('post.username');
		$password = $this->pri_get('post.password');
		if(!$username){
			$this->loginError('用户名不能为空');
		}
		$User = D('user');
		$where = array(
			'username' =>$username
		);
		$data = $User->where($where)->relation(true)->find();
		if(!$data){
			$this->loginError('用户名不存在');
		}
		
		if(md5($password) != $data['password']){
			$this->loginError('密码错误');
		}
		$_SESSION['userId'] = $data['id'];
		$_SESSION['nickname'] = $data['nickname'];
		$_SESSION['level'] = $data['group']['level'];
		//跳到首页
		$this->redirect('/Home/Index/');
	}

	public function logout(){
		unset($_SESSION['userId']);
		unset($_SESSION['nickname']);
		unset($_SESSION['level']);
		$this->redirect('/Home/Index');
	}

	public function mailVerifySend($mail){
		
	}

	public function pwEdit(){
		$old = I('post.old');
		$new = I('post.new');
		$cfrm = I('post.cfrm');
		$user = D('user');
		$userData = $user->find($_SESSION['userId']);
		if($old == $new){
			$this->assign('error','新旧密码重复');
		}
		if($userData['password'] != $old){
			$this->assign('error','旧密码错误');
		}
		if($new != $cfrm){
			$this->assign('error','重复密码不一致');
			
		}
		$userData['password'] = $new;
		$user->where("id = $this->userId")->save($userData);
		
	}

	public function inviteCode(){
		if(!$_SESSION['userState']){

		}
		$inviteCode = D('invite_code');
		$codeData = $inviteCode->find($_SESSION['userId']);
		if(!$codeData){
			$insert = array();
			$insert['user_id'] = $_SESSION['userId'];
			$insert['code'] = $this->unique_number();
			$inviteCode->add($insert);
			$codeData = $insert;
		}
		$this->assign('inviteCode' , $codeData['code']);


	}
}