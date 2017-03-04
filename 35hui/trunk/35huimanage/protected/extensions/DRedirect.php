<?php
class DRedirect extends CApplicationComponent
{
    //添加一个指定时间后的带消息跳转
    public static function redirect($url,$msg=NULL,$time=3,$end=true){
            if(is_array($url))
    {
        $route=isset($url[0]) ? $url[0] : '';
        $url=Yii::app()->createUrl($route,array_splice($url,1));
    }
            echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="'.$time.'; URL='.$url.'" />';
            echo '<style type="text/css">
                    body {text-align:center;font-size:12px;}
                    div#wrap {width:600px;margin:0px auto;margin-top:50px;margin-bottom:100px;border:#B7DDF2 1px solid;background-color:#EBF4FB;}
                    p.msg {font:bold 16px "宋体";color:#2F4CFC;}
                    h3 {background-color:#B7DDF2;padding:5px 20px;text-align:left;margin-top:0px;}
                  </style>';
            echo '</head><body><div id="wrap">';
            echo '<H3>系统跳转</H3><p class="msg">';
            echo nl2br($msg);
            echo '</p>系统会在'.$time.'秒后跳转，如果没有跳转你可以<a href="'.$url.'">点击这里手工跳转</a>';
            echo '<br /><br /><br /></div></body></html>';

            if ($end)
                    Yii::app()->end();
    }
}