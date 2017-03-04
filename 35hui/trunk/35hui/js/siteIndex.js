$("#fm").mouseover(function(){
        $("#mMenu").show();
        $("#mMenu").attr("class","sct_cont");
    }).mouseout(function(){
        $("#mMenu").hide();
    });
    function ChangeHtml(obj,value){
        $("#mCon").children("span").html($(obj).children("a").html());
        $("#mMenu").hide();
        $("#form_type").val(value);
    }
    function ChangeSelect(value){
        $("#searchbar #zs span").children("a").attr("class","");
        $("#searchbar #zs span").eq(parseInt(value)-1).children("a").attr("class","clk_sear");
        $("#form_sellorrent").val(value);
    }
    function AutoCompleteExtraParam(){
        var type = $("#form_type").val();
        return type;
    }
    function submit_button(){
        $("#headSearchForm").submit();
    }
    function changeClassName(obj){
        $("#divType ul").children("li").attr("class","");
        obj.className="index_bg clkli";
    }

    $("#newsurvey").overlay({
        top:'center',
        mask: {
            color: '#111111',
            loadSpeed: 200,
            opacity: 0.5
        },
        closeOnClick: false
    });
    $("#newsubscribe").overlay({
        top:'center',
        mask: {
            color: '#111111',
            loadSpeed: 200,
            opacity: 0.5
        },
        closeOnClick: false
    });

    function closetip(){
        window.location.reload();
    }
    function addFavorite(sURL, sTitle){
        try{
            window.external.addFavorite(sURL, sTitle);
        } catch (e){
            try{
                window.sidebar.addPanel(sTitle, sURL, "");
            }catch (e){
                alert("加入收藏失败，有劳您手动添加。");
            }
        }
    }

    function openDivSubscribe(type,typeId,purl,imgurl) {
        var url = purl+"/type/"+type+"/typeId/"+typeId;
        var html = '<div><div style="float:right; margin-top:10px; margin-right:10px;"><img onClick="closetip()" src="'+imgurl+'/3.gif"/></div>' +
            "   <iframe frameborder=0 src=\""+url+"\" width='450px' height='230px'/>" +
            "</div>";
        $('#newsubscribe').html(html);
        $("#newsubscribe").overlay().load();
    }
    function openDivSurvey(purl) {
        var html = '<div><div style="float:right;margin-top:10px; margin-right:10px;"><img onClick="closetip()" src="/images/3.gif"/></div>' +
            "   <iframe frameborder=0 src=\""+purl+"\" width='450px' height='300px'/>" +
            "</div>";
        $('#newsurvey').html(html);
        $("#newsurvey").overlay().load();
    }