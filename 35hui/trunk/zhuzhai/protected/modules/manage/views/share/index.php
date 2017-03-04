<?php
$this->breadcrumbs=array(
    '经纪人合作',
);
?>
<?php if(Yii::app()->user->hasFlash('contact')){ ?>

<div class="msg">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php }else{ ?>
<div class="msg">
    经纪人合作模块为广大经纪人提供一个房源合作的平台，愿意共享房源或者共享客户的经纪人能够在该模块处寻求合作机会，
        请发布诚心合作的信息。发布在该处的求房源与求客户信息，我们认为是开放的，是诚心求合作的，因此会有经纪人的来电，
        请友好相待，预祝广大经纪人合作愉快！
</div>
<?php } ?>
<div class="htguanl">
    <ul>
        <li class="<?php if(isset($tag)&&$tag=='gp')echo"clk"; ?>"><a href="<?php echo $this->createUrl('/manage/share/index',array('tag'=>'gp','sourceType'=>$sourceType))?>"><strong>求房源</strong></a></li>
        <li class="<?php if(isset($tag)&&$tag=='gc')echo"clk"; ?>"><a href="<?php echo $this->createUrl('/manage/share/index',array('tag'=>'gc','sourceType'=>$sourceType))?>"><strong>求客户</strong></a></li>
    </ul>
</div>
<div class="thline">
    <form action="<?php echo $this->createUrl('/manage/share/index')?>" method="POST">
        <select class="sslect" name="sourceType" onchange="this.form.submit()">
        <option value="1"<?php echo $sourceType =='1' ? ' selected' : '';?>>写字楼</option>
        <option value="2"<?php echo $sourceType =='2' ? ' selected' : '';?>>商　铺</option>
        <option value="3"<?php echo $sourceType =='3' ? ' selected' : '';?>>住　宅</option>
    </select>
    <?php echo CHtml::dropDownList('rentsell',$rentsell,array('1'=>'出　租','2'=>'出　售'),array('empty'=>'=租售=','class'=>'sslect')) ?>
    <?php echo CHtml::dropDownList('region',$region,$districts,array('empty'=>'=选择区域=','class'=>'sslect')) ?>
    关键字：<input class="txt_04" type="text" name="kwd" value="<?php echo $kwd;?>"/>
    <input type="hidden" name="tag" value="<?php echo $tag?>">
    <input class="btn_01" type="submit" value="搜索"/> <input type="checkbox" onclick="this.form.submit()" name="self"<?php echo $self?' checked':'' ?> id="onlymyself" /><label for="onlymyself">只看自己</label>
    </form>
</div>

<!-- date list -->
<div id="manbrightChild1" class="rgcont">
    <table border="0" cellpadding="0" cellspacing="0" class="table_01">
        <tr>
            <?php if($tag=='gp') {?><td class="ftit">区域</td><td class="ftit">租售</td><td class="ftit">面积</td><td class="ftit">预算</td>
            <td class="ftit">意向楼盘</td><td class="ftit">经纪人</td><td class="ftit">联系方式</td><td class="ftit">发布时间</td><?php
            }else{?>
            <td class="ftit">区域</td><td class="ftit">租售</td><td class="ftit">楼盘名称</td><td class="ftit">楼层</td><td class="ftit">朝向</td>
            <td class="ftit">面积</td><td class="ftit">价格</td><td class="ftit">经纪人</td><td class="ftit">联系方式</td><td class="ftit">发布时间</td>
            <?php } ?>
        </tr>
        <?php
        foreach($dataProvider->getData() as $data){
            $this->renderPartial('_'.$tag, array(
                'data'=>$data,
                'districts'=>$districts,
                'self'=>$self,
                'tag'=>$tag,
                'sourceType'=>$sourceType,
                )
            );
        }
        ?>
    </table>
</div>
<div class="jefenpage">
    <?php
        $this->widget('CLinkPager',array(
        'pages'=>$dataProvider->pagination,
        "htmlOptions"=>array("style"=>"float:right"),
        ));
    ?>
</div>
<!-- date list -->
<div class="htit">
    <a href="javascript:;"><strong><?php echo $tag=='gp'?'有客户求房源':'有房源求客户' ?></strong></a>
</div>

