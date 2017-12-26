@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading h2">Список категорий</div>

                <div class="panel-body">

                    <table class="table">
                        <tr>
                            <th>Название категории</th>
                            <th>Описание категории</th>
                            @if(Auth::user()->is_admin == "1")
                                <th>Редактировать товар</th>
                                <th>Удалить товар</th>
                            @endif
                        </tr>

                        @foreach($cats as $cat)
                            <tr>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->desc}}</td>
                                @if(Auth::user()->is_admin == "1")
                                    <td><a href="/admin/edit-cat/{{$cat->id}}" class="btn btn-default" style="background-color: red; color:white;">Редактировать</a></td>
                                    <td><a href="/admin/destroy-cat/{{$cat->id}}" class="btn btn-default" style="background-color: red; color:white;">Удалить</a></td>
                                @endif
                            </tr>
                        @endforeach
                    </table>
                    <a href="/goods" class="btn btn-default">Список товаров</a>

                    @if(Auth::user()->is_admin == "1")

                        <a href="/admin/create-cat" class="btn btn-primary" style="background-color: red">Создать категорию</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
