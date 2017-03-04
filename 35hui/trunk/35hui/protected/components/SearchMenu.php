<?php
Yii::import("zii.widgets.CPortlet");
class SearchMenu extends CPortlet{
    public $showMenu = array(//需要显示的搜索条件
        1,//区域
        2,//类型,比如:出租,出售,求租,求售
        3,//面积
        4,//地段,比如:内环,外环,中环
        5,//售价
        6,//租金
        7,//附近地铁路线
        8,//装修
        9,//关键字搜索
        10,//房源,比如:中介 个人
        11,//标签
        12,//房源类型,比如:写字楼 商务中心
        13,//平均租金-只针对楼盘
        14,//平均售价-只针对楼盘
        15,//商务中心出租
        16,//小区均价
        17,//住宅租金
        18,//交通站点查询
        19,//房型
        20,//物业类型
        21,//商铺行业：超市零售 餐饮美食 服饰鞋包 休闲娱乐 生活服务 家居建材 酒店宾馆 美容美发 电子通讯 其他
        22,//商铺月租金
        23,//商铺总价
    );
    public $url = "";//链接的url
    public $noAll = array();//不显示"不限"的条件
    public $showStation = true;//是否显示站点
    public $showSection = true;//是否显示板块
    public $autoCompleteData = 0;//keyword搜索自动完成使用的数据 0不使用自动完成、1楼盘、2商业广场、3小区

    /**
     *用户自定义的参数。
        'userOption'=>array(
            "links"=>array(
                "物业",
                "写字楼"=>"asdfasdf",
                "商务中心"=>"asdfasdf",
                "创意园区"=>"sddd",
            ),
            "selected"=>"写字楼",
            "pos"=>"HEAD", 支持 HEAD END
        ),
     */
    public $userOption = array();
    
    /*
     * 1 默认,代表楼盘标签
     * 2 代表写字楼标签
     * 3 代表工业厂房房源标签
     * 4 代表商铺房源标签
     * 5 代表大型项目房源标签
     * 6 代表生意转让房源标签
     */
    public $tagType = 1;//标签搜索的条件中,显示什么类别的标签

    /**
     * 资源类型 1写字楼 2商铺 3住宅
     * @var <type>
     */
    public $sourceType = 1;
    
    /**标签搜索中的租售类型
     * 0 默认出租
     * 1 出售
     * 2 不限
     */
    public $tagMarketType = 0;
    
    public static $menu2Ids = array(//$showMenu中对应的数字和关联的searchcondition表中的主键id
        2=>1,//类型,比如:出租,出售,求租,求售
        3=>6,//面积
        4=>15,//地段,比如:内环,外环,中环
        5=>20,//售价
        6=>30,//租金
        7=>40,//附近地铁路线
        8=>51,//装修
        10=>56,//房源
        12=>61,//房源类型
        13=>67,//平均租金
        14=>74,//平均售价
        15=>91,//商务中心出租
        16=>98,//小区均价
        17=>107,//住宅租金
        19=>119,//房型
        20=>126,//物业类型
        21=>132,//行业类型
        22=>143,//商铺月租金
        23=>150,//商铺总价
    );
    
