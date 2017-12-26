@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Редактировать товар</div>

                <div class="panel-body">
                    @foreach($errors->all() as $error)
                        <li style="color:red">{{$error}}</li>
                    @endforeach
                    <form action="/admin/update/{{$good->id}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="text" name="name" class="input-group" value="{{$good->name}}">
                        <input type="number" name="category_id" class="input-group" value="{{$good->category_id}}">
                        <input type="number" name="price" class="input-group" value="{{$good->price}}">
                        <input type="file" name="good_image" class="input-group" value="{{$good->image}}">
                        <input type="text" name="desc" class="input-group" value="{{$good->desc}}">
                        <input type="submit" value="ok">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
