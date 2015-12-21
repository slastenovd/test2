<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);
header('Content-type: text/html; charset=utf-8');

$date = array(); // Создайте массив $date с пятью элементами

$date[]=  mt_rand(0, time()); // C помощью генератора случайных чисел забейте массив $date юниксовыми метками
$date[]=  mt_rand(0, time());
$date[]=  mt_rand(0, time());
$date[]=  mt_rand(0, time());
$date[]=  mt_rand(0, time());

$date1 = $date; 

// Сделайте вывод сообщения на экран о том, какой день в сгенерированном массиве получился наименьшим, а какой месяц наибольшим
echo 'Наименьший день ';
echo  min(
        date('d',$date[0]),
        date('d',$date[1]),
        date('d',$date[2]),
        date('d',$date[3]),
        date('d',$date[4])
        );
echo '<br>';

echo 'Наибольший месяц ';
echo min(
        date('M',$date[0]),
        date('M',$date[1]),
        date('M',$date[2]),
        date('M',$date[3]),
        date('M',$date[4]));
echo '<br>';

sort($date); // Отсортируйте массив по возрастанию дат

$selected = array_pop($date);           // С помощью функция для работы с массивами извлеките последний элемент массива в новую переменную $selected
echo 'Последняя дата '.date('D, d M Y H:i:s',$selected);  // C помощью функции date() выведите $selected на экран в формате "дд.мм.ГГ ЧЧ:ММ:СС"
echo '<br>';

// Выставьте часовой пояс для Нью-Йорка, и сделайте вывод снова, чтобы проверить, что часовой пояс был изменен успешно
echo 'Временная зона по умолчанию '.date_default_timezone_get();
echo '<br>';
date_default_timezone_set('America/New_York');
echo 'Временная зона после изменения '.date_default_timezone_get();
echo '<br>';


// Проверка
$date_days = array();
while(count($date1)) $date_days[] = date('D, d M Y H:i:s',  array_shift($date1));
print_r($date_days);
?>

<?php
/*
 * Следующие задания требуется воспринимать как ТЗ (Техническое задание)
 * p.s. Разработчик, помни! 
 * Лучше уточнить ТЗ перед выполнением у заказчика, если ты что-то не понял, чем сделать, переделать, потерять время, деньги, нервы, репутацию.
 * Не забывай о навыках коммуникации :)
 * 
 * Задание 1
 * - Создайте массив $date с пятью элементами
 * - C помощью генератора случайных чисел забейте массив $date юниксовыми метками
 * - Сделайте вывод сообщения на экран о том, какой день в сгенерированном массиве получился наименьшим, а какой месяц наибольшим
 * - Отсортируйте массив по возрастанию дат
 * - С помощью функция для работы с массивами извлеките последний элемент массива в новую переменную $selected
 * - C помощью функции date() выведите $selected на экран в формате "дд.мм.ГГ ЧЧ:ММ:СС"
 * - Выставьте часовой пояс для Нью-Йорка, и сделайте вывод снова, чтобы проверить, что часовой пояс был изменен успешно
 * 

 */

?>