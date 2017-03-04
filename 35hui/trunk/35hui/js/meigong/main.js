
function turnit(o){
	 document.getElementById("right"+o).className="main_menuone";//newsearchinsider
	 document.getElementById("rightChild"+o).className="nohidden";
	 var j;
	 var g;
	 var id;
	 var e;
	 var f;
	 for(var i=1;i<=4;i++){
	   j = document.getElementById("right"+i);
	   //alert(o.id);
	   e = document.getElementById("rightChild"+i);
	   if(o != i){
	   	 j.className="main_menutwo";//newsearchinsidew
	   	 e.className="hidden";
	   }	   
	 }		 
}


function bturnit(o){
	 document.getElementById("bright"+o).className="one";//newsearchinsider
	 document.getElementById("brightChild"+o).className="nohidden";
	 var j;
	 var g;
	 var id;
	 var e;
	 var f;
	 for(var i=1;i<=5;i++){
	   j = document.getElementById("bright"+i);
	   //alert(o.id);
	   e = document.getElementById("brightChild"+i);
	   if(o != i && j != null){
	   	 j.className="two";//newsearchinsidew
	   	 e.className="hidden";
	   }	   
	 }		 
}

function loubturnit(o){
	 document.getElementById("loubright"+o).className="one";//newsearchinsider
	 document.getElementById("loubrightChild"+o).className="loupan_onelinemiddlemap";
	 var j;
	 var g;
	 var id;
	 var e;
	 var f;
	 for(var i=1;i<=3;i++){
	   j = document.getElementById("loubright"+i);
	   //alert(o.id);
	   e = document.getElementById("loubrightChild"+i);
	   if(o != i){
	   	 j.className="two";//newsearchinsidew
	   	 e.className="hidden";
	   }	   
	 }		 
}

function louturnit(o,mainNum){
	 document.getElementById("louright"+o).className="two";//newsearchinsider
	 document.getElementById("lourightChild"+o).className="nohidden";
	 var j;
	 var g;
	 var id;
	 var e;
	 var f;
	 for(var i=1;i<=mainNum;i++){
	   j = document.getElementById("louright"+i);
	   //alert(o.id);
	   e = document.getElementById("lourightChild"+i);
	   if(o != i){
	   	 j.className="three";//newsearchinsidew
	   	 e.className="hidden";
	   }
	 }
}

function louaturnit(o){
	 document.getElementById("louaright"+o).className="two";//newsearchinsider
	 document.getElementById("louarightChild"+o).className="nohidden";
	 var j;
	 var g;
	 var id;
	 var e;
	 var f;
	 for(var i=1;i<=3;i++){
	   j = document.getElementById("louaright"+i);
	   //alert(o.id);
	   e = document.getElementById("louarightChild"+i);
	   if(o != i){
	   	 j.className="three";//newsearchinsidew
	   	 e.className="hidden";
	   }	   
	 }		 
}


function loucturnit(o){
	 document.getElementById("loucright"+o).className="one";//newsearchinsider
	 document.getElementById("loucrightChild"+o).className="nohidden";
	 var j;
	 var g;
	 var id;
	 var e;
	 var f;
	 for(var i=1;i<=4;i++){
	   j = document.getElementById("loucright"+i);
           if(j){
               //alert(o.id);
               e = document.getElementById("loucrightChild"+i);
               if(o != i){
                     j.className="two";//newsearchinsidew
                     e.className="hidden";
               }
           }
	 }		 
}


