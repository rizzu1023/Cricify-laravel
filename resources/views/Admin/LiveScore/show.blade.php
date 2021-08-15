@section('css')
@endsection
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
                    @include('Admin.layouts.message')
                    <div class="row">

                @if($game->status == '1' || $game->status == '3')
                        <div class="col-6">
                            <a href="/admin/LiveScoreCard/{{$game->match_id}}/{{$game->tournament_id}}"
                               class="btn btn-info btn-sm"
                            >Scorecard</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success btn-sm"
                               href="/admin/result/{{$game->tournament_id}}/{{$game->match_id}}/show">Edit</a>
                        </div>

                        <div class="col-6 mt-1">
                            <form id="endInningForm" style="display: inline-block;">
                                @csrf
                                <input type="hidden" name="endInning" value="1">
                                <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">
                                <button type="submit" class="btn btn-danger btn-sm "
                                        onclick="return confirm('Are you sure?')">End Inning
                                </button>
                            </form>
                        </div>

                        <div class="col-6 mt-1">
                            <form id="resetInningForm" style="display: inline-block;">
                                @csrf
                                <input type="hidden" name="resetInning" value="1">
                                <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">
                                <input type="hidden" name="bt_team_id" value="{{$batting_team_id}}">
                                <input type="hidden" name="bw_team_id" value="{{$bowling_team_id}}">
                                <button type="submit" class="btn btn-secondary btn-sm"
                                        onclick="return confirm('Are you sure?')">Reset Inning
                                </button>
                            </form>
                        </div>

                    @elseif($game->status == '2')
                        <span>First Inning has Been ended</span>
                    @elseif($game->status == '4')
                        <span>Match has Been ended </span>
                        <h4 class="mt-3">{{$game->WON->team_name}} {{$game->description}}</h4>

                        @if($game->mom != '--')
                            <h4 class="mt-5">Man of the Match
                                : {{$game->MOM['first_name']}} {{$game->MOM['last_name']}}</h4>
                        @endif
                        <div class="form-body mt-5">
                            <form method="POST" action="{{ Route('select.mom') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <select class="form-control" id="exampleFormControlSelect2" name="mom"
                                                    required>
                                                <option value="">Select Man of the Match</option>
                                                @foreach($game->MatchPlayers as $mp)
                                                    @if($mp->team_id == $game->won)
                                                        <option
                                                            value="{{$mp->player_id}}">{{ $mp->Players['first_name'] }} {{ $mp->Players['last_name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                            <input type="hidden" name="tournament_id"
                                                   value="{{$game['tournament_id']}}">

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        @if($game->mom == '--')
                                            <button type="submit" class="btn  btn-success">Select</button>
                                        @else
                                            <button type="submit" class="btn  btn-success">Change</button>
                                        @endif

                                    </div>
                                </div>

                            </form>
                        </div>
                    @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <!-- Opening Modal -->
                    <div class="modal  " id="openingModal" tabindex="-1" data-backdrop="false" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Select Opening Batsman & Bowler</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="modal">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 single-div">
                                                <h5>Select opening batsman</h5><br>

                                                <label for="exampleFormControlSelect2">Select Striker</label>
                                                <select class="form-control" id="exampleFormControlSelect2"
                                                        name="strike_id"
                                                        required>
                                                    <option disabled selected>Select Striker</option>
                                                    @foreach($game->MatchPlayers as $mp)
                                                        @if($mp->team_id == $batting_team_id)
                                                            <option
                                                                value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label for="exampleFormControlSelect2">Select Non Striker</label>
                                                <select class="form-control" id="exampleFormControlSelect2"
                                                        name="nonstrike_id"
                                                        required>
                                                    <option selected disabled>Select Non Striker</option>
                                                    @foreach($game->MatchPlayers as $mp)
                                                        @if($mp->team_id == $batting_team_id)
                                                            <option
                                                                value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-md-6 single-div">
                                                <h5>Select Bowler</h5><br>

                                                <label for="exampleFormControlSelect2">Select Bowler</label>
                                                <select class="form-control" id="exampleFormControlSelect2"
                                                        name="attacker_id"
                                                        required>
                                                    <option selected disabled>Select Bowler</option>
                                                    @foreach($game->MatchPlayers as $mp)
                                                        @if($mp->team_id == $bowling_team_id)
                                                            <option
                                                                value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                        <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">
                                        <input type="hidden" name="bw_team_id" value="{{$bowling_team_id}}">
                                        <input type="hidden" name="bt_team_id" value="{{$batting_team_id}}">
                                        <input type="hidden" name="startInning" value="1">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if($game->status == '0' || $game->status == '2')
                        {{--            <from id="startInningForm" class="text-center" style="display: block">--}}
                        {{--                <input type="hidden" name="startInning" value="1">--}}
                        {{--                <input type="hidden" name="match_id" value="{{$game['match_id']}}">--}}
                        {{--                <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">--}}
                        @if($game->status == '0')
                            <button class="btn btn-success btn-md startInningButton">Start 1st Inning</button>
                        @elseif($game->status == '2')
                            <button class="btn btn-success btn-md startInningButton">Start 2nd Inning</button>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1"
                               onclick="livescore_function('reverse_inning')">Undo</a>

                        @endif


                        {{--            </from>--}}
                    @endif

                    @if($game->status == '4')
                        {{--                <h4>xyz won by 20 runs</h4>--}}
                        <a class="btn btn-secondary btn-square btn-md mt-1"
                           onclick="livescore_function('reverse_inning')">Undo</a>
                        <a href="/admin/result/{{$game->tournament_id}}/{{$game->match_id}}/show"
                           class="btn btn-primary btn-square btn-md mt-1">Result</a>
                @endif

                @if($game->status == '1' || $game->status == '3')
                    <!-- <div class="container"> -->

                        <!-- Over Modal -->
                        <div class="modal  " id="overModal" tabindex="-1" data-backdrop="false" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Select New Bowler</h5>
                                    </div>
                                    <form id="bowlerForm">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{--                                        <label for="exampleFormControlSelect2">Select Bowler</label>--}}
                                                    <select class="form-control" id="exampleFormControlSelect2"
                                                            name="newBowler_id"
                                                            required>
                                                        <option disabled selected>Select Bowler</option>
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $bowling_team_id)
                                                                @if($mp->bw_status != 11)
                                                                    <option
                                                                        value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                            <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">
                                            <input type="hidden" name="bw_team_id" value="{{$bowling_team_id}}">
                                            <input type="hidden" name="bt_team_id" value="{{$batting_team_id}}">
                                            <input type="hidden" name="newOver" value="1">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success ">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- wicketModal -->
                        <div class="modal" id="wicketModal" tabindex="-1" data-backdrop="false" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Select New Batsman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="newBatsmanForm">
                                        <div class="modal-body">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="wicket_type">Wicket Type</label>
                                                    <select class="form-control" id="wicket_type" name="wicket_type"
                                                            required="">
                                                        <option selected disabled>Select</option>
                                                        <option value="bold">Bowled</option>
                                                        <option value="lbw">LBW</option>
                                                        <option value="catch">Catch</option>
                                                        <option value="stump">Stump</option>
                                                        <option value="runout">Run Out</option>
                                                        <option value="hitwicket">Hit Wicket</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" id="div_wicket_primary">
                                                    <label for="wicket_primary" id="label_wicket_primary"></label>
                                                    <select class="form-control" style="display: none"
                                                            id="wicket_primary"
                                                            name="wicket_primary"
                                                            required>
                                                        {{--                                            <option disabled selected>Select</option>--}}
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $bowling_team_id)
                                                                @if($mp->bw_status == '11')
                                                                    <option selected
                                                                            value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6" id="player_id" style="display: none">
                                                    <label for="wicket_primary" id="label_wicket_primary"></label>
                                                    <select class="form-control" id="wicket_primary"
                                                            name="player_id"
                                                            required>
                                                        {{--                                            <option disabled selected>Select</option>--}}
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $batting_team_id)
                                                                @if($mp->bt_status == '11')
                                                                    <option selected
                                                                            value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6" id="player_id" style="display: none">
                                                    <label for="non_striker" id="non_striker"></label>
                                                    <select class="form-control" id="non_striker"
                                                            name="non_striker_id"
                                                            required>
                                                        {{--                                            <option disabled selected>Select</option>--}}
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $batting_team_id)
                                                                @if($mp->bt_status == '10')
                                                                    <option selected
                                                                            value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>


                                                {{--                                    wicket_primary for runout--}}
                                                <div class="col-md-6" id="div_wicket_primary_runout"
                                                     style="display: none">
                                                    <label for="wicket_primary" id="label_wicket_primary">Run Out
                                                        By</label>
                                                    <select class="form-control" id="wicket_primary"
                                                            name="wicket_primary"
                                                            required>
                                                        <option disabled selected>Select</option>
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $bowling_team_id)
                                                                <option selected
                                                                        value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6" id="div_wicket_secondary">
                                                    <label for="wicket_secondary" id="label_wicket_secondary"></label>
                                                    <select class="form-control" id="wicket_secondary"
                                                            name="wicket_secondary"
                                                            required disabled>
                                                        <option disabled selected>Select</option>
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $bowling_team_id)
                                                                <option
                                                                    value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6" id="batsman_runout" style="display:none;">
                                                    <label for="wicket_primary" id="label_wicket_primary">Who got
                                                        out?</label>
                                                    <select class="form-control" id="wicket_primar"
                                                            name="batsman_runout">
                                                        <option disabled selected>Select</option>
                                                        @foreach($game->MatchPlayers as $mp)
                                                            @if($mp->team_id == $batting_team_id)
                                                                @if($mp->bt_status == 11 || $mp->bt_status == 10)
                                                                    <option
                                                                        value="{{$mp->player_id}}">{{$mp->Players['first_name']}} {{$mp->Players['last_name']}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6" id="where_batsman_runout" style="display:none;">
                                                    <label for="wicket_primary" id="where_batsman_runout_label">Where
                                                        got
                                                        out?</label>
                                                    <select class="form-control" id="wicket_primar"
                                                            name="where_batsman_runout">
                                                        <option disabled selected>Select</option>
                                                        <option value="strike">Strike</option>
                                                        <option value="non_strike">Non-Strike</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6" id="run_scored" style="display:none;">
                                                    <label for="wicket_primary" id="run_scored_label">Run Scored</label>
                                                    <select class="form-control" id="wicket_primar"
                                                            name="run_scored">
                                                        <option disabled selected>Select</option>
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>

                                                {{--                                   this is for over check for bowler--}}
                                                @foreach($game->MatchPlayers as $mp)
                                                    @if($mp->team_id == $bowling_team_id)
                                                        @if($mp->bw_status == '11')
                                                            <input type="hidden" value="{{$mp->player_id}}"
                                                                   name="attacker_id"/>
                                                        @endif
                                                    @endif
                                                @endforeach

                                                {{--wicket secondary--}}

                                            </div>
                                            <div id="div_batsman_cross" class="custom-control custom-switch mt-2 mr-3"
                                                 style="display: none">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="input_batsman_cross"
                                                       name="isBatsmanCross">
                                                <label class="custom-control-label" for="input_batsman_cross"></label>did
                                                batsman
                                                crossed ?
                                            </div>


                                            <div class="row" id="select_new_batsman">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect2">Select new Batsman</label>
                                                    <select class="form-control" id="select_new_batsman_input"
                                                            name="newBatsman_id" required>
                                                        <option disabled selected>Select</option>
                                                        @foreach($notout_batsman as $new_batsman)
                                                            <option
                                                                value="{{$new_batsman->player_id}}">{{$new_batsman->Players['first_name']}} {{$new_batsman->Players['last_name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{--                                    <div id="all_out">--}}
                                            {{--                                        <label for="input_batsman_cross" style="margin-top: 10px;margin-left: 20px">--}}
                                            {{--                                            All Out?</label>--}}
                                            {{--                                        <input type="checkbox" name="isBatsmanCross" id="input_batsman_cross"/>--}}
                                            {{--                                    </div>--}}

                                            <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                            <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">
                                            <input type="hidden" name="bw_team_id" value="{{$bowling_team_id}}">
                                            <input type="hidden" name="bt_team_id" value="{{$batting_team_id}}">
                                            <input type="hidden" name="value" value="W">


                                            <div class="modal-footer">
                                                <div id="all_out" class="custom-control custom-switch mt-2 mr-3">
                                                    <input type="checkbox" class="custom-control-input"
                                                           id="input_all_out"
                                                           name="all_out" onchange="all_out_function(this)">
                                                    <label class="custom-control-label" for="input_all_out"></label>All
                                                    Out ?
                                                </div>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-success ">Submit</button>
                                            </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                </div>

                <div class="modal" id="retiredHurtModal" tabindex="-1" data-backdrop="false" role="dialog"

                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Select New Batsman</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="retiredHurtBatsmanForm">
                                <div class="modal-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlSelect2">Select Retired Hurt
                                                Batsman</label>
                                            <select class="form-control" id="exampleFormControlSelect2"
                                                    name="retiredHurtBatsman_id"
                                                    required>
                                                <option selected disabled>Select</option>
                                                @foreach($current_batsman as $batsman)
                                                    <option
                                                        value="{{$batsman->player_id}}">{{$batsman->Players['first_name']}} {{$batsman->Players['last_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="exampleFormControlSelect2">Select new Batsman</label>
                                            <select class="form-control" id="exampleFormControlSelect2"
                                                    name="newBatsman_id"
                                                    required>
                                                <option disabled selected>Select</option>
                                                @foreach($notout_batsman as $new_batsman)
                                                    <option
                                                        value="{{$new_batsman->player_id}}">{{$new_batsman->Players['first_name']}} {{$new_batsman->Players['last_name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <input type="hidden" name="match_id" value="{{$game['match_id']}}">
                                    <input type="hidden" name="tournament" value="{{$game['tournament_id']}}">
                                    <input type="hidden" name="bw_team_id" value="{{$bowling_team_id}}">
                                    <input type="hidden" name="bt_team_id" value="{{$batting_team_id}}">
                                    <input type="hidden" name="value" value="rh">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-success ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--        </div>--}}

                @if($game)

                    <div class="tables">
                        @foreach($game->MatchDetail as $md)
                            @if($md->team_id == $batting_team_id)
                                <div class="col-md-12 team-name"><h3>{{$md->Teams->team_code}} <span
                                            id="team-score">{{$md->score}}</span>/<span
                                            id="team-wicket">{{$md->wicket}}</span> (<span
                                            id="team-over">{{$md->over}}</span>.<span
                                            id="team-overball">{{$md->overball}}</span>)</h3>

                                </div>
                            @endif
                        @endforeach

                        <form id="updateForm">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr class="bg-light">
                                    <th>Batsman</th>
                                    <th>R</th>
                                    <th>B</th>
                                    <th>4</th>
                                    <th>6</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($current_batsman as $batsman)
                                    <tr id="{{$batsman->bt_status}}">
                                        <td><input type="radio" id="player_id" name="player_id" disabled
                                                   value="{{$batsman->player_id}}"
                                                   @if($batsman->bt_status==11) checked @endif> {{$batsman->Players['first_name']}} {{$batsman->Players['last_name']}}
                                        </td>
                                        <input type="hidden" name="team_id" value="{{$batsman->team_id}}">
                                        <td id="batsman-runs">{{$batsman->bt_runs}}</td>
                                        <td id="batsman-balls">{{$batsman->bt_balls}}</td>
                                        <td id="batsman-fours">{{$batsman->bt_fours}}</td>
                                        <td id="batsman-sixes">{{$batsman->bt_sixes}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            <table class="table table-responsive-sm">
                                <thead>
                                <tr class="bg-light">
                                    <th>Bowler</th>
                                    <th>O</th>
                                    <th>M</th>
                                    <th>R</th>
                                    <th>W</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$current_bowler->Players['first_name']}} {{$current_bowler->Players['last_name']}}</td>
                                    <input type="hidden" value="{{$current_bowler->player_id}}" name="attacker_id">
                                    <td><span id="bowler-over">{{$current_bowler->bw_over}}</span>.<span
                                            id="bowler-overball">{{$current_bowler->bw_overball}}</span></td>
                                    <td id="bowler-maiden">{{$current_bowler->bw_maiden}}</td>
                                    <td id="bowler-runs">{{$current_bowler->bw_runs}}</td>
                                    <td id="bowler-wickets">{{$current_bowler->bw_wickets}}</td>

                                </tr>
                                <input type="hidden" name="match_id" value="{{$game->match_id}}">
                                <input type="hidden" name="tournament" value="{{$game->tournament_id}}">
                                </tbody>
                            </table>
                            <div id="current-over">
                                <span><h6 style="display:inline-block;font-weight: bold">Current Over : </h6></span>
                                @foreach($over as $o)

                                    @if($o->action == 'zero')
                                        <span>0</span>
                                    @elseif($o->action == 'one')
                                        <span>1</span>
                                    @elseif($o->action == 'two')
                                        <span>2</span>
                                    @elseif($o->action == 'three')
                                        <span>3</span>
                                    @elseif($o->action == 'four')
                                        <span>4</span>
                                    @elseif($o->action == 'five')
                                        <span>5</span>
                                    @elseif($o->action == 'six')
                                        <span>6</span>
                                    @elseif($o->action == 'wicket')
                                        <span>W</span>
                                    @else
                                        <span>{{$o->action}}</span>
                                    @endif
                                    @if($o->overball == 6)
                                        <span style="font-weight: bold; color: red"> | </span>
                                    @endif

                                @endforeach
                            </div>

                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(8)">0</a>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(1)">1</a>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(2)">2</a>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(3)">3</a>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(4)">4</a>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(5)">5</a>
                            <a class="btn btn-outline-success btn-square btn-sm mt-1 py-3 px-4 score-button"
                               onclick="livescore_function(6)">6</a>

                            <br><br>

                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button" onclick="livescore_function('wd')">wd</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button" onclick="livescore_function('nb')">nb</a>
                            <a id="wicket_button" class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="reset_form()">Wicket</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button" id="undo_button"
                               onclick="livescore_function('undo')">undo</a>

                            <br><br>

                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('sr')">Strike Rotate</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button" id="retired_hurt">Retired Hurt</a>

                            <br><br>

                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('nb1')">nb + 1</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('nb2')">nb + 2</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('nb3')">nb + 3</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('nb4')">nb + 4</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('nb5')">nb + 5</a>
                            <a class="btn btn-outline-danger btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('nb6')">nb + 6</a>

                            <br><br>

                            <a class="btn btn-outline-secondary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('wd1')">wd + 1</a>
                            <a class="btn btn-outline-secondary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('wd2')">wd + 2</a>
                            <a class="btn btn-outline-secondary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('wd3')">wd + 3</a>
                            <a class="btn btn-outline-secondary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('wd4')">wd + 4</a>

                            <br><br>

                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('lb1')">1 lb</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('lb2')">2 lb</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('lb3')">3 lb</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('lb4')">4 lb</a>

                            <br><br>

                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('b1')">1 b</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('b2')">2 b</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('b3')">3 b</a>
                            <a class="btn btn-outline-primary btn-square btn-sm mt-1 score-button"
                               onclick="livescore_function('b4')">4 b</a>

                            <br><br>


                        </form>
                    </div>


                @endif


                @endif
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function () {


                {{--var opening = {!! str_replace("'", "\'", json_encode($opening)) !!};--}}
            var isOver = {!! str_replace("'", "\'", json_encode($isOver)) !!};
            var total_over = {!! str_replace("'", "\'", json_encode($game->overs)) !!};
            var current_over = {!! str_replace("'", "\'", json_encode($current_over)) !!};
            var current_overball = {!! str_replace("'", "\'", json_encode($current_overball)) !!};

            if ((total_over == current_over - 1 && current_overball == 6) || total_over == current_over) {
                $('#endInningForm').submit();
            }
            else{
                if (isOver) {
                    $("#overModal").modal('show');
                }
            }




            $('.startInningButton').on('click', function () {
                $("#openingModal").modal('show');
            });


            $('#wicket_button').on('click', function () {
                $('#newBatsmanForm').trigger('reset');
                $("#wicketModal").modal('show');

                $('#div_wicket_primary').hide();
                $('#div_wicket_secondary').hide();


                $('#wicket_type').on('change', function () {
                    var wicket_type = $("#wicket_type").val();
                    if (wicket_type === 'catch') {
                        $('#wicket_secondary').prop('disabled', false);
                        $('#wicket_secondary').prop('required', true);
                        $('#label_wicket_secondary').html('Catch By');
                        // $('#label_wicket_primary').html('Bowl By');
                        // $('#div_wicket_primary').show();
                        $('#div_wicket_primary_runout').hide();
                        $('#div_wicket_secondary').show();
                        $('#div_batsman_cross').show();
                        $('#batsman_runout').hide();
                        $('#where_batsman_runout').hide();
                        $('#run_scored').hide();


                    }
                    if (wicket_type === 'stump') {
                        $('#wicket_secondary').prop('disabled', false);
                        $('#wicket_secondary').prop('required', true);
                        $('#label_wicket_secondary').html('Stumped By');
                        // $('#label_wicket_primary').html('Bowl By');
                        $('#div_wicket_primary_runout').hide();
                        // $('#div_wicket_primary').show();
                        $('#div_wicket_secondary').show();
                        $('#batsman_runout').hide();
                        $('#where_batsman_runout').hide();
                        $('#run_scored').hide();
                        $('#div_batsman_cross').hide();


                    }
                    if (wicket_type === 'runout') {
                        $('#wicket_secondary').prop('disabled', false);
                        $('#wicket_secondary').prop('required', false);
                        $('#label_wicket_secondary').html('Run out By(Optional)');
                        // $('#div_wicket_primary').hide();
                        $('#div_wicket_primary_runout').show();
                        $('#div_wicket_secondary').show();
                        $('#batsman_runout').show();
                        $('#where_batsman_runout').show();
                        $('#run_scored').show();
                        $('#batsman_runout').prop('required', true);
                        $('#where_batsman_runout').prop('required', true);
                        $('#run_scored_input').prop('required', true);
                        $('#div_batsman_cross').hide();


                    }
                    if (wicket_type === 'hitwicket') {
                        $('#wicket_secondary').prop('disabled', true);
                        // $('#label_wicket_primary').html('Bowl By');
                        $('#div_wicket_secondary').hide();
                        $('#div_wicket_primary_runout').hide();
                        // $('#div_wicket_primary').show();
                        $('#batsman_runout').hide();
                        $('#where_batsman_runout').hide();
                        $('#run_scored').hide();
                        $('#div_batsman_cross').hide();


                    }
                    if (wicket_type === 'bold') {
                        $('#wicket_secondary').prop('disabled', true);
                        // $('#label_wicket_primary').html('Bowled By');
                        $('#div_wicket_secondary').hide();
                        $('#div_wicket_primary_runout').hide();
                        $('#div_wicket_primary').show();
                        $('#batsman_runout').hide();
                        $('#where_batsman_runout').hide();
                        $('#run_scored').hide();
                        $('#div_batsman_cross').hide();


                    }
                    if (wicket_type === 'lbw') {
                        $('#wicket_secondary').prop('disabled', true);
                        // $('#label_wicket_primary').html('Bowl By');
                        $('#div_wicket_primary_runout').hide();
                        // $('#div_wicket_primary').show();
                        $('#div_wicket_secondary').hide();
                        $('#batsman_runout').hide();
                        $('#where_batsman_runout').hide();
                        $('#run_scored').hide();
                        $('#div_batsman_cross').hide();


                    }
                });

            });


        });


        $('#retired_hurt').on('click', function () {
            $("#retiredHurtModal").modal('show');
        });


        $(document).ready(function () {
            resetForms();
        });

        function reset_form() {
            $('#newBatsmanForm').trigger('reset');
        }

        function resetForms() {
            $('#newBatsmanForm').trigger('reset');
        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#endInningForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '{{Route('LiveUpdate')}}',
                data: $(this).serialize(),
                success: function (data) {
                    // $('#overModal').modal('hide');
                    //  alert(data.message);
                    location.reload(true);
                }

            });
        });

        $('#resetInningForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '{{Route('LiveUpdate')}}',
                data: $(this).serialize(),
                success: function (data) {
                    location.reload(true);
                }
            });
        });

        $('#bowlerForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '{{Route('LiveUpdate')}}',
                data: $(this).serialize(),
                success: function (data) {
                    $('#overModal').modal('hide');
                    //  alert(data.message);
                    location.reload(true);
                },
                error : function (data){
                    if(data.status === 422){
                        alert('please select a bowler');
                    }
                }
            });
        });

        // for wicket
        $('#newBatsmanForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '{{Route('LiveUpdate')}}',
                data: $(this).serialize(),
                success: function (data) {
                    $('#wicketModal').modal('hide');
                    //  alert(data.message);
                    location.reload(true);
                }
            });
        });

        $('#retiredHurtBatsmanForm').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '{{Route('LiveUpdate')}}',
                data: $(this).serialize(),
                success: function (data) {
                    $('#retiredHurtModal').modal('hide');
                    //  alert(data.message);
                    location.reload(true);
                },
                error : function (data){
                    alert(data.data);
                }
            });
        });


        //for opening batsman selection
        $('#modal').on('submit', function (e) {
            e.preventDefault();

            let strike_id = $("select[name=strike_id]").val();
            let nonstrike_id = $("select[name=nonstrike_id]").val();

            if (strike_id === nonstrike_id) {
                alert('Please select different Batsman.');
            } else {
                $.ajax({
                    type: "POST",
                    url: '{{Route('LiveUpdate')}}',
                    data: $(this).serialize(),
                    success: function (data) {
                        $('#bowlerModal').modal('hide');
                        location.reload(true);
                    },
                    error : function (data){
                        if(data.status === 422){
                            alert('Please select proper data');
                        }
                    }
                });
            }


        });


        $('.bt').on('click', function () {
            $('.bt').prop('disabled', true);
        });


        function all_out_function(object) {
            if ($(object).is(':checked')) {
                $('#select_new_batsman_input').prop('required', false);
            } else {
                $('#select_new_batsman_input').prop('required', true);
            }
        }

        function livescore_function(value) {

            var bt_team_id = "{{$batting_team_id}}";
            var bw_team_id = "{{$bowling_team_id}}";
            var match_id = $("input[name=match_id]").val();
            var tournament = $("input[name=tournament]").val();
            var attacker_id = $("input[name=attacker_id]").val();
            var player_id = $("input[name=player_id]:checked").val();
            var non_striker_id = $("input[name=player_id]:not(:checked)").val();


            $('.score-button').addClass('disabled');


            $.ajax({
                type: "POST",
                url: "{{route('LiveUpdate')}}",
                // headers: {'X-Requested-With': 'XMLHttpRequest'},
                data: {
                    {{--"_token": "{{ csrf_token() }}",--}}
                    player_id: player_id,
                    non_striker_id: non_striker_id,
                    attacker_id: attacker_id,
                    bt_team_id: bt_team_id,
                    bw_team_id: bw_team_id,
                    match_id: match_id,
                    tournament: tournament,
                    value: value
                },
                success: function (data) {
                    $('.score-button').removeClass('disabled');
                    $('#newBatsmanForm').trigger('reset');


                    if (data.value === '8' || data.value === '1' || data.value === '2' || data.value === '3' || data.value === '4' || data.value === '5' || data.value === '6') {
                        if (data.value == '8') {
                            $('#current-over').append("<span>0 </span>");

                        }

                        if (data.value != '8') {

                            $('#current-over').append("<span>" + data.value + " </span>");

                            var batsman_runs = $('#11').find('#batsman-runs').text();

                            $('#11').find("#batsman-runs").text(parseInt(batsman_runs) + parseInt(data.value));

                            var bowler_runs = $('#bowler-runs').text();
                            $('#bowler-runs').text(parseInt(bowler_runs) + parseInt(data.value));

                            var team_score = $('#team-score').text();
                            $('#team-score').text(parseInt(team_score) + parseInt(data.value));
                        }


                        var batsman_balls = $('#11').find('#batsman-balls').text();
                        $('#11').find("#batsman-balls").text(parseInt(batsman_balls) + 1);


                        var bowler_balls = $('#bowler-overball').text();
                        $('#bowler-overball').text(parseInt(bowler_balls) + 1);


                        var team_overball = $('#team-overball').text();
                        $('#team-overball').text(parseInt(team_overball) + 1);


                        if (data.value === '1' || data.value === '3' || data.value === '5') {
                            $('#10').find('input').prop('checked', true);

                            $('#10').attr('id', 'temp');
                            $('#11').attr('id', '10');
                            $('#temp').attr('id', '11');
                        }


                        if (data.isEndInning === true){
                            $('#endInningForm').submit();
                        }
                        else{
                            if (data.isOver === 1) {
                                $("#overModal").modal('show');
                            }
                        }


                    } else if (data.value === 'wd') {
                        $('#current-over').append("<span>" + data.value + " </span>");

                        var team_score = $('#team-score').text();
                        $('#team-score').text(parseInt(team_score) + parseInt('1'));


                        var bowler_runs = $('#bowler-runs').text();
                        $('#bowler-runs').text(parseInt(bowler_runs) + parseInt('1'));

                    } else if (data.value === 'nb') {
                        $('#current-over').append("<span>" + data.value + " </span>");

                        var team_score = $('#team-score').text();
                        $('#team-score').text(parseInt(team_score) + 1);


                        var bowler_runs = $('#bowler-runs').text();
                        $('#bowler-runs').text(parseInt(bowler_runs) + 1);

                        var batsman_balls = $('#11').find('#batsman-balls').text();
                        $('#11').find("#batsman-balls").text(parseInt(batsman_balls) + 1);

                    } else if (data.value === 'sr') {
                        $('#10').find('input').prop('checked', true);

                        $('#10').attr('id', 'temp');
                        $('#11').attr('id', '10');
                        $('#temp').attr('id', '11');
                    } else {
                        location.reload(true);

                    }
                },
                error: function (data) {
                    $('.score-button').removeClass('disabled');
                    alert('something went wrong');
                }
            });

        }
    </script>
@endsection
