function cWidth(k)  {return document.querySelector(k).clientWidth;}
function sel(a) {return document.querySelector(a);}
function selAll(a) {return document.querySelectorAll(a);}
/*
window.load = function()
{
    wW = window.innerWidth
    buttons1 = document.body.querySelector("div.buts").querySelectorAll("button");
    for(var a of buttons1) 
    {
        a.style.width = wW/3+"px";
        a.style.height = wW/6+"px";
    }
    
}
*/
window.onload = function () //дожидаемся полной загрузки страницы
{ 
	var ed = document.querySelector('header button.enter1');
    ed.onclick = function()
	{
		document.location.href = "edit.php";
	}
}