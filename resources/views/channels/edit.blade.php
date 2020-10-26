@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Edit Channel: {{$channel->title}}</div>

    <div class="card-body">
        <form action="{{route('something.update',['channel'=>$channel->id])}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="from-group">
                <input type="text" name="channel" value="{{$channel->title}}" class="form-control">
            </div>
            <div class="form-group">
                <div class="text-center">
                    <button class="btn-success my-3 btn" type="submit">
                        Update channel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection