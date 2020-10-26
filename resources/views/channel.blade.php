@extends('layouts.app')

{{-- Showing discussions of each channel --}}
{{-- http://laravelforum.test/channel/{slug} --}}

@section('content')

@foreach ($discussions as $d)
    @if ($d->state == 1)
        <div class="card">
            <div class="card-body d-flex flex-row">
                <div class="p-2">
                    <div class="d-flex flex-column">
                        <div class="p-2 col-1"><button class="btn-light btn-outline-success btn" disabled>
                            {{($d->likes->count()) - ($d->dislikes->count())}}</button></div>
                        <div class="p-2">
                            <h6>Votes</h6>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <div class="d-flex flex-column">
                        <div class="p-2 col-1"><button class="btn-light btn-outline-success btn"
                            disabled>{{$d->replies->count()}}</button></div>
                        <div class="p-2">
                            <h6>Answers</h6>
                        </div>
                    </div>
                </div>
                <div class="p-2 ml-2">
                    <div class="d-flex flex-column">
                        <a class="mt-2" style="text-decoration:none; color:#326273;"
                            href="{{route('discussion',['slug'=>$d->slug])}}">
                        <h5>{{ $d->title}}</h5>
                        </a>
                        <div class="d-flex flex-row">
                            <a href="{{route('channel',['slug'=>$d->channel->slug])}}"
                                class=" btn p-2 mt-1 btn-light btn-sm">{{$d->channel->title}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <img style="border-radius:50px;" src="{{$d->user->avatar}}" alt="" width="30px" height="30px">&nbsp;&nbsp;
                <span>{{$d->user->name}}, {{$d->created_at->diffForHumans()}}</span>
            </div>
        </div>
        <br>
    @endif
@endforeach

<div class="text-center row  justify-content-center my-5">
    {{$discussions->links()}}
</div>

@endsection