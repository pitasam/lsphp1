<?php

abstract class Car
{

}

class Kia extends Car {
    use Engine;
    use TransmissionAuto;

    public function move_start ($distance, $speed, $direction) {
        $this->turn("on");
        $this->getDirection($direction);
        echo "Параметры двигателя".PHP_EOL;
        echo "Дистанция: ".$distance." метров".PHP_EOL;

        $max_speed = $this->get_max_speed();
        if ($speed < $max_speed && $speed > 0) {
            echo "Скорость: ".$speed." м/с".PHP_EOL;
        } elseif ($speed < 0) {
            echo "Скорость: 0 м/с".PHP_EOL;
        } else {
            echo "Скорость: ".$max_speed." м/с".PHP_EOL;
        }

        echo "Направление: ".$this->getDirection($direction).PHP_EOL;

        echo "Температура двигателя: ".$this->get_temp($distance).PHP_EOL;
    }

    public function move_stop () {
        $this->turn("off");
        $this->getDirection("stand");
        echo "Автомобиль остановлен".PHP_EOL;
    }


}

trait Engine{
    public $horsepower;
    private $temp;
    private $turn;

    public function turn ($turn) {
        if ($turn == "on") {
            $this->turn = "on";
        } else {
            $this->turn = "off";
        }
    }

    public function froze () {
        $this->temp -= 10;
    }

    public function get_max_speed() {
        return $max_speed = $this->horsepower * 2;
    }

    public function get_temp($distance) {
        $this->temp = (int)$distance/10 * 5;
        while ($this->temp >= 90 ) {
            $this->froze();
        }
        return $this->temp;
    }
}

trait TransmissionAuto {
    public $direction = "stand";

    public function getDirection ($direction) {
        if ($direction == "forward"){
            return $this->direction = "вперед";
        }
        elseif ($direction == "backward"){
            return $this->direction = "назад";
        } else {
            return $this->direction = "стоит";
        }
    }

}

trait TransmissionManual {
    public $direction;

    public function transfer($speed) {
        if ($speed < 20 && $speed > 0) {
            echo "Включена передача 1";
        }
        if ($speed > 20) {
            echo "Включена передача 2";
        }

    }



}


$my_kia = new Kia();
$my_kia->horsepower = 20;
$my_kia->move_start(200,20,"forward");



?>