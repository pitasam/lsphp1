<?php

namespace App;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class Main extends MainController
{
    public function index()
    {

        $this->view->renderTwig('index');

    }

    public function reg()
    {
        $this->view->renderTwig('reg');
    }

//    public function listusers()
//    {
//        session_start();
//        if ($_SESSION['logged_user']){
//            $user = User::all();
//            $age = User::lists('age');
//            echo "<h1>".print_r($age)."</h1>";
//            $data = ['users'=> $user, 'age' => $age];
//            $this->view->renderTwig('listusers', $data);
//        } else {
//            $this->redirect('main');
//        }
//
//    }
    public function listusers()
    {
        session_start();
        if ($_SESSION['logged_user']){
            $user = User::all();

            foreach ($user as $flight) {
                if($flight->age >= 18){
                    $flight->agetext = "совершеннолетний";
                } else {
                    $flight->agetext = "несовершеннолетний";
                }
            }
            $data = ['users'=> $user];
            $this->view->renderTwig('listusers', $data);

        } else {
            $this->redirect('main');
        }

    }

    public function listfiles()
    {
        session_start();
        if ($_SESSION['logged_user']){
            $user = User::all();
            $data = ['users'=> $user];
            $this->view->renderTwig('listfiles', $data);
        } else {
            $this->redirect('main');
        }
    }

    public function listusers_asd()
    {
        session_start();
        if ($_SESSION['logged_user']){
            $user = User::orderBy('age')->get();
            foreach ($user as $flight) {
                if($flight->age >= 18){
                    $flight->agetext = "совершеннолетний";
                } else {
                    $flight->agetext = "несовершеннолетний";
                }
            }
            $data = ['users'=> $user];
            $this->view->renderTwig('listusers', $data);
        } else {
            $this->redirect('main');
        }

    }
    public function listusers_desc()
    {
        session_start();
        if ($_SESSION['logged_user']){
            $user = User::orderBy('age', 'desc')->get();
            foreach ($user as $flight) {
                if($flight->age >= 18){
                    $flight->agetext = "совершеннолетний";
                } else {
                    $flight->agetext = "несовершеннолетний";
                }
            }
            $data = ['users'=> $user];
            $this->view->renderTwig('listusers', $data);
        } else {
            $this->redirect('main');
        }

    }


}