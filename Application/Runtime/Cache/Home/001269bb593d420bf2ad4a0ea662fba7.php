<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/ai_share/Public/register/assets/bootstrap/css/bootstrap.min.css">
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


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
            <li><a href="#contact">论坛</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
      </div>
    </div>
    <div class="container">


      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
         <!-- <div class="jumbotron">
            <h1>Hello, world!</h1>
            <p>This is an example to show the potential of an offcanvas layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
          </div>
          -->
          <div class="row">
          <?php if(is_array($list)): foreach($list as $key=>$example): ?><a href="<?php echo U('/Home/Example/exampleDetail/'.$example[id]);?>" style="text-decoration:none;color:#333">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">
                      <?php echo ($example['title']); ?>
                  </h3>
              </div>
              <div class="panel-body">
                <?php echo ($example['brief']); ?>
              </div>
          </div>
          </a><?php endforeach; endif; ?>
            
            <nav aria-label="...">
  <ul class="pagination">
  <?php if($prevEnable){ ?>
    <li class><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <?php } else{ ?>
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <?php } $current = 0; while($current < $pageCount){ $p = $beginPage + $current; if($p == $page){ ?>
    <li class="active"><a href="#"><?php echo ($p); ?> <span class="sr-only">(current)</span></a></li>
    <?php }else{ ?>
    <li><a href="#"><?php echo ($p); ?></a></li>
    <?php $current++; } } if($nextEnable){ ?>
  
    <li class><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
    <?php }else{ ?>
    <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
    <?php } ?>
  </ul>
</nav>
          </div><!--/row-->
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
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>