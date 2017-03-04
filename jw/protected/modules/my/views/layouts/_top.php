<div class="top">
    <div class="top_m">
        <div class="lf_top">
            <a href="<?=Yii::app()->createUrl("/site/home");?>" class="active">首页</a>|<a href="<?=Yii::app()->createUrl("/member/list");?>">展示</a>
        </div>
        <div class="rt_top">
            <ul>
                <?php
                if(Yii::app()->user->isGuest) {
                    echo '<li><a href="/site/index">登录</a></li>';
                    echo '<li><a href="/user/register">注册</a></li>';
                }else {
                    $userId = User::model()->getId();
                    $userModel = User::model()->getUserInfoById($userId);
                    echo '<li><a href="/user/logout">退出</a></li>';
                    echo '<li><a class="active" href="/my">'.$userModel->u_nickname.'</a></li>';
                }
                ?>
            </ul>
        </div>

        <div class="mid_top"><div class="searbg nav_sp1"></div><input type="text" value="输入" class="seartxt"><input type="button" class="sear"></div>
    </div>
</div>