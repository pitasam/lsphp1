<?php

namespace App\Http\Controllers;

use App\Category;
use App\Good;
use App\Mail\OrderShipped;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;


class GoodController extends Controller
{
    public function index()
    {
        $goods = Good::all();
        $data['goods'] = $goods;
        return view('goods.listgoods', $data);
    }

    public function view($id)
    {
        if (!is_numeric($id)){
            abort(404);
        }

        $good = Good::find($id);
        $user = User::find($id);
        $data['good'] = $good;
        $data['user'] = $user;

        return view('goods.view', $data);
    }

    public function buy()
    {
        $name=$_REQUEST['name'];
        $email=$_REQUEST['email'];

        Mail::to($email)->send(new OrderShipped());
//        $this->smtp($email, $name);

        return redirect('/goods');
    }

    public function smtp($email, $name)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.mail.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'lsphp@mail.ru';
        $mail->Password = 'qwe123qwe123';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('lsphp@mail.ru', 'Цветочный магазин "Флора"');
        $mail->CharSet = 'Utf-8';

        $mail->isHTML(true);
        $mail->addAddress($email);
        $mail->Subject = "Компания \"Флора\"";
        $mail->Body = "Здравствуйте, $name! Ваш заказ принят.";
        $mail->AltBody = "Ваш почтовый клиент не поддерживает html.";

        $mail->send();

//        $mail = new Mailer();
//        $mail->setMessage('pitasam@yandex.ru', 'Ваш заказ', '<h1>Ваш заказ:</h1> <p style="color: red">Бургер за 500р. Спасибо за заказ</p>');
//        $mail->send();
    }




}
