<?php

class TagCloud extends CWidget
{
    public $tags;//标签，按点击数从大到小排序
    public $url;//标签的链接前缀
	public function run()
	{
        
//        $fontSize = array('12px','16px','20px','24px','30px');
//        $color = array('#000000','#FFCC00','#0099FF','#FF9900','#FF0000');
//
//        $fontStyle = array();//字体的样式
//        $num =0;//最大点击数
//        $str = "";
//        if(count($this->tags)>0){
//            $num = $this->tags[0]['tag_frequency'];
//            $tagnum = count($this->tags);//得到所有要显示的所有标签数
//            $oneLength = ceil($num/5);//每一段标签所包含的数目
//            foreach ($this->tags as $value) {
//                $i = $oneLength == 0?0:ceil($value->tag_frequency / $oneLength);
//                if($i>=1)
//                    $i = $i - 1;
//                $str .= "<a href='" . Yii::app()->createUrl($this->url, array('tag' => $value->tag_id)) . "' target='_blank' style='TEXT-DECORATION:none'>";
//                $str .= "<font color='" . $color[$i] . "' style='font-size:" . $fontSize[$i] . "' title='点击" . $value->tag_frequency . "次'>" . CHtml::encode($value->tag_name) . "</font></a>&nbsp;&nbsp;";
//            }
//        }
//        echo $str;
        $str = "";
        if(count($this->tags)>0){
            foreach($this->tags as $value){
                $str .= "<a href='" . Yii::app()->createUrl($this->url, array('tag' => $value->tag_id)) . "' target='_blank' style='TEXT-DECORATION:none'>";
                $str .= "<font color='black' title='点击" . $value->tag_frequency . "次'>" . CHtml::encode($value->tag_name) . "</font></a>&nbsp;&nbsp;";
            }
        }
        echo $str;
	}
}
?>