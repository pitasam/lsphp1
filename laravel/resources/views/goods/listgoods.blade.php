@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading h2">Список товаров</div>

                <div class="panel-body">
                    {{--@inject('Auth', 'App\Http\Controllers\Auth')--}}
                    {{--@if(Auth::user()->is_admin == "1")--}}
                        {{--<a href="/admin" class="btn btn-default">АДМИНКА</a>--}}
                    {{--@endif--}}
                    <table class="table">
                        <tr>
                            <th>Название товара</th>
                            <th>Цена товара</th>
                            <th>Картинка</th>
                            <th>Описание товара</th>
                            <th>Выбрать товар</th>

                            @if(Auth::user()->is_admin == "1")
                                <th>Редактировать товар</th>
                                <th>Удалить товар</th>
                            @endif
                        </tr>

                        @foreach($goods as $good)
                            <tr>
                                <td>{{$good->name}}</td>
                                <td>{{$good->price}}</td>
                                <td>{{$good->image}}</td>
                                <td>{{$good->desc}}</td>
                                <td><a href="/goods/view/{{$good->id}}" class="btn btn-default">Выбрать</a></td>

                                @if(Auth::user()->is_admin == "1")
                                    <td><a href="/admin/edit/{{$good->id}}" class="btn btn-default" style="background-color: red; color:white;">Редактировать</a></td>
                                    <td><a href="/admin/destroy/{{$good->id}}" class="btn btn-default" style="background-color: red; color:white;">Удалить</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                    <a href="/goods/categories" class="btn btn-default">Список категорий</a>

                    @if(Auth::user()->is_admin == "1")
                    <a href="/admin/create-good" class="btn btn-primary" style="background-color: red">Создать товар</a>

                    @endif
                    {{--<a href="/admin/edit/{{$post->id}}" class="btn btn-primary" style="background-color: red">Edit</a>--}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
