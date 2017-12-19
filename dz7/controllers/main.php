<?php

namespace App;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class Main extends MainController
{
    public function index()
    {
        $users = User::all();
        $data_order = Order::all();
        $data=['title' => 'Заказать бургер'];
        $this->view->renderTwig('index', $data);
    }

    public function migration()
    {
        Capsule::schema()->create('goods', function (Blueprint $table){
            $table->increments('id');
            $table->text('name');
            $table->text('category');
            $table->timestamps();
        });
    }
}