@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Один товар</div>

                <div class="panel-body">
                    <a href="/admin/create" class="btn btn-primary">Create</a>
                    <a href="/admin/edit/{{$good->id}}" class="btn btn-primary">Edit</a>
                    <ul>
                           <li>
                               {{$good->id}}
                               {{$good->name}}
                               {{$good->price}}
                               {{$good->desc}}
                           </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
