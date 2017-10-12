<?php
/**
Задание #7

Используя цикл for, выведите таблицу умножения размером 10x10. Таблица должна быть выведена с помощью HTML тега <table>
Если значение индекса строки и столбца чётный, то результат вывести в круглых скобках.
Если значение индекса строки и столбца Нечётный, то результат вывести в квадратных скобках.
Во всех остальных случаях результат выводить просто числом.
 */

$result=0;
echo "<table>";
for($i=1; $i<=10; $i++){
    echo "<tr>";
    for($j=1; $j<=10; $j++){
        $result=$i*$j;

        if($i%2==0 and $j%2==0){
            echo "<td>($result)</td>";
        } elseif ($i%2==1 and $j%2==1) {
            echo "<td>[$result]</td>";
        } else {
            echo "<td>$result</td>";
        }

    }
    echo "</tr>";
}
echo "</table>";

?>