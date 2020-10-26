@extends('layouts.app')

@section('content')
{{-- Show Question --}}
{{-- http://laravelforum.test/discussion/{slug} --}}


<div class="card">
    <div class="card-body d-flex flex-row">
        <div class="p-2">
            <div class="d-flex flex-column">
                <div class="p-2 col-1">
                    @if ($d->dis_is_liked_by_auth_user())
                    <a href="{{route('discussion.unlike',['id'=>$d->id])}}" class="btn btn-outline-danger btn-sm">Dislike <span
                            class="badge badge-light">{{$d->likes->count()}}</span></a>
                    
                    @elseif($d->dis_is_disliked_by_auth_user())
                    <a href="{{route('discussion.undislike',['id'=>$d->id])}}" class="btn btn-outline-success btn-sm">Undislike <span
                            class="badge badge-light">{{$d->dislikes->count()}}</span></a>
                    @else
                    <a href="{{route('discussion.like',['id'=>$d->id])}}" class="btn btn-outline-success btn-sm">Like <span
                            class="badge badge-light">{{$d->likes->count()}}</span></a>
                    <a href="{{route('discussion.dislike',['id'=>$d->id])}}" class="btn btn-outline-danger mt-1 btn-sm">Dislike <span
                            class="badge badge-light">{{$d->dislikes->count()}}</span></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="p-2 ml-2">
            <div class="d-flex flex-column">
                <a class="mt-2" style="text-decoration:none; color:#326273;"
                    href="{{route('discussion',['slug'=>$d->slug])}}">
                    <h5>{{ $d->title}}</h5>
                    <hr>
                </a>
                <div class="d-flex flex-row text-justify">
                    {{ $d->content}}
                </div>
                <div class="d-flex flex-row">
                    <a href="{{route('channel',['slug'=>$d->channel->slug])}}"
                        class=" btn p-2 mt-1 btn-light btn-sm">{{$d->channel->title}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <img style="border-radius:50%;" src="{{$d->user->avatar}}" alt="" width="30px" height="30px">&nbsp;&nbsp;
        <span>{{$d->user->name}}, {{$d->created_at->diffForHumans()}}</span>
        @auth
            @if (Auth::user()->admin > 0)
                @if($d->open == 1)
                <a href="{{ route('discussion.close', ['id' => $d->id ]) }}"
                    class="btn btn-outline-danger btn-sm float-right ml-2 ">Close Discussion</a>
                @else
                <a href="{{ route('discussion.open', ['id' => $d->id ]) }}"
                    class="btn btn-outline-success btn-sm float-right ml-2 ">Open Discussion</a>
                @endif
            @endif
            @if(Auth::id() == $d->user->id)
            <a href="{{ route('discussion.edit', ['slug' => $d->slug ]) }}"
                class="btn btn-outline-info btn-sm float-right">Edit</a>
            @endif
        @endauth
    </div>
</div>
<br>


 {{-- Show Replies --}}   

@foreach (array_keys($array) as $key)
    @foreach ($d->replies as $r)
        @if ($key == $r->content)
        <br>
        <div class="card">
            <div class="card-body d-flex flex-row">
                <div class="p-2">
                    <div class="d-flex flex-column">
                        <div class="p-2 col-1">
                            @if ($r->is_liked_by_auth_user())
                            <a href="{{route('reply.unlike',['id'=>$r->id])}}" class="btn btn-outline-danger btn-sm">Dislike <span
                                    class="badge badge-light">{{$r->likes->count()}}</span></a>
                            
                            @elseif($r->is_disliked_by_auth_user())
                            <a href="{{route('reply.undislike',['id'=>$r->id])}}" class="btn btn-outline-success btn-sm">Undislike <span
                                    class="badge badge-light">{{$r->dislikes->count()}}</span></a>
                            
                            @else
                            <a href="{{route('reply.like',['id'=>$r->id])}}" class="btn btn-outline-success btn-sm">Like <span
                                    class="badge badge-light">{{$r->likes->count()}}</span></a>
                            <a href="{{route('reply.dislike',['id'=>$r->id])}}" class="btn btn-outline-danger mt-1 btn-sm">Dislike <span
                                    class="badge badge-light">{{$r->dislikes->count()}}</span></a>
                            
                            @endif
                        </div>
                    </div>
                </div>

                <div class="p-2 ml-2">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row text-justify">
                            {{ $r->content}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <img style="border-radius:50%;" src="{{$r->user->avatar}}" alt="" width="30px" height="30px">&nbsp;&nbsp;
                <span>{{$r->user->name}}, {{$r->created_at->diffForHumans()}}</span>
                @auth
                @if(Auth::id() == $r->user->id || Auth::user()->admin > 0)
                <a href="{{ route('reply.delete', ['id'=>$r->id]) }}"
                    class="btn btn-outline-danger btn-sm float-right ml-2 ">Delete</a>
                @endif
                @if(Auth::id() == $r->user->id)
                <a href="{{ route('reply.edit', ['id' => $r->id ]) }}" class="btn btn-outline-info btn-sm float-right ">Edit</a>
                @endif
                @endauth
            </div>
        </div>
        <br>
        @endif
    @endforeach
@endforeach
  
    {{-- Leave a reply --}}
<br>
@if($d->open == 1)
    <div class="card card-primary">
        <div class="card-body">
            @if(Auth::check())
                <form action="{{route('discussion.reply',['id'=>$d->id])}}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('POST')}}
                    <div class="form-group">
                        <label for="reply">Leave a reply</label>
                        <textarea name="reply" id="reply" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn float-right">Leave a reply</button>
                    </div>
                </form>
            @else
                <div class="text-center">
                   <a href="/login" style="text-decoration:none;"><h5>Sign in to leave a reply</h5></a>
                </div>
            @endif
        </div>
    </div>
@endif
        
@endsection