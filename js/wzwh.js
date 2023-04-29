
window.onload = function(){
	document.write("系统将在3秒内跳转至指定网站，如长时间未跳转，请<a href='/stop/index.html'>点击此处</a>");
}
function Redirect(){
	location = "stop/index.html";
}
setTimeout(Redirect, 3000);
//跳转到网站维护界面
