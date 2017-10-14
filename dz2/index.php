<?php
require "functions.php";
task1(["cat", "dog", "rabbit"]);
echo PHP_EOL;

try {
    echo task2([1,8,7], '/');
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

echo PHP_EOL;
echo "<br>";
echo task3('+', 1, 2, 3, 5.2);
echo PHP_EOL;

try {
    task4(2, 5);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}

echo PHP_EOL;
task5_2("На Доме чЕмОдаН");
