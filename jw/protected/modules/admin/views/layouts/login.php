<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>后台登录</title>
        <script src="/js/jquery.js" type="text/javascript"></script>
        <style type="text/css">
            body{background: #EFEFEF;font: 12px Verdana,"宋体",sans-serif;}
            .container{background: white;border: 1px solid #C9E0ED;margin-bottom: 5px;margin-top: 5px;width: 950px;margin: 0px auto;}
            .header{border-bottom: 1px solid #C9E0ED;margin: 20px 20px;}
            .main{padding: 200px 200px 400px;margin: 0px 20px;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h3>金屋后台管理</h3>
            </div>
            <div class="main">
                <?php echo $content; ?>
            </div>
        </div>
        
    </body>
</html>
