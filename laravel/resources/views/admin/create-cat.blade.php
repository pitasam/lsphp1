@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Создать категорию</div>

                <div class="panel-body">
                    @foreach($errors->all() as $error)
                        <li style="color:red">{{$error}}</li>
                    @endforeach
                    <form action="/admin/store-cat" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="text" name="name" class="input-group" placeholder="Наименование категории">
                        <input type="text" name="desc" class="input-group" placeholder="Описание категории">

                        <input type="submit" value="ok">
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
