<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$example = D('example');
    	$page;
    	if(I('get.page'))
    	{
    		$page = I('get.page');
    	}
    	$exampleCount = $example->where('state = 1')->count();

    	$totalPage = intval($exampleCount/9) + ($exampleCount%9 == 0 ? 0 : 1);
    	$list = $example->page("$page,9")->where('`state` = 1')->select();
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
    	$this->display('./index');


    }

    private function attach($url){
    	$attach = D('attachment');
    	$data = array();
    	$data['temp_id'] = $_SESSION['temp_post_id'];
    	$data['url'] = $url;
    	$data['upload_time'] = date('Y-m-d H:i:s',time());
    	$data['finished'] = 0;
    	$result = $attach->data($data)->add();
    	return $result;
    }

    public function uploadinfo(){
    	$ueditor_config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("./Public/Ueditor/php/config.json")), true);
		$action = $_GET['action'];
		switch ($action) {
			case 'config':
				$result = json_encode($ueditor_config);
				break;
				/* 上传图片 */
			case 'uploadimage':
				/* 上传涂鸦 */
			case 'uploadscrawl':
				/* 上传视频 */
			case 'uploadvideo':
				/* 上传文件 */
			case 'uploadfile':
				$upload = new \Think\Upload();
				$upload->maxSize = 3145728;
				$upload->rootPath = './Public/Uploads/';
				$upload->exts = array('jpg', 'gif', 'png', 'jpeg','aia','apk');
				$info = $upload->upload();
				if (!$info) {
					$result = json_encode(array(
							'state' => $upload->getError(),
					));
				} else {
					$url = __ROOT__ . "/Public/Uploads/" . $info["upfile"]["savepath"] . $info["upfile"]['savename'];
					
					if(!$this->attach($url)){
						$result = json_encode(array(
							'state' => "数据库出错",
						));
					}
					else{
						$result = json_encode(array(
							'url' => $url,
							'title' => htmlspecialchars($_POST['pictitle'], ENT_QUOTES),
							'original' => $info["upfile"]['name'],
							'state' => 'SUCCESS'
						));
					}
				}
				break;
			default:
				$result = json_encode(array(
				'state' => '请求地址出错'
						));
						break;
		}
		/* 输出结果 */
		if (isset($_GET["callback"])) {
			if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
				echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
			} else {
				echo json_encode(array(
						'state' => 'callback参数不合法'
				));
			}
		} else {
			echo $result;
		}
    }

    public function saveinfo(){
    	dump($_SESSION);
    }
}