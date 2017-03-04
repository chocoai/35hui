<div class="jbnav">
    <p class="jbbg<?php echo $this->action->id=='memberbase'?' clk':''?>"><a href="<?php echo $this->createUrl('memberbase') ?>">基本资料</a></p>
    <p class="jbbg<?php echo $this->action->id=='memberjob'?' clk':''?>"><a href="<?php echo $this->createUrl('memberjob') ?>">工作信息</a></p>
    <p class="jbbg<?php echo $this->action->id=='password'?' clk':''?>"><a href="<?php echo $this->createUrl('password') ?>">重置密码</a></p>
    <p class="jbbg<?php echo $this->action->id=='photo'?' clk':''?>"><a href="<?php echo $this->createUrl('photo') ?>">修改头像</a></p>
</div>