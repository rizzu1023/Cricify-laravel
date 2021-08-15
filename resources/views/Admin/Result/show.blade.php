

{{--    <style>--}}
{{--        .tables {--}}
{{--            margin-top: 20px;--}}
{{--        }--}}

{{--        .ftable {--}}
{{--            margin-top: 20px;--}}
{{--        }--}}

{{--        .toss {--}}
{{--            margin: 10px 0;--}}
{{--            padding: 10px 0;--}}
{{--            border: 1px solid gray;--}}
{{--        }--}}

{{--        .team-name {--}}
{{--            /* background: lightgray; */--}}
{{--            padding: 20px 10px;--}}
{{--        }--}}

{{--        .team-name h3 {--}}
{{--            display: inline-block;--}}
{{--            margin-top: 10px;--}}
{{--        }--}}

{{--        .team-name span {--}}
{{--            float: right;--}}
{{--            background: lightblue;--}}
{{--            padding: 10px;--}}
{{--            margin-right: 100px;--}}
{{--        }--}}

{{--    </style>--}}


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
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i
                                        data-feather="home"></i></a></li>
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
                <div class="mb-1">
                    @include('Admin.layouts.message')
                    @include('Admin.layouts.error')
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="r3_counter_box">
                                    <div class="stats">
                                        <span>Match</span>
                                        <h5><strong>{{$match->match_id}}</strong></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="r3_counter_box">
                                    <div class="stats">
                                        <span>Toss</span>
                                        <h5><strong>{{$match->Teams->team_code}}</strong></h5>
                                        @if($match->status == 0)

                                        <form method="post" action="{{ Route("update.toss") }}">
                                            @csrf
                                            <select name="toss" onchange="this.form.submit();">
                                                <option selected disabled>Select</option>
                                                @foreach($match_detail as $md)
                                                    <option value="{{$md->team_id}}">{{$md->Teams->team_code}}</option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" value="{{$match->match_id}}" name="match_id">
                                        </form>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="r3_counter_box">
                                    <div class="stats">
                                        <span>First</span>
                                        <h5><strong>{{$match->choose}}</strong></h5>
                                        @if($match->status == 0)
                                        <form method="post" action="{{ Route("update.choose") }}">
                                            @csrf
                                            <select name="choose" onchange="this.form.submit();">
                                                <option selected disabled>Select</option>
                                                <option value="Bat">Batting</option>
                                                <option value="Bowl">Bowling</option>
                                            </select>
                                            <input type="hidden" value="{{$match->match_id}}" name="match_id">
                                        </form>
                                            @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="r3_counter_box ">
                                    <div class="stats">
                                        <span>Overs</span>
                                        {{--                      <h5><strong>{{$match->overs}}</strong></h5>--}}
                                        @if($match->status == 0)
                                        <form method="post" action="{{ Route('update.overs') }}">
                                            @csrf
                                            <h5><input type="number" value="{{$match->overs}}" name="overs"/></h5>
                                            <input type="hidden" name="match_id" value="{{$match->match_id}}">
                                            <button type="submit" class="btn btn-sm btn-success">Update</button>
                                        </form>
                                            @else
                                            <h4>{{$match->overs}}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="r3_counter_box">
                                    <div class="stats">
                                        <span>Won</span>
                                        <h5><strong{{$match->won}}</strong></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 ">
                                <div class="r3_counter_box">
                                    <div class="stats">
                                        <span>MOM</span>
                                        <h5><strong>{{$match->mom}}</strong></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row"> -->
                    <div class="col-md-12">
                        <div class="r3_counter_ox" style="height:30px;background:white;">
                            <div class="text-center">
{{--							<span>India Beat Australia by 31 runs<span>--}}
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="tables ftable">
                            <div class="panel-body widget-shadow">
                                <div class="col-md-12 team-name"><h3>{{$match_detail[0]->Teams->team_name}}</h3><span>Total {{$match_detail[0]->score}}-{{$match_detail[0]->wicket}} ({{$match_detail[0]->over}}.{{$match_detail[0]->overball}})</span>
                                </div>
                                <div>
                                    <form method="post" action="{{Route('update.score')}}">
                                        @csrf
                                        <label>Score : </label>
                                        <input type="number" name="score" value="{{$match_detail[0]->score}}"><br>
                                        <label>Wicket :</label>
                                        <input type="number" value="{{$match_detail[0]->wicket}}" name="wicket"><br>
                                        <label>Over : </label>
                                        <input type="number" value="{{$match_detail[0]->over}}" name="over"><br>
                                        <label>Ball : </label>
                                        <input type="number" value="{{$match_detail[0]->overball}}" name="overball"><br>
                                        <input type="hidden" value="{{$match_detail[0]->team_id}}" name="team_id">
                                        <input type="hidden" value="{{$match_detail[0]->match_id}}" name="match_id">
                                        <input type="hidden" value="{{$match_detail[0]->tournament_id}}" name="tournament_id">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </form>
                                </div>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Player Name</th>
                                        <th>Runs</th>
                                        <th>Balls</th>
                                        <th>Fours</th>
                                        <th>Sixes</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($single_result as $sr)
                                        @if($sr->team_id == $match_detail[0]->team_id)
                                            <tr>
                                                <td>
                                                    <form method="post" action="{{Route('update.player')}}">
                                                        @csrf
                                                        <select name="sub_player" onchange="this.form.submit()">
                                                            <option selected disabled>{{$sr->Players['first_name']}} {{$sr->Players['last_name']}}</option>
                                                            @foreach($subs1_players as $sp)
                                                                @if($sp->player_id != $sr->Players['player_id'])
                                                                    <option
                                                                        value="{{$sp['player_id']}}">{{$sp['first_name']}} {{$sp['last_name']}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" value="{{$sr['player_id']}}" name="player_id">
                                                        <input type="hidden" value="{{$sr['team_id']}}" name="team_id">
                                                        <input type="hidden" value="{{$sr['match_id']}}" name="match_id">
                                                        <input type="hidden" value="{{$sr['tournament_id']}}"
                                                               name="tournament_id">
                                                    </form>

                                                </td>
                                                <td>{{$sr->bt_runs}}</td>
                                                <td>{{$sr->bt_balls}}</td>
                                                <td>{{$sr->bt_fours}}</td>
                                                <td>{{$sr->bt_sixes}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tables">
                                <div class="panel-body widget-shadow">
                                    <div class="col-md-12 team-name"><h3>{{$match_detail[1]->Teams->team_name}}</h3><span>Total {{$match_detail[1]->score}}-{{$match_detail[1]->wicket}} ({{$match_detail[1]->over}}.{{$match_detail[1]->overball}})</span>
                                    </div>
                                    <div>
                                        <form method="post" action="{{Route('update.score')}}">
                                            @csrf
                                            <label>Score : </label>
                                            <input type="number" name="score" value="{{$match_detail[1]->score}}"><br>
                                            <label>Wicket :</label>
                                            <input type="number" value="{{$match_detail[1]->wicket}}" name="wicket"><br>
                                            <label>Over : </label>
                                            <input type="number" value="{{$match_detail[1]->over}}" name="over"><br>
                                            <label>Ball : </label>
                                            <input type="number" value="{{$match_detail[1]->overball}}" name="overball"><br>
                                            <input type="hidden" value="{{$match_detail[1]->team_id}}" name="team_id">
                                            <input type="hidden" value="{{$match_detail[1]->match_id}}" name="match_id">
                                            <input type="hidden" value="{{$match_detail[1]->tournament_id}}"
                                                   name="tournament_id">
                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </div>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Player Name</th>
                                            <th>Runs</th>
                                            <th>Balls</th>
                                            <th>Fours</th>
                                            <th>Sixes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($single_result as $sr)
                                            @if($sr->team_id == $match_detail[1]->team_id)
                                                <tr>
                                                    <td>
                                                        <form method="post" action="{{Route('update.player')}}">
                                                            @csrf
                                                            <select name="sub_player" onchange="this.form.submit()">
                                                                <option selected disabled>{{$sr->Players->first_name}} {{$sr->Players->last_name}}</option>
                                                                @foreach($subs2_players as $sp)
                                                                    @if($sp->player_id != $sr->Players->player_id)
                                                                        <option
                                                                            value="{{$sp->player_id}}">{{$sp->first_name}} {{$sp->last_name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" value="{{$sr->player_id}}" name="player_id">
                                                            <input type="hidden" value="{{$sr->team_id}}" name="team_id">
                                                            <input type="hidden" value="{{$sr->match_id}}" name="match_id">
                                                            <input type="hidden" value="{{$sr->tournament_id}}"
                                                                   name="tournament_id">
                                                        </form>
                                                    </td>
                                                    <td>{{$sr->bt_runs}}</td>
                                                    <td>{{$sr->bt_balls}}</td>
                                                    <td>{{$sr->bt_fours}}</td>
                                                    <td>{{$sr->bt_sixes}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <form action="{{route('result.destroy')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$match->match_id}}" name="match_id">
                            <input type="hidden" value="{{$match->tournament_id}}" name="tournament">
                            <button class="btn btn-sm btn-danger">Delete Result</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
