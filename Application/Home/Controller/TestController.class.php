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

    public function showAuthorImg(){
    	$Example = D('example');
    	$data = $Example->field('authors')->find(12);
    	$authors = $data['authors'];
    	$authors = json_decode($authors,true);
    	$imgId = $authors['touxiang'];
    	$Img = D('author_img');
    	$data = $Img->find($imgId);
    	$this->assign('data',$data['data']);
    	$this->display('./test');
    }
}