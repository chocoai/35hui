/**
  *复制地址
  */
function copyText(){
	if (navigator.userAgent.indexOf("MSIE") == -1)
	{
		alert("您的浏览器不支持此功能,请手工复制文本框中内容");
		return false;
	}else{
		var url = window.location.href;
		var clipBoardContent = "";
		clipBoardContent += url;
		window.clipboardData.setData("Text",clipBoardContent);
		alert("地址已复制成功！");
	}
}