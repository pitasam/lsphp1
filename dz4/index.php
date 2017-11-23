<?php
require "db.php";

$page = strip_tags($_GET['page']);
$action = strip_tags($_GET['action']);
$delete_user_id = strip_tags($_GET['id']);

$data = $_POST;
$login=strip_tags($data["login"]);
$file = $_FILES['file'];
$stmt = '';
$uploads_dir = 'photos';

switch ($page) {
    case "reg":
        $tpl_page = "registration";
        break;
    case "auth":
        $tpl_page = "authorization";
        break;
    case "listusers":
        if ($_SESSION['logged_user']) {
            $tpl_page = "listusers";

            if ($action === 'deleteuser') {
                if ($pdo->query("SELECT count(*) FROM users WHERE users.id ="."'"."$delete_user_id"."'")->fetchColumn() > 0)
                {
                    // удаляем фото из папки
                    $name_photo = $pdo->query("SELECT photo FROM users WHERE users.id ="."'"."$delete_user_id"."'")->fetchColumn();
                    $path = $uploads_dir."/".$name_photo;

                    //если фото существует, то удаляем фото
                    if (file_exists($path)){
                        unlink($path);
                    }

                    // удаляем пользователя из базы
                    $prepare_delete = $pdo->prepare("DELETE FROM users WHERE users.id=?");
                    $prepare_delete->execute([$delete_user_id]);

                }
            } else {
                $errors[] = 'Действие не указано';
            }
        } else {
            $tpl_page = "authorization";
        }
        break;
    case "listfiles":
        if ($_SESSION['logged_user']) {
            $tpl_page = "listfiles";

            if ($action === 'deletefile') {
                if ($pdo->query("SELECT count(*) FROM users WHERE users.id ="."'"."$delete_user_id"."'")->fetchColumn() > 0)
                {
                    // удаляем фото из папки
                    $name_photo = $pdo->query("SELECT photo FROM users WHERE users.id ="."'"."$delete_user_id"."'")->fetchColumn();
                    $path = $uploads_dir."/".$name_photo;

                    //если фото существует, то удаляем фото
                    if (file_exists($path)){
                        unlink($path);
                    }
                }
            } else {
                $errors[] = 'Действие не указано';
            }

        } else {
            $tpl_page = "authorization";
        }
        break;
    default:
        $tpl_page = "authorization";
        break;
}

require "header.php";

if ( isset($data['do_signup']) ) //кнопка нажата
{
    $errors = array();
    if (trim($data['login']) == '') {
        $errors[] = 'Введите логин!';
    }

    if (trim($data['password']) == '') {
        $errors[] = 'Введите пароль!';
    }

    if ($data['password2'] != $data['password']) {
        $errors[] = 'Повторный пароль введен не верно!';
    }

    if ($data['name'] == '') {
        $errors[] = 'Введите имя!';
    }

    if (trim($data['age']) == '') {
        $errors[] = 'Введите возраст!';
    }

    if ($data['about'] == '') {
        $errors[] = 'Напишите о себе!';
    }

    if ($_FILES['file'] == '') {
        $errors[] = 'Загрузите картинку!';
    } else {

        //проверка расширения файла

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $img_exts = ['jpeg', 'jpg', 'png', 'gif'];

        if (! in_array($ext, $img_exts)){
            $errors[] = 'Это не картинка';
        }

        //проверка на ошибки

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Ошибка загрузки';
        }

        //проверка размера

        function convToByte($size)  //перевод размера в байты
        {
            $size = strtoupper(trim($size));
            $length = strlen($size) - 1;

            switch ($size[$length]){
                case 'G':
                    $size *= 1024;
                case 'M':
                    $size *= 1024;
                case 'K':
                    $size *= 1024;
            }

            return $size;
        }

        $uploud_max_size = convToByte(ini_get('upload_max_filesize'));
        $post_max_size = convToByte(ini_get('post_max_size'));

        if ($file['size'] == 0) {
            $errors[] = 'Пустой файл';
        }

        if ($file['size'] > $uploud_max_size || $file['size'] > $post_max_size) {
            $errors[] = 'Файл слишком большой';
        }


    }

    if( $pdo->query("SELECT count(*) FROM users WHERE users.login = '$login'")->fetchColumn() > 0 ) {
        $errors[] = 'Пользователь с таким логином уже зарегистрирован.';
    }

    // проверка на наличие ошибок
    if (empty($errors)) {

        //регистрируем, ошибок нет
        $prepare = $pdo->prepare("INSERT INTO users(login, password, name, age, description) VALUES (?, ?, ?, ?, ?)");
        $prepare->execute([strip_tags($data['login']), password_hash($data['password'], PASSWORD_DEFAULT), strip_tags($data['name']), strip_tags($data['age']), strip_tags($data['about'])]);

        //генерируем новое имя файла (по id в БД) и перемещаем в нужную директорию
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $new_name_file = $pdo->query("SELECT id FROM users WHERE users.login = '$login'")->fetchColumn() . "." . $ext;
        move_uploaded_file($file['tmp_name'], "$uploads_dir/$new_name_file");

        //записываем новое название файла в бд
        $prepare_photo = $pdo->prepare("UPDATE users SET users.photo=? WHERE users.login = ?");
        echo $new_name_file;
        $prepare_photo->execute([$new_name_file, strip_tags($data['login'])]);

    } else {
        // есть ошибки, выводим текст ошибки
        echo '<div style="color: red">'.array_shift($errors).'</div><hr>';
    }

    //header('Location: '.strtok($_SERVER["REQUEST_URI"], '?'));

}

if ( isset($data['do_login'])) {
    $errors = array();
    $exist_user = $pdo->query("SELECT count(*) FROM users WHERE users.login = '$login'")->fetchColumn();

    if ($exist_user) {
        // логин существует
        $passwordDB = $pdo->query("SELECT password FROM users WHERE users.login = '$login'")->fetchColumn();
        if (password_verify($data['password'], $passwordDB)) {
            // пароль верный, логиним пользователя
            $id_user = $pdo->query("SELECT id FROM users WHERE users.login = '$login'")->fetchColumn();

            //записываем в сессию id пользователя
            $_SESSION['logged_user'] = $id_user;
            echo '<div style="color: #12fc27">' .'Вы авторизованы.'.'</div><hr>';

        } else {
            $errors[] ='Пароль неправильно введен';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не существует!';
    }

    if (!empty($errors)) {
        echo '<div style="color: red">'.array_shift($errors).'</div><hr>';
    }
}

if ($tpl_page == 'listusers') {
    $stmt = $pdo->query("SELECT * FROM users");
}
if ($tpl_page == 'listfiles') {
    $stmt = $pdo->query("SELECT id, photo FROM users");
}

require $tpl_page.'.php';

?>


<?php
require "footer.php";
?>