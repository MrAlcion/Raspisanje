window.onload = function () //дожидаемся полной загрузки страницы
{ 
	var a = document.querySelector('header div.links p.p_header');
    a.onclick = function()
	{
		document.location.href = "index.php";
	}
	var b = document.querySelector('header button.enter');
    b.onclick = function()
	{
		location.reload();
	}
}
// Уведомление: alert( "Привет" );
// location.reload()