<div class="rgcont">
    <form action="<?php echo $this->createUrl('/manage/share/release')?>" id="release-form" method="POST">
        <table cellspacing="0" cellpadding="0" border="0" class="table_01">
            <tr>
                <td width="16%" class="tit"></td>
                <td width="84%" class="txtlou">
                   <select name="sourceType">
                        <option value="1"<?php echo $sourceType =='1' ? ' selected' : '';?>>写字楼</option>
                        <option value="2"<?php echo $sourceType =='2' ? ' selected' : '';?>>商　铺</option>
                        <option value="3"<?php echo $sourceType =='3' ? ' selected' : '';?>>住　宅</option>
                    </select>
                    <span>区　　域：</span><?php echo CHtml::dropDownList('region',$region,$districts,array('class'=>"slet_01 sslect")) ?>
                    <?php echo CHtml::dropDownList('rentsell',$rentsell,array('1'=>'出租','2'=>'出售'),array('class'=>"slet_01 sslect")) ?>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> <?php echo $tag=='gc'?'楼盘名称':'意向楼盘'?>：</td>
                <td width="84%" class="txtlou">
                    <input type="text" name="buildname" maxlength="30" />
                    <span><?php echo $tag=='gc'?'请填写房源所在的楼盘或者小区名称':'请填写客户意向的楼盘、小区或者地址'?></span>
                </td>
            </tr>
        <?php
        if($tag=='gc'){
        ?>
            <tr>
                <td width="16%" class="tit"><em>*</em> 楼　　层：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::textField('floor','',array('size'=>4,'maxlength'=>3)) ?>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 面　　积：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::textField('area','',array('size'=>5,'maxlength'=>4)) ?>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 价　　格：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::textField('price','',array('size'=>8,'maxlength'=>8)) ?> <span>请填写单价或者总价(单位:元)</span>
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 朝　　向：</td>
                <td width="84%" class="txtlou">
                    <?php echo CHtml::dropDownList('toward','',$this->towards) ?>
                </td>
            </tr>
        <?php }else{ ?>
            <tr>
                <td width="16%" class="tit"><em>*</em> 面　　积：</td>
                <td width="84%" class="txtlou">
                    <input type="text" size="5" maxlength="4" name="area1" /> 到 <input type="text" size="5" maxlength="4" name="area2" />
                </td>
            </tr>
            <tr>
                <td width="16%" class="tit"><em>*</em> 预　　算：</td>
                <td width="84%" class="txtlou">
                    <input type="text" size="5" maxlength="4" name="price1" /> 到 <input type="text" size="5" maxlength="4" name="price2" />
                </td>
            </tr>
        <?php } ?>
            <tr>
                <td width="16%" class="tit"><em>*</em> 联系方式：</td>
                <td width="84%" class="txtlou">
                    <input type="text" maxlength="15" name="contack" /> <span>请填写手机或座机号码</span>
                </td>
            </tr>
            <tr>
                <td width="16%"></td>
                <td width="84%" class="txtlou">
                    <input type="hidden" name="tag" value="<?php echo $tag?>">
                    <input type="button" value="发 布" onclick="return checkForm(this.form)"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<script type="text/javascript" language="javascript">
    function checkForm(F){
        var regint=/^[1-9]\d*$/;
        var regFloat=/^[1-9]\d*(\.[1-9])?$/;
        if(!$.trim(F.buildname.value)){
            alert("请填写一个楼盘名称");
            F.buildname.focus();
            return false;
        }
<?php if($tag=='gc'){?>
        var floor=F.floor.value;
        if(!floor){
            alert("楼层不能为空");
            F.floor.focus();
            return false;
        }else if(!regint.test($.trim(floor))){
            alert("请填写一个大于0整数的楼层");
            F.floor.focus();
            return false;
        }
        var area=F.area.value;
        if(!area){
            alert("面积不能为空");
            F.area.focus();
            return false;
        }else if(!regint.test($.trim(area))){
            alert("请填写一个大于0整数的面积");
            F.area.focus();
            return false;
        }
        var price=F.price.value;
        if(!price){
            alert("价格不能为空");
            F.price.focus();
            return false;
        }else if(!regFloat.test($.trim(price))){
            alert("价格请填写一个数字可保留一位小数");
            F.price.focus();
            return false;
        }

<?php }else{ ?>
        var area1=F.area1.value;
        var area2=$.trim(F.area2.value);
        if(!area1){
            alert("面积不能为空");
            F.area1.focus();
            return false;
        }else if(!regint.test($.trim(area1))){
            alert("请填写一个大于0整数的面积");
            F.area1.focus();
            return false;
        }
        if(area2){
            if(!regint.test(area2)){
                alert("请填写一个大于0整数的面积");
                F.area2.focus();
                return false;
            }
            area1=$.trim(area1);
            if(area1>area2){
                alert("第二个面积需要大于第一个面积");
                F.area2.focus();
                return false;
            }
        }

        var price1=F.price1.value;
        var price2=$.trim(F.price2.value);
        if(!price1){
            alert("价格不能为空");
            F.price1.focus();
            return false;
        }else if(!regFloat.test($.trim(price1))){
            alert("价格请填写一个数字可保留一位小数");
            F.price1.focus();
            return false;
        }
        if(price2){
            if(!regFloat.test(price2)){
                alert("价格请填写一个数字可保留一位小数");
                F.price2.focus();
                return false;
            }
            price1=$.trim(price1);
            if(price1>price2){
                alert("第二个价格需要大于第一个价格");
                F.price2.focus();
                return false;
            }
        }
<?php } ?>
        var contack=F.contack.value;
        if(!contack){
            alert("联系方式不能为空");
            F.contack.focus();
            return false;
        }else{
            contack=$.trim(contack);
            if( !(/^1\d{10}$/.test(contack) || /^(\d{3,4}-)?\d{7,8}$/.test(contack)) ){
                alert("请填写手机或座机号码\n格式：13512345678或者021-68880132");
                F.contack.focus();
                return false;
            }
        }
        F.submit();
    }
</script>
