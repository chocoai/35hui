<?php
require_once(dirname(__FILE__).'/define.php');//加载定义的全局变量
require_once(ROOT.PATH_LIB.'util.php');

function getYear(){
    return intval(date('Y'));
}
function getMonth(){
    return intval(date('m'));
}
/**
 * 根据传入的时间戳,得到一个字符串,例如:10秒前 5天后 很久后
 * @param <type> $demoTime
 * @return <type>
 */
function dealShowTime($demoTime){
    $resultStr = "";
    $nowTime = time();//得到当前时间戳
    $suffix = $demoTime>$nowTime?"后":"前";
    $diffTime = abs($nowTime-$demoTime);//得到差值
    if($diffTime<=60){//几秒左右
        $resultStr = $diffTime."秒".$suffix;
    }elseif($diffTime>60 && $diffTime<=3600){//几分钟左右
        $min = round($diffTime/60);
        $resultStr = $min."分钟".$suffix;
    }elseif($diffTime>3600 && $diffTime<=86400){//几小时左右
        $hour = round($diffTime/3600);
        $resultStr = $hour."小时".$suffix;
    }elseif($diffTime>86400 && $diffTime<=2678400){//几天左右
        $day = round($diffTime/86400);
        $resultStr = $day."天".$suffix;
    }else{//很久
        $resultStr = "很久以".$suffix;
    }
    return $resultStr;
}
function showFormatDateTime($demoTime){
    return date("Y-m-d H:i:s",$demoTime);
}
/**
 *截取字符串
 * @param <type> $string 输入字符串
 * @param <type> $length 长度
 * @param <type> $dot 超过长度时后缀
 * @param <type> $charset编码
 * @return <type>
 */
function strCut($string, $length, $dot = '...',$charset='utf-8'){
    $strlen = strlen($string);
    if($strlen <= $length) {
        return $string;
    }
    $strcut = '';
    if(strtolower($charset) == 'utf-8'){
        $n = $tn = $noc = 0;
        while($n < $strlen){
            $t = ord($string[$n]);
            if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                $tn = 1; $n++; $noc++;
            }else if(194 <= $t && $t <= 223) {
                $tn = 2; $n += 2; $noc += 2;
            }else if(224 <= $t && $t <= 239) {
                $tn = 3; $n += 3; $noc += 3;
            }else if(240 <= $t && $t <= 247) {
                $tn = 4; $n += 4; $noc += 4;
            }else if(248 <= $t && $t <= 251) {
                $tn = 5; $n += 5; $noc += 5;
            }else if($t == 252 || $t == 253){
                $tn = 6; $n += 6; $noc += 6;
            }else{
                $n++;
            }
            if($noc >= $length) {
                break;
            }
        }
        if($noc > $length){
            $n -= $tn;
        }
        $strcut = substr($string, 0, $n);
        $strcut = $strcut.$dot;
    }else{
        $dotlen = strlen($dot);
        $maxi = $length - $dotlen - 1;
        for($i = 0; $i < $maxi; $i++){
            $strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
        }
    }
    return $strcut;
}