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
			$this->registerError('验证码错误');
			die();
		}
		$IC = D('invite_code');
		$code = I('post.inviteCode');
		$data = $IC->where("code = '$code'")->find();
		if(!$data){
			$this->registerError('邀请码错误');
			die();
		}
		$inviteId = $data['user_id'];
		$newData = array();
		$newData['username'] = $username;
		$newData['password'] = md5($password);
		$newData['sex'] = $sex;
		$newData['nickname'] = $nickname;
		$usrId = $User->data($newData)->add();
		$UserOther = D('user_other');
		$otherData = array('invite_user_id'=>$inviteId,'user_id'=>$usrId);
		$UserOther->data($otherData)->add();
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
		$where = array('user_id'=>$_SESSION['userId']);
		$codeData = $inviteCode->where($where)->find();
		if(!$codeData){
			$insert = array();
			$insert['user_id'] = $_SESSION['userId'];
			$insert['code'] = $this->unique_number();
			$inviteCode->add($insert);
			$codeData = $insert;
		}
		$this->assign('inviteCode' , $codeData['code']);
		$this->display('./inviteCode');

	}

	public function inviteUnchecked(){
		$userOther = M('user_other');
		$subquery = $userOther->field('user_id')->where("`invite_user_id` = $_SESSION[userId]")->select(false);
		$condition = array();
		
		
		$User = D('user');
		$data = $User->where("`id` IN ($subquery) AND `state`='UNCHECKED'")->select();
		$this->assign('users',$data);
		$this->display('./unchecked');

	}



	private function userInfo($uid){
		$User = D('user_info');
		$data = $User->find($uid);


		

	}

	public function selfInfo(){
		$User = D('user');
		$data = $User->field('state')->find($_SESSION['userId']);
		$state = $data['state'];
		if($state == 'UNWRITE'){
			$this->redirect("/Home/User/selfInfoWrite");
		} 
		else if($state == 'UNCHECKED'){
			$this->redirect("/Home/User/selfInfoUnchecked");
		}
		$UI = D('user_info');
		$data = $UI->find($_SESSION['userId']);
		$this->assign('data',$data);
		$this->display('./userInfo');
	}

	public function selfInfoWrite(){
		$this->display('./selfInfoWrite');
	}

	public function selfInfoUnchecked(){
		$this->assign('alert',true);
		$this->assign('alertInfo','您的信息正在等待邀请人审核');
		$data = $this->userInfo($_SESSION['userId']);
		$this->assign('data',$data);
		$this->display('./userInfo');
	}

	public function selfInfoEdit(){
		$data = $this->userInfo($_SESSION['userId']);
		$this->assign('data',$data);
		$this->dsiplay('./selfInfoEdit');
	}

	public function inviteUserCheck(){
		$uid = I('post.id');
		$data = $this->userInfo($uid);
		$this->assign('data',$data);
		$this->display('./userInfoChecked');
	}

	public function userCheckPost(){
		$uid = I('post.id');
		$iu = $_SESSION['userId'];
		$userOther = D('user_other');
		$user = $userOther->find($uid);
		if($user['invite_user_id'] != $iu){

		}
		$User = D('user');
		$update = array( "state" => 'CHECKED');
		$User->where("id = $uid")->save($update);
	}

	public function pwFind(){

	}

	public function userTest(){
		$User = D('user_info');
		$data = $User->find(1);
		$this->assign('data',$data);
		$this->display("./userInfoChecked");
	}
}