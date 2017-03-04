var cookieName = danwei = listUrl = pkUrl = "";
jQuery.pk = {
    pkcheck_Init:function(cookieName,danwei,listUrl,pkUrl){
        this.cookieName = cookieName;
        this.danwei = danwei;
        this.listUrl = listUrl;//格式为/creativepark/tmp.html 。必须包含tmp
        this.pkUrl = pkUrl;
        
        this.bindPKCheckBox();//选择已经选择的选择框
        this.bindPKList()//显示浮动
    },
    pkcheck_onclick:function(obj, id, name, price){
        var jsonArray = this.getPKJsonArray();
        if ($(obj).attr("checked")) {
            if (jsonArray == null) {
                jsonArray = [];
            }
            if (jsonArray.length == 3) {
                alert("比较列表最多不能超过三项");
                $("#build_" + id).attr("checked", false);
                return;
            }

            var isFind = false;
            if (jsonArray.length > 0) {
                for (var i = 0; i < jsonArray.length; i++) {
                    if (jsonArray[i].ID == id) {
                        isFind = true;
                        break;
                    }
                }
            }
            if (!isFind) {
                jsonArray.push({
                    ID: id,
                    Name: name,
                    Price: price
                });
                this.addPKItem(id, name, price);
            }
        }else {//删除
            if (jsonArray != null) {
                for (var i = 0; i < jsonArray.length; i++) {
                    if (jsonArray[i].ID == id) {
                        jsonArray.splice(i, 1);
                        $("#tablePkList_" + id).remove();
                        break;
                    }
                }
            }
        }
        this.setPKListCookie(jsonArray);
    },
    addPKItem:function(id, name, price){
        var priceAnddanwei;
        var url = this.listUrl.replace("tmp",id);
        if(price!=0){
            priceAnddanwei = '<em>'+price+'</em>'+this.danwei;
        }else{
            priceAnddanwei = '暂无报价'
        }
        var pkData = '<table border="0" cellpadding="0" cellspacing="0" class="table_02" id="tablePkList_'+id+'">'+
        '<tr><td><a href="'+url+'" style="background:none; padding:0;" target="_blank">'+name+'</a><input type="hidden" name="buildId" value="'+id+'" /></td>'+
        '<td rowspan="2" align="right"><a href="javascript:void(0)" onclick="removePKItem(this)" >删除</a></td></tr><tr>'+
        '<td>'+priceAnddanwei+'</td></tr></table>';
        $('.pk .pkmcont').append(pkData);
    },
    removePKItem:function(obj) {
        var id = $(obj).closest('table').find("input[name='buildId']").val();
        $("#tablePkList_" + id).remove();
        $("#build_" + id).attr("checked", false);
        var jsonArray = this.getPKJsonArray();
        if (jsonArray != null) {
            for (var i = 0; i<jsonArray.length; i++) {
                if (jsonArray[i].ID == id) {
                    jsonArray.splice(i, 1);
                    break;
                }
            }
        }
        this.setPKListCookie(jsonArray);
    },
    removeAllPKItem:function(){
        var jsonArray = this.getPKJsonArray();
        if (jsonArray != null) {
            for (var i = 0; i<jsonArray.length; i++) {
                var id = jsonArray[i].ID;
                $("#tablePkList_" + id).remove();
                $("#build_" + id).attr("checked", false);
            }
        }
        this.setPKListCookie([]);
    },
    bindPKList:function() {
        var jsonArray = this.getPKJsonArray();
        if (jsonArray != null && jsonArray.length > 0) {
            $(".pk").css("display","");
            for (var i = 0; i < jsonArray.length; i++) {
                this.addPKItem(jsonArray[i].ID, jsonArray[i].Name, jsonArray[i].Price, this.cookieName);
            }
        }
    },
    bindPKCheckBox:function() {//绑定PK的复选框
        var jsonArray = this.getPKJsonArray();
        if (jsonArray != null && jsonArray.length > 0) {
            for (var i = 0; i < jsonArray.length; i++) {
                $("#build_" + jsonArray[i].ID).attr("checked", true);
            }
        }
    },
    getPKJsonArray:function () {
        var jsonArray = new Array;
        if (this.getCookie(this.cookieName) != null && this.getCookie(this.cookieName) != "") {
            var strPKList = unescape(this.getCookie(this.cookieName));
            jsonArray = $.parseJSON('[' + strPKList.substr(0, strPKList.length - 1) + ']');
        }
        return jsonArray;
    },
    setPKListCookie:function(jsonArray) {
        var strJson = "";
        if (jsonArray != null && jsonArray.length > 0) {
            for (var i = 0; i < jsonArray.length; i++) {
                strJson = strJson + '{"ID":' + jsonArray[i].ID + ',"Name":"' + jsonArray[i].Name + '","Price":"' + jsonArray[i].Price + '"},';
            }
            this.setCookie(this.cookieName, strJson);
            $(".pk").css("display","block");
        }
        else {
            this.setCookie(this.cookieName, "");
            //隐藏比较栏
            $(".pk").css("display","none");
        }
    },
    setCookie:function(objName,objValue){//添加cookie
        var str = objName + "=" + escape(objValue);
        document.cookie = str;
    },
    getCookie:function(key){//获取指定名称的cookie的值
        var arr = document.cookie.match(new RegExp("(^| )" + key + "=([^;]*)(;|$)"));
        if (arr != null) {
            return unescape(arr[2]);
        } else {
            return null;
        }
    },
    gotoPkNow:function(){
        var pkids = [];
        var jsonArray = this.getPKJsonArray();
        if (jsonArray != null) {
            for (var i = 0; i<jsonArray.length; i++) {
                pkids.push(jsonArray[i].ID);
            }
        }
        var len = pkids.length;
        if(len<2){
            alert("至少要两个楼盘才能比较比较");
            return false;
        }
        window.open(this.pkUrl+'?pk='+pkids.join("|"));
        return true;
    }
}
function removePKItem(obj){
    $.pk.removePKItem(obj);
}





