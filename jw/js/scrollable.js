$scrollable = {
    bindEvt : function() {
        var o = {};
        o.move_left_btn = $("#move_left");
        if (o.move_left_btn.length > 0) {
            o.move_left_btn.bind("click", function() {
                $scrollable.scrollLveSell('right');
            });
        }
        o.move_right_btn = $("#move_right");
        if (o.move_right_btn.length > 0) {
            o.move_right_btn.bind("click", function() {
                $scrollable.scrollLveSell('left');
            });
        }
    },
    scrollLveSell : function(o) {
        if (this.cfg.lv_flag == 0){
            return false;
        }
        var tar = $("#allalbumlist");
        tar.stop();
        var max_num = $("#allalbumlist>div").length;
//        alert(max_num)
        var width = 800;
        var left = 0;
        var pos = tar.position();
//        alert(pos.left + "|" + width);
        if (o == "left") {
            if (Math.abs(pos.left)+width >= width*(Math.ceil(max_num/5))) {
                left = 0;
            }else{
                left = pos.left - width;
            }
        } else if (o == "right") {
            if (pos.left >= 0) {
                return false;
            }
            left = pos.left + width;
        }
        left = left + "px";
        $scrollable.cfg.lv_flag = 0;
        tar.animate({
            left: left
        }, 600, function() {
            $scrollable.cfg.lv_flag = 1;
        });
    },
    cfg : {

    },
    init : function() {
        this.bindEvt();
    }
};
jQuery(function($) {
    $scrollable.init();
});