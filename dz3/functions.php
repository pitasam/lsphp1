<?php

function task1() {
    $xmlPath = "data.xml";
    $xml = simplexml_load_file($xmlPath);

    $attr = $xml->attributes();

    print_r("<h1>"."Номер покупки: ".$attr["PurchaseOrderNumber"]."</h1>".PHP_EOL);
    print_r("<h1>"."Дата покупки: ".$attr["OrderDate"]."</h1>".PHP_EOL);

    foreach ($xml as $key => $item) {

        switch ($key) {
            case "Address":
                $attr_address=$item->attributes();

                print_r(PHP_EOL.PHP_EOL."<h2>".$attr_address['Type']."</h1>".PHP_EOL.PHP_EOL);
                echo "<ul>";
                foreach ($item as $key_item => $value) {
                    print_r("<li>".$key_item.": ".$value."</li>".PHP_EOL);
                }
                echo "</ul>";
                break;

            case "DeliveryNotes":
                print_r(PHP_EOL);
                print_r("<h2>".$key.": "."</h2>".PHP_EOL);
                echo("<i>".$item.PHP_EOL."</i>");
                break;

            case "Items":
                foreach ($item as $key_item => $value) {
                    $attr_items = $value->attributes();
                    echo(PHP_EOL."<h2>"."Type of item ".$attr_items['PartNumber']."</h2>".PHP_EOL.PHP_EOL);
                    echo "<ul>";
                    foreach ($value as $key_value => $value_item) {
                        print_r("<li>".$key_value.": ".$value_item."</li>".PHP_EOL);
                    }
                    echo "</ul>";
                }
                break;
        }

    }
}

function task2() {
    $data_json = [
        "users" => [
                ["name" => "Mari"],
                ["weight" => "51"],
                ["growth" => "160"],
                "pets" => [
                    ["cat", "dog", "rabbit" ]
                ],
                ["name" => "Nick"],
                ["weight" => "75"],
                ["growth" => "178"],
                "pets" => [
                    ["dog", "parrot"]
                ],
        ]
    ];

    $json_encode = json_encode($data_json);
    file_put_contents("output.json", $json_encode);
    $file_content_output = file_get_contents("output.json");
    $arr_output = json_decode($file_content_output, true);

    function recur_rand_arr(&$arr) {

        foreach ($arr as $key => $value) {

            if (gettype($value) == "array") {

                $arr[$key] = recur_rand_arr($value);
            } else {
                if (rand(0, 1)) {
                    $arr[$key] = "Changed";

                }
            }

        }
        return $arr;
    }
    $arr_output_changed = recur_rand_arr($arr_output['users']);
    file_put_contents("output2.json",json_encode($arr_output_changed));

    $file_content_output2 = file_get_contents("output2.json");
    $arr_output2 = json_decode($file_content_output2, true);

}

function task3() {
    $arr = [];
    $sum = 0;

    for ($i=0; $i<55; $i++) {
        $arr[] = rand(1,100);
    }
    $arr_json=json_encode($arr);
    file_put_contents("csv", $arr_json);

    $arr_decode = json_decode(file_get_contents("csv"), true);

    foreach ($arr_decode as $num) {
        $sum += $num;
    }

    return $sum;
}

function task4() {
    //Инициализируем сеанс
    $url = "https://en.wikipedia.org/w/api.php?action=query&titles=Main%20Page&prop=revisions&rvprop=content&format=json";

    $connection = curl_init();
    //Устанавливаем адрес для подключения
    curl_setopt($connection, CURLOPT_URL, $url);
    /*//Указываем, что мы будем вызывать методом POST
    curl_setopt($connection, CURLOPT_POST, 1);
    //Передаем параметры методом POST
    curl_setopt($connection, CURLOPT_POSTFIELDS, "id=1");*/
    //Говорим, что нам необходим результат
    curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);
    //Выполняем запрос с сохранением результата в переменную
    $result=curl_exec($connection);
    //Завершаем сеанс
    curl_close($connection);

    $res_json=json_decode($result, true);
    $pageid = $res_json["query"]["pages"]["15580374"]["pageid"];
    $title = $res_json["query"]["pages"]["15580374"]["title"];

    print_r(PHP_EOL."Page id: ".$pageid.PHP_EOL."Title: ".$title);
}



?>