    public static $regionArray = array('district','section');//区域搜索条件参数名
    public static $subwayArray = array('line','station');//交通搜索条件参数名
    public static $otherArray = array("filterdate","order","keyword","sourcetag","searchType");
    public static $searchConditionArray = array(//其他搜索条件参数名,id对应的是数据库条件id,内容为参数名
        1=>'type',
        6=>'area',
        15=>'loop',
        20=>'sPrice',
        30=>'rPrice',
        40=>'metro',
        51=>'fitment',
        56=>'source',
        61=>'sourceType',
        67=>'avgr',
        74=>'avgs',
        91=>'rbPrice',
        98=>'cavgPrice',
        107=>'rrPrice',
        119=>'hType',
        126=>'pType',
        132=>'tType',
        143=>'mrPrice',
        150=>'sumPrice',
    );
    /**
     *单位
     */
    private static $units = array(
        "sPrice"=>"万元/套",
        "rPrice"=>"元/平米·天",
        "area"=>"平米",
        "avgr"=>"平均租金(元/平米·天)",
        "avgs"=>"平均售价(元/平米)",
        "rbPrice"=>"租金(元/工位·月)",
        "cavgPrice"=>"价格(元/平米)",
        "rrPrice"=>"租金(元/月)",
        "sumPrice"=>"万元/套",
    );
    /**
     * 是否使用输入框搜索
     * @var <type>
     */
    public $inputSearchBoolean = true;
    private static $inputSearch = array(//最后一个字母只能是a或者b
        "area"=>array("areaa","areab"),
        "rPrice"=>array("rPricea","rPriceb"),
        "sPrice"=>array("sPricea","sPriceb"),
        "rbPrice"=>array("rbPricea","rbPriceb"),
        "avgr"=>array("avgra","avgrb"),
        "avgs"=>array("avgsa","avgsb"),
    );
    public static $diyCondition ="keyword";
    public static $tagCondition = "tag";
    public static $getName= "search";//搜索中get名称
    public function renderContent(){
        switch($this->sourceType){
            case 1://写字楼
                $this->content();break;
            case 2://商铺
                echo "<dl class='threeline_boxleftone'>";$this->content();echo "</dl>";break;
            case 3://住宅
                echo "<dl class='threeline_boxleftone'>";$this->content();echo "</dl>";break;

        }
    }
    private function content(){
        $this->setUserOption("HEAD");
        $ExistOptions = self::explodeAllParamsToArray();//用来记录已经保存的条件
        $options = array();//临时条件
        self::showSubwaySearch($this->showMenu,$options,$ExistOptions);//显示地铁搜索条件
        self::showAreaSearch($this->showMenu,$options,$ExistOptions);//显示区域搜索条件
        self::showOtherTypeSearch($this->showMenu,$options,$ExistOptions);//显示其他搜索条件
        self::showDiySearch($this->showMenu,$options,$ExistOptions);
        $this->setUserOption("END");
    }
    private function setUserOption($pos){
        if($this->userOption&&$this->userOption["pos"]==$pos){
            $links = $this->userOption["links"];
            $title = array_shift($links);
            if($this->sourceType==1){
                echo '<div class="srline"><em>'.$title.'：</em>';
                $this->getUserLinks($links);
                echo '</div>';
            }elseif($this->sourceType==2){
                echo '<dd class="leibie"><div class="lpssleft"><strong>'.$title.'：</strong></div><div class="lpssright">';
                $this->getUserLinks($links);
                echo "</dd>";
            }elseif($this->sourceType==3){
                echo '<dd class="leibie"><div class="lpssleft"><strong>'.$title.'：</strong></div><div class="lpssright">';
                $this->getUserLinks($links);
                echo "</dd>";
            }
        }
    }
    private function getUserLinks($option){
        foreach($option as $key=>$value){
            if($key==$this->userOption["selected"]){
                if($this->sourceType==1){
                    echo CHtml::link($key,array($value),array("class"=>"srclick"));
                }elseif($this->sourceType==2){
                    echo CHtml::link($key,array($value),array("class"=>"red_white"));
                }elseif($this->sourceType==3){
                    echo CHtml::link($key,array($value),array("class"=>"red_white"));
                }
            }else{
                echo CHtml::link($key,array($value));
            }
        }
    }
    /**
     * 得到允许的参数集合
     * @return <array>
     */
    public function getAllowParams(){
        $allowParams = array();//记录允许的参数集合
        if($this->showMenu){
            if(in_array(1,$this->showMenu)){
                $allowParams = array_merge($allowParams,self::$regionArray);
            }
            if(in_array(9,$this->showMenu)){
                array_push($allowParams,self::$diyCondition);
            }
            if(in_array(11,$this->showMenu)){
                array_push($allowParams,self::$tagCondition);
            }
             if(in_array(18,$this->showMenu)){
                $allowParams = array_merge($allowParams,self::$subwayArray);
            }
            $newShow = array_diff($this->showMenu,array(1,9,18));
            $bTypeIds = self::getBigTypeDbIds($newShow);
            foreach($bTypeIds as $bigTypeId){
                if(array_key_exists($bigTypeId,self::$searchConditionArray)){
                    array_push($allowParams,self::$searchConditionArray[$bigTypeId]);
                }
            }
        }
        return $allowParams;
    }
    //得到所有的参数集合
    public static function getAllParams(){
        $allArray  = array_unique(array_merge(self::$regionArray,self::$searchConditionArray));//合并并去除重复值
        $allArray  = array_unique(array_merge(self::$subwayArray,$allArray));//合并并去除重复值
        $allArray  = array_unique(array_merge(self::$otherArray,$allArray));//合并并去除重复值
        foreach(self::$inputSearch as $value){
            $allArray  = array_unique(array_merge($value,$allArray));//合并并去除重复值
        }
        return $allArray;
    }
    public static function getRegionParams(){
        return self::$regionArray;
    }
    public static function getSubwayParams(){
        return self::$subwayArray;
    }
    public static function getSearchConditionParams(){
        return self::$searchConditionArray;
    }
    public static function getTagConditionParams(){
        return self::$tagCondition;
    }
    public static function getAllInPutSearch(){
        $return = array();
        foreach(self::$inputSearch as $key=>$value){
            foreach($value as $v){
                $return [$v] = $key;
            }
        }
        return $return;
    }
    /**
     *经过短地址处理后，得到完整的get参数
     * @return <array>
     */
    public static function explodeAllParamsToArray($options=null){
        $existOptions = array();
        $allArray  = self::getAllParams();//合并并去除重复值
        if(!$options){//如果没传参数，则使用get的值
            $options = (isset($_GET[self::$getName])&&$_GET[self::$getName]!="")?$_GET[self::$getName]:"";
        }
        
        $optionArr = explode("-", $options);
        if($optionArr){
            foreach($optionArr as $key=>$value){
                foreach($allArray as $k=>$v){
                    //判断比较参数后面的值类型。只有keyword和排序是字母，其他都是数字
                    if($v=="order"||$v=="keyword"){
                        if(preg_match ("/^".$v."/i", $value)){//如果参数在可以出现的参数之内
                            $existOptions[$v] = substr($value, strlen($v));
                        }
                    }else{
                        if(preg_match ("/^".$v."\d+/i", $value)){//如果参数在可以出现的参数之内
                            $existOptions[$v] = substr($value, strlen($v));
                        }
                    }
                }
            }
        }
        return $existOptions;
    }
    /**
     *把所有参数变成一个可以使用的集合。返回值要用creatUrl生成链接
     * @param <type> $demoOption 已有的参数
     * @param <type> $key 要加的参数键名
     * @param <type> $val要加的参数健值
     * @return <array>
     */
    public static function dealOptions($demoOption,$key="",$val=""){
        if($key){
            $demoOption[$key]=$val;
        }
        $rArray = array();
        foreach($demoOption as $k=>$v){
            if($v){
                $rArray[] = $k.$v;
            }
        }
        $return = array();
        if($rArray){
            $return[self::$getName] = implode("-", $rArray);
        }
        return $return;
    }
    /**
     * 输出区域的搜索条件信息
     * @param <array> $showIds 一共要显示的条件id集合
     * @param <array> $noAll 不显示"不限"的条件id
     * @param <type> $options 临时的条件
     * @param <type> $existOptions 已经保存的搜索条件
     */
    public function showAreaSearch($showIds,$options,$existOptions){
        if(in_array(1,$showIds)){
            if($this->sourceType==1){
                echo '<div class="srline"><em>区域：</em>';
                $this->quyu($existOptions, $options);
                echo '</div>';
                $this->bankuai($existOptions, $options);
            }elseif($this->sourceType==2){
                echo '<dd class="leibie"><div class="lpssleft"><strong>区域：</strong></div><div class="lpssright">';
                $this->quyu($existOptions, $options);
                echo '</div>';
                $this->bankuai($existOptions, $options);
                echo "</dd>";
            }elseif($this->sourceType==3){
                echo '<dd class="leibie"><div class="lpssleft"><strong>区域：</strong></div><div class="lpssright">';
                $this->quyu($existOptions, $options);
                echo '</div>';
                $this->bankuai($existOptions, $options);
                echo "</dd>";
            }
        }
    }
    private function quyu($existOptions,$options){
        $districtInfo = Region::model()->getDistrictAndSection();
        $noSectionOption = $existOptions;
        if(array_key_exists('section', $noSectionOption))
            unset($noSectionOption['section']);
        self::writeConditionContent('district',$options,$noSectionOption,$this->url,$districtInfo->districts,'re_id','re_name');
    }
    public function bankuai($existOptions,$options){
        if(!$this->showSection){//如果设置不显示板块
            return ;
        }
        if(array_key_exists('district',$existOptions) && $existOptions['district']!=""){
            $sections = Region::model()->getDistrictAndSection($existOptions['district']);
            if($this->sourceType==1){
                echo '<div class="stan"><p>';
                self::writeConditionContent('section',$options,$existOptions,$this->url,$sections->districts,'re_id','re_name');
                echo '</p></div>';
            }elseif($this->sourceType==2){
                echo '<dd class="leibie"><div class="lpssleft"><strong>板块：</strong></div><div class="lpssright">';
                self::writeConditionContent('section',$options,$existOptions,$this->url,$sections->districts,'re_id','re_name');
                echo "</div></dd>";
            }elseif($this->sourceType==3){
                echo '<dd class="leibie"><div class="lpssleft"><strong>板块：</strong></div><div class="lpssright">';
                self::writeConditionContent('section',$options,$existOptions,$this->url,$sections->districts,'re_id','re_name');
                echo "</div></dd>";
            }
        }
    }
    public function showSubwaySearch($showIds,$options,$existOptions){
        $isCommunity = $this->sourceType==3?false:true;
        if(in_array(18,$showIds)){
            $showAll = true;
            if(!$isCommunity){
                echo '<dd class="leibie"><div class="lpssleft"><strong>交通：</strong></div><div class="lpssright">';
            }else{
                echo '<div><div class="condition_title">交通：</div><div id="apf_id_10_areacontainer" class="container">';
            }
            $lineInfo = Subway::model()->getLineAndStation();
            $noStationOption = $existOptions;
            if(array_key_exists('station', $noStationOption))
                unset($noStationOption['station']);
            self::writeConditionContent('line',$options,$noStationOption,$this->url,$lineInfo->lines,'sw_id','sw_stationname',$showAll);
            echo "</div>";
            if($isCommunity) echo "</div>";
            if($this->showStation){
                if(array_key_exists('line',$existOptions) && $existOptions['line']!=""){
                    if(!$isCommunity){
                        echo '<dd class="leibie"><div class="lpssleft"><strong>站点：</strong></div><div class="lpssright">';
                    }else{
                        echo '<div id="apf_id_10_blockcontainer" class="sub">';
                    }
                    $stations = Subway::model()->getLineAndStation($existOptions['line']);
                    self::writeConditionContent('station',$options,$existOptions,$this->url,$stations->lines,'sw_id','sw_stationname',$showAll);
                    if(!$isCommunity){
                        echo "</div></dd>";
                    } else {
                        echo "</div>";
                    }
                }
            }
            if(!$isCommunity){
                echo "</dd>";
            }
        }
    }
    /**
     * 根据需要展示的id得到数据库对应的类别id集合
     * @param <array> $showIds
     * @return <array>
     */
    public function getBigTypeDbIds($showIds){
        $idsArray = array();//用来记录结果的
        foreach($showIds as $k){
            if(array_key_exists($k,self::$menu2Ids)){
                array_push($idsArray,self::$menu2Ids[$k]);
            }
        }
        return $idsArray;
    }
    /**
     * 输出其他搜索条件信息
     * @param <array> $showIds 一共要显示的条件id集合
     * @param <array> $noAll 不显示"不限"的条件id
     * @param <type> $options 临时的条件
     * @param <type> $existOptions 已经保存的搜索条件
     */
    public function showOtherTypeSearch($showIds,$options,$existOptions){
        $isCommunity = $this->sourceType==3?true:false;
        $newShowIds = array_diff($showIds,array(1,9));//过滤掉不属于这个搜索条件中的俩个id
        if(!empty($newShowIds)){
            $dbTypeIds = implode(",",self::getBigTypeDbIds($newShowIds));//将对应的数据库类型的id取出来,并以逗号分隔
            $conditionTypes = Searchcondition::model()->getSearchTypes($dbTypeIds);
            foreach($conditionTypes as $type){
                if(array_key_exists($type['sc_id'],self::$searchConditionArray)){//确定取出的搜索类型已经和配置对应好
                    $paramName = self::$searchConditionArray[$type['sc_id']];//得到对应的参数名称
                    $conditions = Searchcondition::model()->findConditionsByType($type['sc_id']);
                    if($this->sourceType==1){
                        echo '<div class="srline"><em>'.$type["sc_title"].'：</em>';
                        self::writeConditionContent($paramName,$options,$existOptions,$this->url,$conditions,'sc_id','sc_title');
                        echo '</div>';
                    }elseif($this->sourceType==2){
                        echo '<dd class="leibie"><div class="lpssleft"><strong>'.$type["sc_title"].'：</strong></div><div class="lpssright">';
                        self::writeConditionContent($paramName,$options,$existOptions,$this->url,$conditions,'sc_id','sc_title');
                        echo "</div></dd>";
                    }elseif($this->sourceType==3){
                        echo '<dd class="leibie"><div class="lpssleft"><strong>'.$type["sc_title"].'：</strong></div><div class="lpssright">';
                        self::writeConditionContent($paramName,$options,$existOptions,$this->url,$conditions,'sc_id','sc_title');
                        echo "</div></dd>";
                    }
                }
            }
        }
    }
    /**
     * 输出自定义搜索条件信息
     * @param <array> $showIds 一共要显示的条件id集合
     * @param <type> $options 临时的条件
     * @param <type> $existOptions 已经保存的搜索条件
     */
    public function showDiySearch($showIds,$options,$existOptions){
        if(in_array(9,$showIds)){
            $action = array("site/searchmenu");
            echo "<div class='serachbox'>";
            $form=$this->beginWidget('CActiveForm', array(
                'action'=>$action,
                'method'=>'post',
                "id"=>"pageConditionSearch"
            ));
            //获取已有的搜索keyword
            $kwvalue = "";
            if(array_key_exists(self::$diyCondition,$existOptions) && $existOptions[self::$diyCondition]!=""){
                $kwvalue = urldecode($existOptions[self::$diyCondition]);
            }
            //判断是否使用自动完成
            if($this->autoCompleteData==0){//不使用自动完成
                 echo CHtml::textField(self::$diyCondition,$kwvalue,array('class'=>'text_bg'));
            }else{
                $this->widget('CAutoComplete',
                array(
                    'name'=>self::$diyCondition,
                    "value"=>$kwvalue,
                    'url'=>array('site/ajaxautocomplete'),
                    'max'=>10,//显示最大数
                    'minChars'=>1,//最小输入多少开始匹配
                    'delay'=>500, //两次按键间隔小于此值，则启动等待
                    'scrollHeight'=>200,
                    "width"=>305,
                    "extraParams"=>array("type"=>$this->autoCompleteData),//表示是楼盘、商业广场还是小区
                    'htmlOptions'=>array("class"=>"text_bg"),
                    "methodChain"=>".result(function(event,item){\$(\"#pageConditionSearch\").submit()})",//回调函数
                ));
            }
            echo "<input type='hidden' name='option' value='".self::$diyCondition."' />";
            echo "<input type='hidden' name='action' value='".$this->url."' />";
            echo '<input type="submit" class="submit_bg" value="" />';
            $this->endWidget();
            echo "</div>";
        }
    }
    /**
     * 输出一段搜索条件的html
     * @param <type> $paramName 该种条件的参数名称
     * @param <type> $options 临时搜索条件
     * @param <type> $existOptions 已经保存的其他搜索条件
     * @param <type> $url 链接的url
     * @param <type> $conditionArray 包含了该种条件的种类集合(不包括'不限')
     * @param <type> $attributeName 条件对象的属性名称
     * @param <type> $linkName 链接名称
     */
    public function writeConditionContent($paramName,$options,$existOptions,$url,$conditionArray,$attributeName,$linkName){
        if(array_key_exists($paramName,$existOptions) && $existOptions[$paramName]!=""){
            
            $options=self::dealOptions($existOptions,$paramName,"");
            echo CHtml::link("不限",Yii::app()->createUrl($url,$options),array("class"=>$this->sourceType==1?"srclk":""));
        }else{
            if($this->sourceType==1){
                echo '<a class="srclk">不限</a>';
            }elseif($this->sourceType==2){
                echo "<a class='red_white'>不限</a>";
            }elseif($this->sourceType==3){
                echo "<a class='red_white'>不限</a>";
            }
        }
        //选择栏
        $tmpExistOptions = array();
        if(array_key_exists($paramName, self::$inputSearch)){
            foreach($existOptions as $key=>$value){
                if($key!=self::$inputSearch[$paramName][0]&&$key!=self::$inputSearch[$paramName][1]){
                    $tmpExistOptions[$key] = $value;
                }
            }
        }else{
            $tmpExistOptions = $existOptions;
        }
        foreach($conditionArray as $condition){
            if($paramName=='section' && $linkName=='re_name'){//输出拼音首字母
                if($condition['re_order']){
                    if(!isset($re_order) || $re_order!=$condition['re_order'])
                        echo '<a class="red_white">'.chr($condition['re_order']).'</a> ';
                    $re_order=$condition['re_order'];
                }
            }
            if(array_key_exists($paramName,$tmpExistOptions) && $condition[$attributeName]==$tmpExistOptions[$paramName]){
                if($this->sourceType==1){
                    echo "<a class='srclick'>".CHtml::encode($condition[$linkName])."</a> ";
                }elseif($this->sourceType==2){
                    echo "<a class='red_white'>".CHtml::encode($condition[$linkName])."</a> ";
                }elseif($this->sourceType==3){
                    echo "<a class='red_white'>".CHtml::encode($condition[$linkName])."</a> ";
                }
            }else{
                $options=self::dealOptions($tmpExistOptions,$paramName,$condition[$attributeName]);
                $link = CHtml::link(CHtml::encode($condition[$linkName]),Yii::app()->createUrl($url,$options));
                echo $link." ";
            }
        }
        //输入框搜索
        $inputS = false;
        if(array_key_exists($paramName,self::$inputSearch)&&$this->inputSearchBoolean){
            Yii::app()->clientScript->registerScriptFile("/js/search.js");
            echo '<input type="text" value="'.@$existOptions[self::$inputSearch[$paramName][0]].'" class="txt_2" name="'.self::$inputSearch[$paramName][0].'" onblur="searchMenuInputCheck(this)" onfocus="searchShowInputButton(this)">';
            echo '<span class="heng">-</span>';
            echo '<input type="text" value="'.@$existOptions[self::$inputSearch[$paramName][1]].'" class="txt_2" name="'.self::$inputSearch[$paramName][1].'" onblur="searchMenuInputCheck(this)" onfocus="searchShowInputButton(this)">';

            $newArray = array();
            foreach($existOptions as $key=>$value){
                if($key!=$paramName&&$key!=self::$inputSearch[$paramName][0]&&$key!=self::$inputSearch[$paramName][1]&&$value){
                    $newArray[$key] = $value;
                }
            }
            $tmpoption = self::dealOptions($newArray);
            $tmpUrl = Yii::app()->createUrl($url,$tmpoption);
            if($newArray){
                $tmpUrl .= "-";
            }else{
                $tmpUrl .= "/";
            }
            $inputS = true;
        }
        if(array_key_exists($paramName,self::$units)){
            $class=$this->sourceType==1?"class='heng'":"";
            echo "<font ".$class." >".self::$units[$paramName]."</font>";
        }
        if($inputS){
            echo '<input type="button"  value="确定" style="float:left;display:none" onclick="searchMenuInput(this,\''.$tmpUrl.'\')">';
        }
    }
    /**
     * 返回一个条件类别去找合法的子类id
     * @param <int> $typeId
     * @return <array> max min
     */
    public static function getAllowIdsRange($typeId){
        if(array_key_exists($typeId, self::$menu2Ids)){
            $dbTypeId = self::$menu2Ids[$typeId];//得到数据库中对应的表的主键id
            $rangeArray = Searchcondition::model()->getIdsRangeByTypeId($dbTypeId);
            return $rangeArray;
        }else{
            return array();
        }
    }
}