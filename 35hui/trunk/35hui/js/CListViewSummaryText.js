/**
*设置分页的条数
*/
$(document).ready(function(){
    var summanyText = $(".hideclass").children().html();
    var setDomId = $(".hideclass").children().attr("setDomId");
    $("#"+setDomId).html(summanyText);
});