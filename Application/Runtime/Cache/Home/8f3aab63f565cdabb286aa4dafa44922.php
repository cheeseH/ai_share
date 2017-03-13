<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap Multi Step Registration Form Template</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="/ai_share/Public/register/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/ai_share/Public/register/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="/ai_share/Public/register/assets/css/form-elements.css">
        <link rel="stylesheet" href="/ai_share/Public/register/assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="/ai_share/Public/register/assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ai_share/Public/register/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ai_share/Public/register/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ai_share/Public/register/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/ai_share/Public/register/assets/ico/apple-touch-icon-57-precomposed.png">

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
            <li class="active"><a href="<?php echo U('Index/index');?>">首页</a></li>
            <li><a href="#about">资讯</a></li>
            <li><a href="#contact">论坛</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	
                        	<form role="form" action="<?php echo U('Home/User/registerPost');?>" method="post" class="registration-form">
                        		
                        		<fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 1 / 2</h3>
		                            		<p>账号设置</p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-user"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
				                    	<div class="form-group">
				                        	<label class="sr-only" for="form-email">邮箱</label>
				                        	<input type="text" name="username" placeholder="用户名（用于登陆）" class="form-email form-control" id="form-email">
				                        </div>
				                        <div class="form-group">
				                    		<label class="sr-only" for="form-password">密码</label>
				                        	<input type="password" name="password" placeholder="密码" class="form-password form-control" id="form-password">
				                        </div>
				                        <div class="form-group">
				                        	<label class="sr-only" for="form-repeat-password">重复密码</label>
				                        	<input type="password" name="repeat-password" placeholder="重复密码" 
				                        				class="form-repeat-password form-control" id="form-repeat-password">
				                        </div>
				                        <button type="button" class="btn btn-next">Next</button>
				                    </div>
			                    </fieldset>
			                    
			                    			                    
			                    <fieldset>
		                        	<div class="form-top">
		                        		<div class="form-top-left">
		                        			<h3>Step 2 / 2</h3>
		                            		<p>基本信息</p>
		                        		</div>
		                        		<div class="form-top-right">
		                        			<i class="fa fa-twitter"></i>
		                        		</div>
		                            </div>
		                            <div class="form-bottom">
				                    	<div class="form-group">
				                    		<label class="sr-only" for="form-first-name">First name</label>
				                        	<input type="text" name="nickname" placeholder="昵称" class="form-first-name form-control" id="form-first-name">
				                        </div>
				                        <div class="form-group">
				    		<label class="radio-inline">
				                        	<input type="radio" name="sex" value="male" checked>男
				                        	</label>
				                        	<label class="radio-inline">
				                       
						<input type="radio" name="sex" value="female">女
						
						</div>
						<div class="">
							<input id="j_verify"name="j_verify" type="text" class="">
							<img id="verify_img" alt="点击更换" title="点击更换" src="<?php echo U('public/verify',array());?>" class="m">
						</div>
				                        </div>
				                        
				                        <button type="button" class="btn btn-previous">Previous</button>
				                        <button type="submit" class="btn">Sign me up!</button>
				                    </div>
			                    </fieldset>
		                    
		                    </form>

		                    
                        </div>
                    </div>
                    <?php if($iserror == true): ?><div class="container">
                                                <div class="alert alert-danger" role="alert"><?php echo ($error); ?></div>
                                                </div><?php endif; ?>
                </div>

            </div>
        </div>


        <!-- Javascript -->
        <script src="/ai_share/Public/register/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/ai_share/Public/register/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="/ai_share/Public/register/assets/js/jquery.backstretch.min.js"></script>
        <script src="/ai_share/Public/register/assets/js/retina-1.1.0.min.js"></script>
        <script src="/ai_share/Public/register/assets/js/scripts.js"></script>
<script type="text/javascript">
       $("#verify_img").click(function() {
   	var verifyURL = "<?php echo U('public/verify');?>";
   	var time = new Date().getTime();
   	$("#verify_img").attr({
      	"src" : verifyURL + "/" + time
   	});
  	});
       
});
       </script>
        
        <!--[if lt IE 10]>
            <script src="/ai_share/Public/register/assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>