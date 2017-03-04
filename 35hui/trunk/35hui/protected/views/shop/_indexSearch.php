<div id="searchOneTab">
    <!--写字楼出租-->
    <div class="inline">
        <em>租金：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(30);
        foreach($children as $key=>$child) {
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."元以下";
            }else{
                $name = $name."元";
            }
            echo "<a href='#' onclick='clickToSearch(\"rPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
        <a href="#" onClick="clickToSearch()">>></a>
    </div>
    <!--商铺出租-->
    <div class="inline" style="display: none">
        <em>租金：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(30);
        foreach($children as $key=>$child) {
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."元以下";
            }else{
                $name = $name."元";
            }
            echo "<a href='#' onclick='clickToSearch(\"rPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
        <a href="#" onClick="clickToSearch()">>></a>
    </div>
    <!--住宅出租-->
    <div class="inline" style="display: none">
        <em>租金：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(107);
        foreach($children as $key=>$child) {
            if($key>4){break;}
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."元以下";
            }else{
                $name = $name."元";
            }
            echo "<a href='#' onclick='clickToSearch(\"rrPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
    </div>
    <!--写字楼出售-->
    <div class="inline" style="display: none">
        <em>售价：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(20);
        foreach($children as $key=>$child) {
            if($key>5){break;}
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."万以下";
            }else{
                $name = $name."万";
            }
            echo "<a href='#' onclick='clickToSearch(\"sPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
        <a href="#" onClick="clickToSearch()">>></a>
    </div>
    <!--商铺出售-->
    <div class="inline" style="display: none">
        <em>售价：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(20);
        foreach($children as $key=>$child) {
            if($key>5){break;}
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."万以下";
            }else{
                $name = $name."万";
            }
            echo "<a href='#' onclick='clickToSearch(\"sPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
        <a href="#" onClick="clickToSearch()">>></a>
    </div>
    <!--住宅出售-->
    <div class="inline" style="display: none">
        <em>售价：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(20);
        foreach($children as $key=>$child) {
            if($key>5){break;}
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."万以下";
            }else{
                $name = $name."万";
            }
            echo "<a href='#' onclick='clickToSearch(\"sPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
        <a href="#" onClick="clickToSearch()">>></a>
    </div>
    <!--商铺转让-->
    <div class="inline" style="display: none">
        <em>租金：</em>
        <?php
        $children = Searchcondition::model()->findConditionsByType(30);
        foreach($children as $key=>$child) {
            $name = $child['sc_title'];
            if($key==0){
                $tmp = explode("以下", $name);
                $name = $tmp[0]."元以下";
            }else{
                $name = $name."元";
            }
            echo "<a href='#' onclick='clickToSearch(\"rPrice\",\"".$child["sc_id"]."\")'>".$name."</a>";
        }
        ?>
        <a href="#" onClick="clickToSearch()">>></a>
    </div>
</div>