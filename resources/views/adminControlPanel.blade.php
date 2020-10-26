@extends('layouts.app')
@section('content')
    

<div class="card bg-light text-center">
    <div class="btn-group-lg d-flex" role="group">
        @if (Auth::user()->admin == 2)
            <button type="button" style="background-color:#348AA7;" id="button1" class="btn m-1 flex-fill btn-secondary" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">Promote User</button>
        @endif
        <button type="button" style="background-color:#5DD39E;" id="button2" class="btn m-1 flex-fill btn-secondary" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">Block User</button>
        <button type="button" style="background-color:#BCE784;" id="button3" class="btn m-1 flex-fill btn-secondary" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">Discussion Approval</button>
    </div>
    <div class="collapse mt-3" id="collapseExample1">
        <div class="card card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Username
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Moderator
                    </th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @if ($user->admin < 2)
                            <tr>
                                <td>{{ $user->name}}</td>
                                <td>{{ $user->email}}</td>
                                <td>
                                    @if ($user->admin == 0)
                                        <form action="{{route('user.promote',['id'=>$user->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <button class="btn btn-xs text-white" type="submit" style="background-color:#7EE081;">Promote</button>
                                        </form>
                                    @else 
                                        <form action="{{route('user.demote',['id'=>$user->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <button class="btn btn-xs text-white btn-danger" type="submit">Demote</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="collapse mt-3" id="collapseExample2">
        <div class="card card-body">
            <table class="table table-hover">
                <thead>
                    <th>
                        Username
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Block
                    </th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @if ($user->admin == 0)
                            <tr>
                                <td>{{ $user->name}}</td>
                                <td>
                                    {{ $user->email}}
                                </td>
                                <td>
                                    @if ($user->status == 1)
                                        <form action="{{route('user.block',['id'=>$user->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <button class="btn btn-xs btn-danger text-white" type="submit">Block</button>
                                        </form>
                                    @else 
                                        <form action="{{route('user.unblock',['id'=>$user->id])}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('POST')}}
                                            <button class="btn btn-xs text-white" style="background-color:#7EE081;" type="submit">Unblock</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="collapse mt-3" id="collapseExample3">
        <div class="card card-body">
            @if ($status->isEmpty())
                <h6>There is no discussion to approve at this time.</h6>
            @else
                <table class="table table-hover">
                    <thead>
                        <th>
                            Username
                        </th>
                        <th>
                            Channel
                        </th>
                        <th>
                            View
                        </th>
                        <th>
                            Approve
                        </th>
                    </thead>
                    <tbody>
                        @foreach($status as $state)
                            @if ($state->user-> admin == 0) <tr>
                                <td>
                                    {{ $state->user->name}}
                                </td>
                                <td>
                                    {{ $state->channel->title}}
                                </td>
                                <td>
                                    <a href="{{route('viewAdmin',['id'=>$state->id])}}" class="btn btn-light">View</a>
                                </td>
                                <td>
                                    <form action="{{route('adminApprove',['id'=>$state->id])}}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('POST')}}
                                    <button class="btn btn-xs text-white" type="submit"
                                        style="background-color:#7EE081;">Approve</button>
                                    </form> 
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>




<script>
    $("#button1").click(function(){
        $("#collapseExample1").collapse('show');
        $("#collapseExample2").collapse('hide');
        $("#collapseExample3").collapse('hide'); });

    $("#button2").click(function(){
        $("#collapseExample1").collapse('hide');
        $("#collapseExample2").collapse('show');
        $("#collapseExample3").collapse('hide'); });
    
    $("#button3").click(function(){
        $("#collapseExample1").collapse('hide');
        $("#collapseExample2").collapse('hide');
        $("#collapseExample3").collapse('show'); });
</script>
@endsection

