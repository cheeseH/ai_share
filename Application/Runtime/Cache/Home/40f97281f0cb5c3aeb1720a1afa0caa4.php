<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog Template for Bootstrap</title>
    <style type="text/css">
        #ueditor {
          width: 500px;
        }
        #ueditor img {
          width: 500px;
        }
    </style>
    <!-- Bootstrap core CSS -->
       <link rel="stylesheet" href="/ai_share/Public/register/assets/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="/ai_share/Public/register/assets/css/blog.css">
          <script src="/ai_share/Public/Ueditor/ueditor.parse.js"></script>





    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <li class="active"><a href="<?php echo U('/Home/index');?>">首页</a></li>
            <li><a href="#about">资讯</a></li>
            <li><a href="#contact">论坛</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
  <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
      </div>
    </div>  

    <div class="container">
<div class="row row-offcanvas row-offcanvas-right">


        <div class="col-sm-8 blog-main">

          <div class="blog-post">
            <h2 class="blog-post-title"><?php echo ($title); ?></h2>
            <p class="blog-post-meta"><?php echo ($time); ?> by <?php echo ($author); ?>
            <?php if(!$postChecked){ ?>
             (案例未审核)
             <?php } ?>
            </p>

            <div id="ueditor">
            </div>
          </div><!-- /.blog-post -->

          

          

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
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
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->
</div>
    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/ai_share/Public/register/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/ai_share/Public/register/assets/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
       uParse('.ueditor',{
        rootPath:"/ai_share/Public/Ueditor/"
       })
       var dom = document.getElementById('ueditor');
       dom.innerHTML = '<?php echo ($htmlContent); ?>';
       </script>
  </body>
</html>