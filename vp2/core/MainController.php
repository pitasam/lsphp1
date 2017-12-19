<?php
namespace App;

class MainController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
        new MainModel();
    }

    public function redirect($to)
    {
        header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$to);
    }
}