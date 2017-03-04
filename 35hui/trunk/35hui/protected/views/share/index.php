<?php
$this->temp=isset($_GET['menu'])?trim($_GET['menu']):'';

$this->breadcrumbs=array(
    "我的新地标"=>array('/site/userindex'),
    '经纪人合作',
);
?>
<div class="manage_rightthreeine"></div>
<div class="manage_rightfoutbox" style="padding: 0px 8px 0px;overflow: hidden;" >
    <p>经纪人合作模块为广大经纪人提供一个房源合作的平台，愿意共享房源或者共享客户的经纪人能够在该模块处寻求合作机会，
        请发布诚心合作的信息。发布在该处的求房源与求客户信息，我们认为是开放的，是诚心求合作的，因此会有经纪人的来电，
        请友好相待，预祝广大经纪人合作愉快！</p>
</div>
<div class="manage_rightfourine"></div>
<div class="manage_rightulone">
    <ul class="clearfix" style="float:left;margin-top: 0px">
        <li class="<?php if(isset($tag)&&$tag=='gp')echo"manage_rightover";else echo "manage_rightout"; ?>"><a href="<?php echo $this->createUrl('share/index',array('tag'=>'gp','sourceType'=>$sourceType))?>"><strong>求房源</strong></a></li>
        <li class="<?php if(isset($tag)&&$tag=='gc')echo"manage_rightover";else echo "manage_rightout"; ?>"><a href="<?php echo $this->createUrl('share/index',array('tag'=>'gc','sourceType'=>$sourceType))?>"><strong>求客户</strong></a></li>
    </ul>
</div>
<div class="manage_rightsearch">
    <form action="<?php echo $this->createUrl('share/index')?>" method="POST">
        <select name="sourceType" onchange="this.form.submit()">
        <option value="1"<?php echo $sourceType =='1' ? ' selected' : '';?>>写字楼</option>
        <option value="2"<?php echo $sourceType =='2' ? ' selected' : '';?>>商　铺</option>
        <option value="3"<?php echo $sourceType =='3' ? ' selected' : '';?>>住　宅</option>
    </select>
    <?php echo CHtml::dropDownList('rentsell',$rentsell,array('1'=>'出　租','2'=>'出　售'),array('empty'=>'=租售=')) ?>
    <?php echo CHtml::dropDownList('region',$region,$districts,array('empty'=>'=选择区域=')) ?>
    关键字：<input type="text" name="kwd" value="<?php echo $kwd;?>"/>
    <input type="hidden" name="tag" value="<?php echo $tag?>">
    <input type="submit" value="搜索"/> <input type="checkbox" onclick="this.form.submit()" name="self"<?php echo $self?' checked':'' ?> id="onlymyself" /><label for="onlymyself">只看自己</label>
    </form>
</div>
<hr style="margin: 0;padding: 0" />
<?php if(Yii::app()->user->hasFlash('contact')){ ?>

<div style=" color: red">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php } ?>
<!-- date list -->
<div id="manbrightChild1" class="nohidden">
    <table class="manage_table" style="padding: 0px;margin: 0px;position: relative">
        <tr>
            <?php if($tag=='gp') {?><th>区域</th><th>租售</th><th>面积</th><th>预算</th><th>意向楼盘</th><th>经纪人</th><th>联系方式</th><th>发布时间</th><?php
            }else{?>
            <th>区域</th><th>租售</th><th>楼盘名称</th><th>楼层</th><th>朝向</th><th>面积</th><th>价格</th><th>经纪人</th><th>联系方式</th><th>发布时间</th>
            <?php } ?>
        </tr>
        <?php $this->renderPartial('_'.$tag,array(
            'dataProvider'=>$dataProvider,
            'districts'=>$districts,
            'self'=>$self,
            'tag'=>$tag,
            'sourceType'=>$sourceType,
            ));?>
    </table>
<?php
if($dataProvider->getTotalItemCount()){
?>
<div class="pager">
    <?php
    $pages=new CPagination($dataProvider->getTotalItemCount());
    $pages->pageSize=$dataProvider->pagination->pageSize;
    $this->widget('CLinkPager',array('pages'=>$pages));
    ?>
</div>
<?php } ?>

</div>
<!-- date list -->
<div class="manage_rightulone">
    <ul class="clearfix" style="float:left;margin-top: 0px">
        <li class="manage_rightover"><a href="javascript:;"><strong><?php echo $tag=='gp'?'有客户求房源':'有房源求客户' ?></strong></a></li>
    </ul>
</div>

<div class="manage_rightsearch">
    <form action="<?php echo $this->createUrl('share/release')?>" id="release-form" method="POST">
        <select name="sourceType">
        <option value="1"<?php echo $sourceType =='1' ? ' selected' : '';?>>写字楼</option>
        <option value="2"<?php echo $sourceType =='2' ? ' selected' : '';?>>商　铺</option>
        <option value="3"<?php echo $sourceType =='3' ? ' selected' : '';?>>住　宅</option>
    </select>
    <span>区　　域：</span><?php echo CHtml::dropDownList('region',$region,$districts) ?>
    <?php echo CHtml::dropDownList('rentsell',$rentsell,array('1'=>'出租','2'=>'出售')) ?><br />
    <i style="color:red">*</i> <span><?php echo $tag=='gc'?'楼盘名称':'意向楼盘'?>：</span><input type="text" name="buildname" maxlength="30" />
    <span><?php echo $tag=='gc'?'请填写房源所在的楼盘或者小区名称':'请填写客户意向的楼盘、小区或者地址'?></span>
    <br />
<?php
if($tag=='gc'){
                echo '<i style="color:red">*</i> <span>楼　　层：</span>',CHtml::textField('floor','',array('size'=>4,'maxlength'=>3)),'<br />';
                echo '<i style="color:red">*</i> <span>面　　积：</span>',CHtml::textField('area','',array('size'=>5,'maxlength'=>4)),'<br />';
                echo '<i style="color:red">*</i> <span>价　　格：</span>',CHtml::textField('price','',array('size'=>8,'maxlength'=>8)),
                        '<span>请填写单价或者总价(单位:元)</span><br />';
                echo '　<span>朝　　向：</span>',CHtml::dropDownList('toward','',$this->towards),'<br />';
}else{ ?>
    <i style="color:red">*</i> <span>面　　积：</span><input type="text" size="5" maxlength="4" name="area1" />到<input type="text" size="5" maxlength="4" name="area2" />
    <br />
    <i style="color:red">*</i> <span>预　　算：</span><input type="text" size="5" maxlength="4" name="price1" />到<input type="text" size="5" maxlength="4" name="price2" />
    <br />
<?php } ?>
    <i style="color:red">*</i> <span>联系方式：</span><input type="text" maxlength="15" name="contack" />
    <input type="hidden" name="tag" value="<?php echo $tag?>">
    <br /><input type="button" value="发布" onclick="return checkForm(this.form)"/>
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
