


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
                <div class="card-body">
                    @if(count($result) > 0)
                        <h3 class="title1">Results</h3>
                        <div class="tables">
                            <table class="table table-responsive-sm">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Match No</th>
                                    <th>Team 1</th>
                                    <th>Vs</th>
                                    <th>Team 2</th>
                                </tr>
                                </thead>
                                <tbody>
                                @for($i=0 ; $i<count($result); $i=$i+2)
                                    <tr>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="/admin/result/{{$result[$i]->tournament_id}}/{{$result[$i]->match_id}}/show">Show</a>
                                            <a class="btn btn-primary btn-sm" href="/admin/LiveUpdate/{{$result[$i]->match_id}}/{{$result[$i]->tournament_id}}">Score</a>
                                        </td>
                                        <th scope="row">{{$result[$i]->match_id}}</th>
                                        <td>{{$result[$i]->Teams->team_name}}</td>
                                        <td>Vs</td>
                                        <td>{{$result[$i+1]->Teams->team_name}}</td>
                                        <td>
                                            <form action="{{route('result.destroy')}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input type="hidden" value="{{$result[$i]->match_id}}" name="match_id">
                                                <input type="hidden" value="{{$result[$i]->tournament_id}}" name="tournament"/>
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete it?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>
                        </div>

                    @else
                        <div class="container">
                            <p>No results found</p>
                        </div>
                    @endif



                </div>
            </div>

            </div>
        </div>
        <!-- Container-fluid Ends-->
@endsection
