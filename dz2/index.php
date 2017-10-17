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
echo PHP_EOL;
task6();
echo PHP_EOL;
echo task7("Карл у Клары украл Кораллы");
echo PHP_EOL;
echo task7_2("Две бутылки лимонада");
echo PHP_EOL;
echo task7_reg("Карл у Клары украл Кораллы");
echo PHP_EOL;
echo task7_2_reg("Две бутылки лимонада");
echo PHP_EOL;
task8("RX packets:950381 errors:0 dropped:0 overruns:0 frame:0. :)");
echo PHP_EOL;
task9("test.txt");
echo PHP_EOL;
task10("Hello again!");


?>