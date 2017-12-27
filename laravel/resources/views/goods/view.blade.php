@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Список товаров</div>

                <div class="panel-body">

                    <table class="table">
                        <tr>
                            <th>Название товара</th>
                            <th>Цена товара</th>
                            <th>Картинка</th>
                            <th>Описание товара</th>
                            <th>Выбрать товар</th>
                        </tr>


                            <tr>
                                <td>{{$good->name}}</td>
                                <td>{{$good->price}}</td>
                                <td>{{$good->image}}</td>
                                <td>{{$good->desc}}</td>
                                <td><a href="" class="btn btn-default" id="buy">Купить</a></td>
                            </tr>

                    </table>
                    <a href="/goods" class="btn btn-default btn-cat">Список товаров</a>
                    <a href="/categories" class="btn btn-default">Список категорий</a>

                    <div class="popup" id="popup">
                        <div id="close" class="close"></div>
                        @foreach($errors->all() as $error)
                            <li style="color:red">{{$error}}</li>
                        @endforeach
                        <form action="/goods/buy" method="post">
                            {{csrf_field()}}
                            <input class="input-group" name="email" type="email" placeholder="E-mail" value="{{$user->email}}">
                            <input class="input-group" name="name" type="text" placeholder="Имя" value="{{$user->name}}">
                            <input class="btn btn-default" type="submit" value="Отправить">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
