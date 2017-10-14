<?php
/**
Задание #6

Создайте массив $bmw с ячейками:
model
speed
doors
year
Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”
Создайте   массивы   $toyota   и   $opel   аналогичные   массиву   $bmw   (заполните  данными)
Объедините три массива в один многомерный массив
Выведите значения всех трех массивов в виде:
CAR name
name ­ model ­speed ­ doors ­ year
Например:
CAR bmw
X5 ­120 ­ 5 ­ 2015
 */

$bmw = ["model" => "X5","speed" => 120, "doors" => 5, "year" => "2015"];
$toyota = ["model" => "RAV4", "speed" => 170, "doors" => 5 ,"year" => "2007"];
$opel = ["model" => "Speedster", "speed" => 220, "doors" => 2 ,"year" => "2003"];

$cars = ["bmw" => $bmw, "toyota" => $toyota, "opel" => $opel];

foreach ($cars as $key => $car) {
    echo "Car: $key".PHP_EOL;
    foreach ($car as $name_character => $characteristics){
        echo "$characteristics";
        if ($name_character != "year") {
            echo " - ";
        }
    };
    echo PHP_EOL.PHP_EOL;
}
?>