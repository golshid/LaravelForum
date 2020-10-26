@extends('layouts.app')
@section('content')

<div class="card card-light">
    <div class="card-header">
        <img style="border-radius:50%;" src="{{$d->user->avatar}}" alt="" width="40px" height="40px">&nbsp;&nbsp;
        <span>{{$d->user->name}}, {{$d->created_at->diffForHumans()}}</span>
    </div>
    <div class="card-body">
        <h4 class="text-center">{{ $d->title}}</h4>
        <hr>
        <p class="text-justify">{{$d->content}}</p>
    </div>
</div>
@endsection
