<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/global.css" />
<div class="container">
    <?=$this->renderPartial('_leftMenu');?>
    <div class="right">
        <div class="rtitle">
          <div class="rtitlefont">付币服务</div>
          <div class="company">
            <h2>详细说明</h2>
            <?=CHtml::image(IMAGE_URL."/help/charge.gif","",array("width"=>"700px"))?>
            <div class="detail">
                <ul>

                    <li>1、 我购买的位置：点击查看此用户已经购买的所有位置。</li>

                    <li>2、 页面：位置所处的页面。</li>

                    <li>3、 模块：位置所处的模块。</li>

                    <li>4、 查看购买详细：点击显示所有购买信息。</li>

                    <li>5、 查看显示位置：点击查看此模块在页面中的位置。</li>

                    <li>6、 位置：在模块中的排序状态。</li>

                    <li>7、 基本价格：此位置购买的最低价。</li>

                    <li>8、 当前价格：购买此位置现在需要花费的价格。</li>

                    <li>9、 价格保护：在此时间内，购买的位置将不会被别人抢购。</li>

                    <li>10、 可抢购时间：此位置可以抢购的时间。</li>

                    <li>11、 天数：购买此位置可选的购买天数。</li>

                    <li>12、 合计：购买总共需要花费的新币。</li>

                    <li>13、 操作：用户的购买操作。</li>

            </ul>
                <br />
                <font style="margin-left: 25px;color: red"><?=CHtml::image(IMAGE_URL."/default/hint.gif")?>注：如果用户已经购买了某一个位置，之后被别的用户抢购，则会返回相应新币。</font>
			</div>

          </div>
        </div>
    </div>
	<div style="clear:both"><!--自适应高度需要本层--></div>
  </div>