<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Demo</title>
        <!-- JQuery 这里自己引用 -->
    <script type="text/javascript" src="/ai_share/Public/Ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/ai_share/Public/Ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" src="/ai_share/Public/Ueditor/lang/zh-cn/zh-cn.js"></script>

</head>
<body>
<form action="<?php echo U('Home/Index/saveinfo');?>"  method="post">
  <script id="container" name="content" type="text/plain">
    </script>
    <input type="submit" value="submit">
    </form>
  <script type="text/javascript" charset="utf-8">
        var ue = UE.getEditor('container',{
            serverUrl:"<?php echo U('Home/Index/uploadinfo');?>"
        });
    
    </script>    
</body>
</html>