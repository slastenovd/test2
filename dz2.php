<?php
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание 1
 * - Создайте переменную $name и присвойте ей значение содержащее ваше имя, например Игорь
 * - Создайте переменную $age и присвойте ей ваше количество лет, например 30
 * - Выведите на экран фразу по шаблону "Меня зовут Игорь"
 *                                      "Мне 30 лет"
 * Удалите переменные $name и $age
 * 
 * 
 * Задание 2
 * - Создайте константу и присвойте ей значение города в котором живете
 * - Прежде чем выводить константу на экран, проверьте, действительно ли она объявлена и существует
 * - Выведите значение объявленной константы
 * - Попытайтесь изменить значение созданной константы
 * 
 * Задание 3
 * - Создайте ассоциативный массив $book, ключами которого будут являться значения "title", "author", "pages"
 * - Заполните его по логике описания книг, укажите значения книги, которую недавно прочитали
 * - Выведите следующую строку на экран, следуя шаблону: "Недавно я прочитал книгу 'title', написанную автором author, я осилил все pages страниц, мне она очень понравилась"
 * 
 * Задание 4
 *  - Создайте индексный массив $books, который будет содержать в себе два массива $book1 и $book2, где будут записаны уже две последние прочитанные вами книги
 *  - Выведите следующую строку на экран, следуя шаблону: "Недавно я прочитал книги 'title1' и 'title2', 
 *  написанные соответственно авторами author1 и author2, я осилил в сумме pages1+pages2 страниц, не ожидал от себя подобного"

 */
    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
//  Устанавливаем кодировку
    header('Content-type: text/html; charset=utf-8');

//  Задание 1
    $name = 'Дмитрий';
    $age  = 38;
    echo 'Меня зовут '.$name.'. ';
    echo 'Мне '.$age.' лет. ';

    unset($name, $age);

//  Задание 2
    define('CITY','Комсомольск-на-Амуре');
    
    if( defined('CITY') ){
        echo 'Мой город '.CITY.'. ';
    } else{
        echo 'Константа CITY не определена. ';
    }
    // CITY = 15; // ( ! ) Parse error: syntax error, unexpected '=' in /var/www/html/index.php on line 46

//  Задание 3
    //$book = array('title'=>'','author'=>'','pages'=>'');
    $book = array();
    $book['title']='1984';
    $book['author']='Джордж Оруэлл';
    $book['pages']=315;
    echo 'Недавно я прочитал книгу '.$book['title'].', написанную автором '.$book['author'].', я осилил все '.$book['pages'].' страниц, мне она очень понравилась.';
    
//  Задание 4
    $book1 = array();
    $book1 = $book;

    $book2 = array();
    $book2['title']='Война и Мир';
    $book2['author']='Лев Толстой';
    $book2['pages']=1077;
    $books = array($book1, $book2);

    echo '<br>';

    echo 'Недавно я прочитал книги '.$books[0]['title'].' и '.$books[1]['title'];
    echo ' написанные соответственно авторами '.$books[0]['author'].' и '.$books[1]['author'];
    echo ', я осилил в сумме '.($books[0]['pages']+$books[1]['pages']).' страниц, не ожидал от себя подобного.';
?>