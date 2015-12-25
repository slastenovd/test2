<?php

//POST

$news='Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news=  explode("\n", $news);

// Функция вывода всего списка новостей.
function show_all_news() {
    global $news;
    echo '<h1>Список новостей:</h1>';
    foreach ($news as $value) {
        echo '<a href="http://xaver.loc/dz5_1.php?id='.(key($news)-1).'">'.$value.'</a><br>';
    }
}

// Функция вывода конкретной новости.
function show_news($id=1){
    global $news;
    echo $news[$id];
}

// Точка входа.
// Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список

if (isset($_POST['id']) and strlen($_POST['id']) ) {
    $get_id = $_POST['id'];
    if ($get_id >= 0 and $get_id <= count($news) - 1) {
        show_news($get_id);
    } else {
        show_all_news();
    }
}
else{
//        header('HTTP/1.0 404 NOT FOUND');	
//        echo '<h1>404</h1>';
//        echo '<h2>Страница не найдена</h2>';
}
    

// Был ли передан id новости в качестве параметра?
// если параметр не был передан - выводить 404 ошибку
// http://php.net/manual/ru/function.header.php
?>

<!DOCTYPE HTML>
<html>
 <head>
  <meta charset="utf-8">
  <title>Тег FORM</title>
 </head>
 <body>

 <form method="POST">
  <p><b>Введите номер статьи</b></p>
  <p>
      <input type="text" name = "id" value="">
</p>
  <p><input type="submit"></p>
 </form>

 </body>
</html>