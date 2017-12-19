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

    public function create()
    {
        $this->view->renderTwig('create');
    }

    public function admins()
    {
        $users = User::all();
        $data = ['users' => $users];
        $this->view->renderTwig('admins', $data);
    }

    public function store()
    {
        $user = new User();
        $order = new Order();

        $email = strip_tags($_POST['email']);
        $exist_user = $user->where('email', $email)->value('email');

        // проверка на существование пользователя в базе
        if ($exist_user) { // существует, меняем имя, телефон, ip и добавляем заказ
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
        } else { // не существует, создаем данные в обоих таблицах

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
        $user->save();
        $this->redirect('users/admins');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        $this->redirect('users/admins');
        //User::destroy($id);
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