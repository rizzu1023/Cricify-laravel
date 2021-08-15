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
                    <a href="/admin/LiveUpdate/{{$matchs->match_id}}/{{$matchs->tournament_id}}" class="btn btn-info"
                    >Live Score</a>
                </div>
                <div class="card-body">
                    <h4 class="score">{{$batting_team->Teams->team_name}} {{$batting_team->score}}-{{$batting_team->wicket}} ({{$batting_team->over}}.{{$batting_team->overball}})</h4>

                    <table class="table  table-responsive-sm">
                        <thead>
                        <tr class="bg-light">
                            <th>Batsman</th>
                            <th></th>
                            <th>Runs</th>
                            <th>Balls</th>
                            <th>Fours</th>
                            <th>Sixes</th>
                            <th>SR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($batting_team_players as $m)
                            <tr>
                                    <td>
                                        @if($m->bt_status == 10 || $m->bt_status == 11)
                                            <b>{{$m->Players->first_name}} {{$m->Players->last_name}}</b>
                                        @else
                                            {{$m->Players->first_name}} {{$m->Players->last_name}}
                                        @endif
                                    </td>
                                    <td style="font-size: 13px">
                                        @if($m->bt_status == 'DNB')
                                            DNB
                                        @elseif($m->bt_status == 0 && $m->wicket_type == 'bold')
                                            <b>b</b> {{$m->wicketPrimary->first_name}} {{$m->wicketPrimary->first_name}}
                                        @elseif($m->bt_status == 0 && $m->wicket_type == 'lbw')
                                            <b>lbw</b> {{$m->wicketPrimary->first_name}} {{$m->wicketPrimary->last_name}}
                                        @elseif($m->bt_status == 0 && $m->wicket_type == 'catch')
                                            <b>c</b> {{$m->wicketSecondary->first_name}} {{$m->wicketSecondary->last_name}}
                                            <b>b</b> {{$m->wicketPrimary->first_name}} {{$m->wicketPrimary->last_name}}
                                        @elseif($m->bt_status == 0 && $m->wicket_type == 'stump')
                                            <b>st</b> {{$m->wicketSecondary->first_name}} {{$m->wicketSecondary->last_name}}
                                            <b>b</b> {{$m->wicketPrimary->first_name}} {{$m->wicketPrimary->last_name}}
                                        @elseif($m->bt_status == 0 && $m->wicket_type == 'runout')
                                            @if($m->wicket_secondary == NULL || $m->wicket_secondary == '--')
                                                <b>runout</b>
                                                ({{$m->wicketPrimary->first_name}} {{$m->wicketPrimary->last_name}})
                                            @else
                                                <b>runout</b>
                                                ({{$m->wicketPrimary->first_name}} {{$m->wicketPrimary->last_name}}
                                                /{{$m->wicketSecondary->first_name}} {{$m->wicketSecondary->last_name}})
                                            @endif
                                        @elseif($m->bt_status == 10 || $m->bt_status == 11)
                                            batting
                                        @endif
                                    </td>
                                    <td>{{$m->bt_runs}}</td>
                                    <td>{{$m->bt_balls}}</td>
                                    <td>{{$m->bt_fours}}</td>
                                    <td>{{$m->bt_sixes}}</td>
                                    @php
                                        $sr = 0;
                                        if($m->bt_balls > 0){
                                        $srs = ($m->bt_runs/$m->bt_balls)*100;
                                        $sr = number_format((float)$srs, 2, '.', '');
                                        }
                                    @endphp
                                    <td>{{$sr}}</td>
                                </tr>
                        @endforeach

                        <tr style="border-top: 1.5px solid black;">
                            <td>Total</td>
                            <td></td>
                                    <td colspan="4">
                                        {{$batting_team->score}} ({{$batting_team->wicket}} wickets, {{$batting_team->over}}.{{$batting_team->overball}} overs)
                                    </td>
                        </tr>
                        <tr>
                            <td>Extras</td>
                            <td></td>
                                    <td colspan="4">
                                        {{$batting_team->byes + $batting_team->legbyes + $batting_team->no_ball + $batting_team->wide}} (b {{$batting_team->byes}},
                                        lb {{$batting_team->legbyes}}, w {{$batting_team->wide}}, nb {{$batting_team->no_ball}})
                                    </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-responsive-sm">
                        <thead>
                        <tr class="bg-light">
                            <th>Bowler</th>
                            <th></th>
                            <th>Overs</th>
                            <th>Maiden</th>
                            <th>Runs</th>
                            <th>Wicket</th>
                            <th>NB</th>
                            <th>WD</th>
                            <th>Eco</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bowling_team_players as $m)
                            @if($m->bw_status == 1 || $m->bw_status == 11)
                                <tr>
                                        <td>
                                            @if($m->bw_status == 11)
                                                <b>{{$m->Players->first_name}} {{$m->Players->last_name}}</b>
                                            @else
                                                {{$m->Players->first_name}} {{$m->Players->last_name}}
                                            @endif
                                        </td>
                                        <input type="hidden" value="{{$m->player_id}}" name="attacker_id">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>{{$m->bw_over}}.{{$m->bw_overball}}</td>
                                        <td>{{$m->bw_maiden}}</td>
                                        <td>{{$m->bw_runs}}</td>
                                        <td>{{$m->bw_wickets}}</td>
                                        @php
                                            $sr = 0;
                                            if($m->bt_balls > 0){
                                            $srs = ($m->bt_runs/$m->bt_balls)*100;
                                            $sr = number_format((float)$srs, 2, '.', '');
                                            }
                                        @endphp
                                        <td>{{$m->bw_nb}}</td>
                                        <td>{{$m->bw_wide}}</td>
                                        <td>{{$sr}}</td>
                                    </tr>
                            @endif
                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
