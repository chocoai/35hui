var cur_index=1
var num=4 //该值记录标签的个数
var settime
function GetObj(objName){
    if(document.getElementById){
        return eval('document.getElementById("' + objName + '")');
    }else if(document.layers){
        return eval("document.layers['" + objName +"']");
    }else{
        return eval('document.all.' + objName);
    }
}
function change_Menu(index){
    for(var i=1;i<=num;i++){
        if(GetObj("con"+i)&&GetObj("m"+i)){
            GetObj("con"+i).style.display = 'none';
            GetObj("m"+i).className = "menu"+i+"Off";
        }
    }
    if(GetObj("con"+index)&&GetObj("m"+index)){
        GetObj("con"+index).style.display = 'block';
        GetObj("m"+index).className = "menu"+index+"On";
    }
    cur_index=index
    if(cur_index<num){
        cur_index++
    }
    else{
        cur_index=1
    }
    settime=setTimeout("change_Menu(cur_index)",8000)//设置延迟时间

}
function Menu(c_index){
    clearTimeout(settime)
    change_Menu(c_index)
}