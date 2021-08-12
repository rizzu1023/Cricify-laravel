@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Schedule</h3>
                        <a style="float: right" class="btn btn-success btn-sm"
                           href="{{route('tournaments.schedules.create',$tournament->id)}}"><i class="fa fa-plus"></i>Add</a>
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
                    <div class="tables">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Team 1</th>
                                <th>Vs</th>
                                <th>Team 2</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schedule as $s)
                                <tr>

                                    <th scope="row">{{$s->match_no}}</th>

                                    <td> @if($s->Game)
                                            @if($s->Game->status == 4)
                                                <a class="btn btn-dark btn-sm"
                                                   href="/admin/result/{{$s->Game->tournament_id}}/{{$s->Game->match_id}}/show">Result</a>
                                            @else
                                                <a class="btn btn-primary btn-sm"
                                                   href="/admin/LiveUpdate/{{$s->id}}/{{$s->tournament_id}}">Score</a>
                                            @endif

                                        @else
                                            <a class="btn btn-warning btn-sm"
                                               href="/admin/StartScore/{{$s->id}}">Start</a>
                                        @endif</td>
                                    <td>{{ date('d-M-Y', strtotime($s->dates))}}</td>
                                    <td>{{ date('h:m A', strtotime($s->times))}}</td>
                                    <td>{{$s->Teams1->team_code}}</td>
                                    <td>Vs</td>
                                    <td>{{$s->Teams2->team_code}}</td>

                                    <td>
                                        @if(!$s->Game)
                                        <a class="btn btn-success btn-sm"
                                               href="/admin/tournaments/{{$tournament->id}}/schedules/{{$s->id}}/edit">Edit</a>

                                        <form style="display:inline-block" method="POST"
                                              action="/admin/tournaments/{{$tournament->id}}/schedules/{{$s->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$s->id}}" name="id">
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete it?')">
                                                Delete
                                            </button>


                                        </form>
                                        @endif
                                    </td>

                                </tr>
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
