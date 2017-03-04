var magicDivRunTask;
var magicDivContent;
var magicDivNWidth;
var magicDivNHeight;
var magicDivCover;
var magicDivOpenStart = function(id, mWidth, mHeight, x, y){
	if(!magicDivCover){
		magicDivCover = document.createElement("div");
		magicDivCover.style.position = "absolute";
		magicDivCover.style.zIndex = "10";
		magicDivCover.style.left = "0";
		magicDivCover.style.top = "0";
		magicDivCover.style.backgroundColor = "#000000";
		magicDivCover.style.opacity = "0.5";
		magicDivCover.style.filter = "alpha(opacity=50)";
	}
	if(magicDivRunTask){
		window.clearInterval(magicDivRunTask);
	}
	var myDiv = document.getElementById(id);
	if(myDiv && myDiv.style.display == "none"){
		magicDivCover.style.width = document.documentElement.clientWidth + "px";
		magicDivCover.style.height = document.documentElement.clientHeight + "px";
//		document.body.appendChild(magicDivCover);
		magicDivContent = myDiv.innerHTML;
		myDiv.innerHTML = "";
		myDiv.style.position = "absolute";
		myDiv.style.zIndex = "11";
		if(x || x === 0){
			myDiv.style.left = (x-5+document.body.scrollLeft)+"px";
		}else{
			myDiv.style.left = Math.ceil((document.body.clientWidth-10)/2 + document.body.scrollLeft)+"px";
		}
		if(y || y === 0){
			myDiv.style.top = (y-5+document.body.scrollTop)+"px";
		}else{
			myDiv.style.top = Math.ceil((document.body.clientHeight-10)/2 + document.body.scrollTop)+"px";
		}
		myDiv.style.width = "0";
		myDiv.style.height = "0";
		myDiv.style.display = "";
		magicDivNWidth = 0;
		magicDivNHeight = 0;
		magicDivRunTask = window.setInterval("magicDivOpenDiv('" + id + "', " + mWidth + ", " + mHeight + ", " + x + ", " + y + ")", 10);
	}else{
//		document.body.removeChild(magicDivCover);
		myDiv.style.display = "none";
	}
	
	return false;
}
var magicDivOpenDiv = function(id, mWidth, mHeight, x, y){
	myDiv = document.getElementById(id);
	if(magicDivNWidth >= (mWidth - 50)){
		magicDivNWidth = magicDivNWidth + 4;
	}else{
		magicDivNWidth = magicDivNWidth + 50;
	}
	if(magicDivNHeight >= (mHeight - 50)){
		magicDivNHeight = magicDivNHeight + 4;
	}else{
		magicDivNHeight = magicDivNHeight + 50;
	}
	
	if((mWidth > magicDivNWidth) || (mHeight > magicDivNHeight)) {
		if(mWidth > magicDivNWidth){
			myDiv.style.width = magicDivNWidth + "px";
			if(x || x === 0){
				myDiv.style.left = Math.ceil(x - magicDivNWidth / 2 + document.body.scrollLeft) + "px";
			}else{
				myDiv.style.left = Math.ceil((document.body.clientWidth - magicDivNWidth) / 2 + document.body.scrollLeft) + "px";
			}
		}
		if(mHeight > magicDivNHeight){
			myDiv.style.height = magicDivNHeight + "px";
			if(y || y === 0){
				myDiv.style.top = Math.ceil(y - magicDivNHeight / 2 + document.body.scrollTop) + "px";
			}else{
				myDiv.style.top = Math.ceil((document.body.clientHeight - magicDivNHeight) / 2 + document.body.scrollTop) + "px";
			}
		}
	}else if(magicDivRunTask){
		window.clearInterval(magicDivRunTask);
		myDiv.innerHTML = magicDivContent;
	}

	return false;
}