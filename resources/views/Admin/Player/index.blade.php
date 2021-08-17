
@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>{{$team->team_name}}</h3>

                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success btn-sm mb-3 " href="{{ route('teams.players.create',$team->id)}}"><i class="fa fa-plus"></i>Add New Player</a>
                    <a class="btn btn-primary btn-sm mb-3 " href="{{ route('player.excel.upload',$team->id)}}"><i class="fa fa-plus"></i>Bulk Upload</a>
                    <a style=" float: right" class="btn btn-success btn-sm mb-3 " href="/admin/teams/{{$team->id}}/players/exist_create"><i class="fa fa-plus"></i>Add Existing Player</a>

                    <div class="tables">
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Image</th>
                                    <th>Player Id</th>
                                    <th>Player Name</th>
                                    <th>Player Role</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                @foreach($players as $p)
                                    <tr>

                                        <th scope="row">{{$i}}</th>
                                        <td><img height="50px" width=50px" src="{{ $p->getFirstMedia('player-image') ? $p->getFirstMedia('player-image')->getUrl('player-profile') : asset("images/avatar.png") }}"></td>
                                        <td>{{$p->player_id}}</td>
                                        <td>{{$p->first_name}} {{$p->last_name}}</td>
                                        <td>{{$p->Role->name}}</td>
                                        <td>
                                            <a class="btn btn-warning btn-sm" href="/admin/teams/{{$team->id}}/players/{{$p->id}}">Detail</a>
                                            <a class="btn btn-success btn-sm" href="/admin/teams/{{$team->id}}/players/{{$p->id}}/edit">Edit</a>
                                            <form style="display:inline-block" method="POST" action="/admin/teams/{{$team->id}}/players/{{$p->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <!-- <input type="hidden" value="#" name="id"> -->
                                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this player ?');">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                    @php($i++)
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@section('js')

@endsection

