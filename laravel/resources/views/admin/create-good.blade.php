@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Создать товар</div>

                <div class="panel-body">
                    @foreach($errors->all() as $error)
                        <li style="color:red">{{$error}}</li>
                    @endforeach
                    <form action="/admin/store-good" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="text" name="name" class="input-group" placeholder="Наименование товара">
                        <input type="number" name="category_id" class="input-group" placeholder="ID категории">
                        <input type="number" name="price" class="input-group" placeholder="Цена">
                        <textarea name="desc" class="input-group" placeholder="Описание"></textarea>
                        <input type="file" name="good_image">
                        <input type="submit" value="ok">
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
