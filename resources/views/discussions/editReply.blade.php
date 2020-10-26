@extends('layouts.app')

{{-- Editing Reply --}}
{{-- http://laravelforum.test/reply/edit/{id} --}}

@section('content')

<div class="card">
    <div class="card-header text-center"><h5> Edit Reply </h5></div>

    <div class="card-body">
        <form action="{{route('reply.update',['id'=>$reply->id])}}" method="GET">
            {{ csrf_field() }}
            {{ method_field('GET') }}

            <div class="form-group">
                <textarea name="content" id="content" cols="30" rows="10"
                    class="form-control">{{ $reply->content }}</textarea>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-success" type="submit">Save Reply Changes</button>
            </div>
        </form>
    </div>
</div>

@endsection