

@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>
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
                <div class="card-header">
                    @if($player->getFirstMedia('player-image'))
                        <img src="{{ $player->getFirstMedia('player-image')->getUrl('player-profile') }}">
                    @endif
                </div>
                    <div class="card-body">
                        <h1 class="title1 text-center">{{$player['first_name']}} {{$player['last_name']}}</h1>

                        <div class="">
                            <form action="/admin/player/add-in-team" method="post">
                                @csrf
                                <select class="form-control" id="exampleFormControlSelect2" name="team_id"
                                        required onchange="this.form.submit()">
                                    <option disabled selected>Add in Team</option>
                                    @foreach($teams as $t)
                                        <option
                                            value="{{$t->id}}">{{$t->team_name}}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="player_id" value="{{$player['id']}}">
                            </form>
                            <table class="table table-sm table-striped" style="margin-top:50px;">
                                <thead>
                                <tr class="bg-dark">
                                    <th scope="col">Teams</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($player_teams as $t)
                                    <tr>
                                        <td>{{$t->team_name}}</td>
                                        <td>
                                            <form action="/admin/player/remove-from-team" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm text-white">Remove</button>
                                                <input type="hidden" name="player_id" value="{{$player['id']}}">
                                                <input type="hidden" name="team_id" value="{{$t->id}}">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="">

                            <table class="table table-sm table-striped" style="margin-top:50px;">
                                <thead >
                                <tr class="">
                                    <th scope="col">Personal Information</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Born</td>
                                    <td>{{$player['dob']}}</td>
                                </tr>
                                <tr>
                                    <td>Age</td>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <td>ID</td>
                                    <td>{{$player['player_id']}}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>{{$player->Role ? $player->Role->name : NULL}}</td>
                                </tr>
                                <tr>
                                    <td>Bowling Style</td>
                                    <td>{{$player->BattingStyle ? $player->BattingStyle->name : NULL}}</td>
                                </tr>
                                <tr>
                                    <td>Bowling Style</td>
                                    <td>{{$player->BowlingStyle ? $player->BowlingStyle->name : NULL}}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>Teams</td>--}}
{{--                                </tr>--}}
                                </tbody>
                            </table>
                        </div>


                        <div class="">

                            <table class="table table-sm table-striped" style="margin-top:50px;">
                                <thead>
                                <tr class="">
                                    <th scope="col">Batting</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Matches</td>
                                    <td>{{optional($bt)->bt_matches}}</td>
                                </tr>
                                <tr>
                                    <td>Innings</td>
                                    <td>{{optional($bt)->bt_innings}}</td>

                                </tr>
                                <tr>
                                    <td>Runs</td>
                                    <td>{{optional($bt)->id}}</td>
                                </tr>
                                <tr>
                                    <td>Balls</td>
                                    <td>{{optional($bt)->bt_balls}}</td>

                                </tr>
                                <tr>
                                    <td>Highest</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>Average</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>SR</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>Not Out</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>Fours</td>
                                    <td>{{optional($bt)->bt_fours}}</td>

                                </tr>
                                <tr>
                                    <td>Sixes</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>Ducks</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>50s</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                <tr>
                                    <td>100s</td>
                                    <td>{{optional($bt)->id}}</td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="">

                            <table class="table table-sm table-striped" style="margin-top:50px;">
                                <thead>
                                <tr class="">
                                    <th scope="col">Bowling</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Matches</td>
                                    <td>{{optional($bw)->bw_matches}}</td>

                                </tr>
                                <tr>
                                    <td>Innings</td>
                                    <td>{{optional($bw)->bw_innings}}</td>

                                </tr>
                                <tr>
                                    <td>Runs</td>
                                    <td>{{optional($bw)->id}}</td>
                                </tr>
                                <tr>
                                    <td>Balls</td>
                                    <td>{{optional($bw)->bw_balls}}</td>

                                </tr>
                                <tr>
                                    <td>Maidens</td>
                                    <td>{{optional($bw)->id}}</td>
                                </tr>
                                <tr>
                                    <td>wickets</td>
                                    <td>{{optional($bw)->bw_wickets}}</td>
                                </tr>
                                <tr>
                                    <td>Average</td>
                                    <td>{{optional($bw)->id}}</td>

                                </tr>
                                <tr>
                                    <td>Economy</td>
                                    <td>{{optional($bw)->id}}</td>

                                </tr>
                                <tr>
                                    <td>SR</td>
                                    <td>{{optional($bw)->id}}</td>
                                </tr>
                                <tr>
                                    <td>BBI</td>
                                    <td>{{optional($bw)->id}}</td>
                                </tr>
                                <tr>
                                    <td>4w</td>
                                    <td>{{optional($bw)->id}}</td>
                                </tr>
                                <tr>
                                    <td>5w</td>
                                    <td>{{optional($bw)->id}}</td>
                                </tr>

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

