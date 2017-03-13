<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/ai_share/Public/register/assets/bootstrap/css/bootstrap.min.css">
<script src="/ai_share/Public/register/assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/ai_share/Public/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/ai_share/Public/Ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" src="/ai_share/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>


<title>AppInventor案例交流</title>
</head>
  <body>
        <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">AppInventor</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo U('/Home/Index');?>">首页</a></li>
            <li><a href="#about">资讯</a></li>
            <li><a href="http://120.77.81.88/app_inventor/forum.php">论坛</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>欢迎来到AppInventor乐园</h1>
        <p>这是面向中国app inventor用户的案例分享和交流平台，我们希望所有用户都能在这里快乐地学习app inventor的使用以及分享自己的创意</p>
      
      </div>
    </div>
    <div class="container">


      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <form action="<?php echo U('Home/Example/examplePost');?>"  method="post">
          标题<input type="text" name = "title" style="margin-bottom:10px">
  <script id="container" name="content" type="text/plain">
    </script>
    <div class="">
              <input id="j_verify"name="j_verify" type="text" class="">
              <img id="verify_img" alt="点击更换" title="点击更换" src="<?php echo U('public/verify',array());?>" class="m">
      </div>
    <input type="submit" value="submit">
    </form>
  <script type="text/javascript" charset="utf-8">
        var ue = UE.getEditor('container',{
            serverUrl:"<?php echo U('Home/Index/uploadinfo');?>"
        });
    
    </script>    
    <script src="/ai_share/Public/register/assets/js/jquery-1.11.1.min.js"></script>
      <script type="text/javascript">
       $("#verify_img").click(function() {
    var verifyURL = "<?php echo U('public/verify');?>";
    var time = new Date().getTime();
    $("#verify_img").attr({
        "src" : verifyURL + "/" + time
    });
    });
       $("#j_verify").keyup(function() {
      $.post("public/check_verify", {
          code : $("#j_verify").val()
          }, function(data) {
          if (data == true) {
              //验证码输入正确
          } else {
              //验证码输入错误
          }
      });
});
       </script>  
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
         <a href="<?php echo U('Search/index');?>" class="list-group-item">搜索</a>
            <?php if(!isset($_SESSION['userId'])): ?><a href="<?php echo U('User/login');?>" class="list-group-item">登陆</a>
            <?php else: ?>
             <a href="<?php echo U('example/post');?>" class="list-group-item">发表</a>
            <a href="<?php echo U('example/myExample');?>" class="list-group-item">我的案例</a>
            <?php if($_SESSION['level'] == 0): ?><a href="<?php echo U('admin/index');?>" class="list-group-item">后台管理</a><?php endif; ?>
            <a href="<?php echo U('User/logout');?>" class="list-group-item">退出</a><?php endif; ?>
       <!--     <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          -->
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; 2016 Company, Inc.</p>
      </footer>

    </div><!--/.container-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>