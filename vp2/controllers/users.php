<?php

namespace App;

use Illuminate\Database\Capsule\Manager as Capsule;
use Intervention\Image\ImageManagerStatic as Image;

class Users extends MainController
{
    public function index()
    {
        echo "users index";
    }

    public function registration()
    {
        $data = $_POST;
        $file = $_FILES['file'];

        $login = strip_tags($data['login']);
        $password = strip_tags($data['password']);
        $name = strip_tags($data['name']);
        $age = strip_tags($data['age']);
        $about = strip_tags($data['about']);

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

            if( User::where('login', $login)->count() > 0) {
                $errors[] = 'Пользователь с таким логином уже зарегистрирован.';
            }

            // проверка на наличие ошибок
            if (empty($errors)) {

                //регистрируем, ошибок нет
                $user = new User();
                $user->insertGetId([
                    'login' => $login,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'name' => $name,
                    'age' => $age,
                    'about' => $about
                ]);

                //генерируем новое имя файла (по id в БД) и перемещаем в нужную директорию
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                $id = User::where('login', $login)->value('id');
                $new_name_file = $id . "." . $ext;

                move_uploaded_file($file['tmp_name'], "views/photos/$new_name_file"); // переносим файл в другую папку и меняем имя файла

                User::where('id', $id)
                    ->update(['image' => $new_name_file]);

            } else {
                // есть ошибки, выводим текст ошибки
                echo '<div style="color: red">'.array_shift($errors).'</div><hr>';
            }

            //header('Location: '.strtok($_SERVER["REQUEST_URI"], '?'));
        }

        $this->redirect('users');
    }
    public function authorization()
    {
        $data = $_POST;
        $file = $_FILES['file'];

        $login = strip_tags($data['login']);
        $password = strip_tags($data['password']);
        $name = strip_tags($data['name']);
        $age = strip_tags($data['age']);
        $about = strip_tags($data['about']);
        $image = strip_tags($data['image']);

        if ( isset($data['do_login'])) {
            $errors = array();
            $exist_user = User::where('login', $login)->count();

            if ($exist_user) {
                // логин существует
                $passwordDB = User::where('login', $login)->value('password');
                if (password_verify($password, $passwordDB)) {

                    // пароль верный, логиним пользователя
                    $id_user = User::where('login', $login)->value('id');

                    //записываем в сессию id пользователя
                    session_start();
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
    }

    public function showUserList()
    {
        $users_model = new User();
        $users = $users_model->all();

        for ($i = 0; $i < count($users); $i++) {
            $users[$i] = $users[$i] . "changed";
        }

        $data['users'] = $users;
        $data['username'] = 'Igor';
        $this->view->render('users/userlist', $data);
    }

    public function showFirstUser()
    {
        $users_model = new User();
        $user = $users_model->first();

        $data['user'] = $user;
        $this->view->render('users/userfirst', $data);
    }

    public function create()
    {
        $this->view->renderTwig('create');
    }

    public function store()
    {
        $user = new User();
        $order = new Order();

        $email = strip_tags($_POST['email']);
        $exist_user = $user->where('email', $email)->value('email');

        if ($exist_user) {
            User::where('email', $email)
                ->update([
                    'name' => strip_tags($_POST['name']),
                    'tel' => strip_tags($_POST['tel']),
                    'ip' => $_SERVER['REMOTE_ADDR']
                ]);

            $order->email=strip_tags($_POST['email']);
            $order->street=strip_tags($_POST['street']);
            $order->house=strip_tags($_POST['house']);
            $order->block=strip_tags($_POST['block']);
            $order->flat=strip_tags($_POST['flat']);
            $order->floor=strip_tags($_POST['floor']);
            $order->comment=strip_tags($_POST['comment']);
            $order->payment=strip_tags($_POST['payment']);
            $order->callback=strip_tags($_POST['callback']);
            $order->save();
        } else {

            $user->email =  strip_tags($_POST['email']);
            $user->name = strip_tags($_POST['name']);
            $user->tel = strip_tags($_POST['tel']);
            $user->ip = $_SERVER['REMOTE_ADDR'];

            $user->save();

            $order->email=strip_tags($_POST['email']);
            $order->street=strip_tags($_POST['street']);
            $order->house=strip_tags($_POST['house']);
            $order->block=strip_tags($_POST['block']);
            $order->flat=strip_tags($_POST['flat']);
            $order->floor=strip_tags($_POST['floor']);
            $order->comment=strip_tags($_POST['comment']);
            $order->payment=strip_tags($_POST['payment']);
            $order->callback=strip_tags($_POST['callback']);
            $order->save();

            //генерируем новое имя файла (по id в БД) и перемещаем в нужную директорию
            $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            $id=User::where('email', $_POST['email'])->value('id');
            $new_name_file = $id . "." . $ext;

            move_uploaded_file($_FILES['file']['tmp_name'], "views/photos/$new_name_file"); // переносим файл в другую папку и меняем имя файла

            User::where('id', $id)
                ->update(['image' => $new_name_file]);
        }
        $id=User::where('email', $_POST['email'])->value('id');

        $this->resizeImage($id); // меняем размер картинки и расположение
        $this->redirect('');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $data = ['user' => $user];
        $this->view->renderTwig('edit', $data);
    }

    public function update($id)
    {
        $user = User::find($id);
        $user->name = strip_tags($_POST['name']);
        $user->age = strip_tags($_POST['age']);
        $user->about = strip_tags($_POST['about']);


        //генерируем новое имя файла (по id в БД) и перемещаем в нужную директорию
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        $new_name_file = $id . "." . $ext;

        move_uploaded_file($_FILES['file']['tmp_name'], "views/photos/$new_name_file"); // переносим файл в другую папку и меняем имя файла
        $user->image = $new_name_file;

        $user->save();

        $this->resizeImage($id); // меняем размер картинки и расположение

        $this->redirect('main/listusers');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        $this->redirect('users/admins');
        //User::destroy($id);
    }

    public function deleteImage($id){
        // удаляем фото из папки
        $name_photo = User::where('id', $id)->value('image');
        $path = "views/photos/".$name_photo;

        //если фото существует, то удаляем фото
        if (file_exists($path)){
            unlink($path);
        }
        $this->redirect('main/listfiles');
    }

    public function resizeImage($id)
    {
        putenv('GDFONTPATH=' . realpath('.'));
        $name_file=User::where('id', $id)->value('image');

        $image = Image::make("views/photos/".$name_file)
            ->resize(null, 480, function ($image) {
                $image->aspectRatio();
            })
            ->save("views/image/$name_file");
    }
}