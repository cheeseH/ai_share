<?php
namespace Home\Controller;
use Think\Controller;

class UserController extends Controller{
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
}