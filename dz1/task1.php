<?php

/*
Задание #1

Создайте   переменную   $name   и   присвойте   ей   строковое   значение   содержащее  Ваше имя
Создайте   переменную   $age   и   присвойте   ей   строковое   значение   содержащее   Ваш  возраст
Выведите   с   помощью   echo   (или   print)   фразу   “Меня   зовут:   ​ваше_имя​”   например:  “Меня зовут: Игорь”
Выведите фразу “Мне ​ваш_возраст​ лет”, например: “Мне 99 лет”
Выведите следующий набор символов, включая кавычки - “!|\/’”\ (двойная кавычка, воскл. знак, вертикальная черта, обратный слэш, слэш, кавычка, двойная кавычка, обратный слэш)
Каждая фраза должна начинаться с новой строки
 */

function echo_n($a){
    echo $a . PHP_EOL;
}

$name="Rita";
$age=22;
echo "My name is " . $name . PHP_EOL;
echo "My age is " . $age . PHP_EOL;
echo "\"!|\\/’\"\\";
?>