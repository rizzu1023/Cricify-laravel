@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Add Existing Player</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/admin/teams/{{$team->id}}/players">Squad</a></li>
                            <li class="breadcrumb-item active">Existing Player</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="title1">{{ $team->team_name }}</h3>
                </div>
                <div class="card-body">
                    @include('Admin.layouts.message')


                    <form action="/admin/teams/{{$team->id}}/players/exist_store" method="post">
                        @csrf
                        <select class="form-control" id="exampleFormControlSelect2" name="player_id"
                                required onchange="this.form.submit()">
                            <option disabled selected>Add in Team</option>
                            @foreach($players as $p)
                                <option
                                    value="{{$p->player_id}}">{{$p->first_name}} {{$p->last_name}}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
