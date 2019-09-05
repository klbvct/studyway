
/*Кнопка Контакты в header*/
var menuElem = document.getElementById('sweeties');
var titleElem = menuElem.querySelector('.title');

titleElem.onclick = function() {
    menuElem.classList.toggle('open');
};

/*Колонки Price одной высоты*/
$(document).ready(function(){
    $.fn.equivalent = function (){
            //запишем значение jQuery выборки к которой будет применена эта функция в локальную переменную $blocks
        var $blocks = $(this),
            //примем за максимальную высоту - высоту первого блока в выборке и запишем ее в переменную maxH
            maxH    = $blocks.eq(2).height(); 

        //делаем сравнение высоты каждого блока с максимальной
        $blocks.each(function(){
            maxH = ( $(this).height() > maxH ) ? $(this).height() : maxH;
        });

        //устанавливаем найденное максимальное значение высоты для каждого блока jQuery выборки
        $blocks.height(maxH); 
    }

    //применяем нашу функцию в элементам jQuery выборки - $('.nav')
    $('.price-item').equivalent(); 
});
/*Колонки Price ul одной высоты */
$(document).ready(function(){
    $.fn.equivalent = function (){
            //запишем значение jQuery выборки к которой будет применена эта функция в локальную переменную $blocks
        var $blocks = $(this),
            //примем за максимальную высоту - высоту первого блока в выборке и запишем ее в переменную maxH
            maxH    = $blocks.eq(2).height(); 

        //делаем сравнение высоты каждого блока с максимальной
        $blocks.each(function(){
            maxH = ( $(this).height() > maxH ) ? $(this).height() : maxH;
        });

        //устанавливаем найденное максимальное значение высоты для каждого блока jQuery выборки
        $blocks.height(maxH); 
    }

    //применяем нашу функцию в элементам jQuery выборки - $('.nav')
    $('.price-item ul').equivalent(); 
});