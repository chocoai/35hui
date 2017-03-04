<?php
$uagentPost = Post::model()->getAllPostByRole(Post::agent);
?>
<ul>
    <li class="one">
        <div style="overflow: hidden; line-height: 36px; height: 36px; float: left">
            <div id="marqueebox" align="center">
                <table border="0"cellspacing="0" cellpadding="0">
                <?php
                    if(!empty($uagentPost)){
                        foreach($uagentPost as $value){
                        ?>
                        <tr>
                            <td><?=CHtml::link(CHtml::encode($value->post_content),array('viewuagent/showPost','menu'=>'2_10'),array('style'=>'color:white'));?></td>
                        </tr>
                        <?php
                        }
                    }
                ?>
                </table>
            </div>
        </div>
    </li>
</ul>

<script type="text/javascript">
function startmarquee(lh,speed,delay) {
    var p=false;
    var t;
    var o=document.getElementById("marqueebox");
    if(!o)return;
    o.innerHTML+=o.innerHTML;
    o.style.marginTop=0;
    o.onmouseover=function(){p=true;}
    o.onmouseout=function(){p=false;}

    function start(){
        t=setInterval(scrolling,speed);
        if(!p) o.style.marginTop=parseInt(o.style.marginTop)-1+"px";
    }

    function scrolling(){
        if(parseInt(o.style.marginTop)%lh!=0){
            o.style.marginTop=parseInt(o.style.marginTop)-1+"px";
            if(Math.abs(parseInt(o.style.marginTop))>=o.scrollHeight/2) o.style.marginTop=0;
        }else{
            clearInterval(t);
            setTimeout(start,delay);
        }
    }
    setTimeout(start,delay);
}
startmarquee(36,20,5000);
</script>