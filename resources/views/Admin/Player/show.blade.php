


@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3 class="title1 text-center">{{$player['first_name']}} {{$player['last_name']}}</h3>
                        <h4 class="title1 text-center" >({{ $team->team_name }})</h4>
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
                        <div class="">

                            <table class="table table-sm table-striped" style="margin-top:50px;">
                                <thead>
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
                                    <td>0</td>
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
                                <tr>
                                    <td>Teams</td>
                                    <td>@foreach($teams as $t){{$t->Teams->team_name}}, @endforeach</td>
                                </tr>
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
                                    <td>{{$bt['bt_matches']}}</td>
                                </tr>
                                <tr>
                                    <td>Innings</td>
                                    <td>{{$bt['bt_innings']}}</td>
                                </tr>
                                <tr>
                                    <td>Runs</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Balls</td>
                                    <td>{{$bt['bt_balls']}}</td>
                                </tr>
                                <tr>
                                    <td>Highest</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Average</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>SR</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Not Out</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Fours</td>
                                    <td>{{$bt['bt_fours']}}</td>
                                </tr>
                                <tr>
                                    <td>Sixes</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Ducks</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>50s</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>100s</td>
                                    <td>0</td>
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
                                    <td>{{$bw['bw_matches']}}</td>
                                </tr>
                                <tr>
                                    <td>Innings</td>
                                    <td>{{$bw['bw_innings']}}</td>
                                </tr>
                                <tr>
                                    <td>Runs</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Balls</td>
                                    <td>{{$bw['bw_balls']}}</td>
                                </tr>
                                <tr>
                                    <td>Maidens</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>wickets</td>
                                    <td>{{$bw['bw_wickets']}}</td>
                                </tr>
                                <tr>
                                    <td>Average</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Economy</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>SR</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>BBI</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>4w</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>5w</td>
                                    <td>0</td>
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
