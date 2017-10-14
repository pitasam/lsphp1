<?php

function task1 ($arr_str, $flag = false) {
    if ($flag) {
        foreach ($arr_str as $str) {
            return "$str ";
        }
    } else {
        foreach ($arr_str as $str) {
            echo "<p>$str</p>";
        }
    }
}

function task2($numbers = [1, 2, 3], $operation = '+') {
    $args = func_num_args();

    if ($args<2) {
        throw new BadFunctionCallException("Параметров должно быть два.");
    }

    $type_numbers = gettype($numbers);
    if ($type_numbers != "array") {
        throw new Exception("Не массив. Передайте первым параметром массив с числовыми значениями.");
    }
    foreach ($numbers as $num) {
        $type = gettype($num);

        if ($type != "integer" && $type != "float") {
            throw new Exception("Массив состоит не из чисел.");
        }
    }


    $result = $numbers[0];

    for ($i = 1; $i < count($numbers); $i++) {
        switch ($operation) {
            case "+":
                $result += $numbers[$i];
                break;
            case "-":
                $result -= $numbers[$i];
                break;
            case "/":
                foreach ($numbers as $num) {
                    if ($num == 0) {
                        throw new Exception("На ноль делить нельзя!");
                    }
                }
                $result /= $numbers[$i];
                break;
            case "*":
                $result *= $numbers[$i];
                break;
            default:
                throw new Exception('Такого действия нет. Возможные действия: "+", "-", "/", "*".');
                break;
        }
    }

    return $result;

}

function task3() {
    $args = func_get_args();
    $operation = $args[0];

    for ($i = 1; $i < count($args)-1; $i++) {
        $result = $args[1];

        for ($i = 2; $i < count($args); $i++) {
            switch ($operation) {
                case "+":
                    $result += $args[$i];
                    break;
                case "-":
                    $result -= $args[$i];
                    break;
                case "/":
                    $result /= $args[$i];
                    break;
                case "*":
                    $result *= $args[$i];
                    break;
                default:
                    return "ERROR";
                    break;
            }
        }
        return $result;
    }
}

function task4($int1 = 0, $int2 = 0) {

    $args = func_num_args();

    if ($args<2) {
        throw new BadFunctionCallException("Параметров должно быть два.");
    }
    if (gettype($int1) != "integer" || gettype($int2) != "integer") {
        throw new Exception("Оба параметра должны быть целыми числами.");
    }
    if ($int1<1 || $int2<1) {
        throw new Exception("Числа должны быть больше 0.");
    }

    echo "<table>";
    for ($i=1; $i<=$int1; $i++) {
        echo "<tr>";
        for ($j=1; $j<=$int2; $j++) {
            $result = $i*$j;
            echo "<td>";
            echo "$i x $j = $result";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
function task5($str) {
    $n_str = str_replace(" ","",$str);
    $n_str = mb_strtolower($n_str, 'UTF-8');
    $length = mb_strlen($n_str, 'UTF-8');
    
    for ($i=0; $i<floor($length/2); $i++) {
        $ch_str[] = mb_substr($n_str, $i, 1, 'UTF-8');
        $ch_obr_str[] = mb_substr($n_str, $length-$i-1, 1, 'UTF-8');

        if (mb_substr($n_str, $i, 1, 'UTF-8') != mb_substr($n_str, $length-$i-1, 1, 'UTF-8')) {
            return false;
        }

        if ($i == floor($length/2)-1) {
            return true;
        }
    }
}

function task5_2($str) {
    if(task5($str)) {
        echo "Эта строка полиндром";
    } else {
        echo "Эта строка НЕ полиндром";
    }
}

?>