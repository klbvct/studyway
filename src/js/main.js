
/*Кнопка Контакты в header*/
var menuElem = document.getElementById('sweeties');
var titleElem = menuElem.querySelector('.title');

titleElem.onclick = function() {
    menuElem.classList.toggle('open');
};

/*Колонки Price одной высоты*/
var pi2 = $("div.price-item-2").height();
$("div.price-item-1").height(pi2);
$("div.price-item").height(pi2);