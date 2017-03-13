<?php
namespace Home\Controller;
use Think\Controller;
class TestController extends Controller {
    public function index(){
    	$this->display('./test'); 
    }

    public function mail(){
    	sendMailVerify('634078905@qq.com','register');
    	
    }
}