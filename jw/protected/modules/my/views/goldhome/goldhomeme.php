<div class="mright">
    <div class="zftnav">
        <ul>
            <li onclick="window.location.href='/my/goldhome/index'" style="cursor: pointer">我的金屋</li>
            <li class="clk" onclick="window.location.href='/my/goldhome/goldhomeme'" style="cursor: pointer">谁收藏了我</li>
        </ul>
    </div>
    <div class="jbmain">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_goldhomemeview',
                'summaryText'=>"",
                'cssFile'=>"/css/pager.css"
        )); ?>
    </div>
</div>