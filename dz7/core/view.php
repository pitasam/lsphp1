<?php

namespace App;

use Twig_Environment;
use Twig_Loader_Filesystem;

class View
{
    public function render($filename, array $data)
    {
        require_once __DIR__."/../views/".$filename.".php";
    }

    public function renderTwig($filename, array $data = [])
    {
        $loader = new Twig_Loader_Filesystem('templates');
        $twig = new Twig_Environment($loader, array(
            'cache' => false,
        ));

        echo $twig->render($filename.'.html', $data);

    }
}

