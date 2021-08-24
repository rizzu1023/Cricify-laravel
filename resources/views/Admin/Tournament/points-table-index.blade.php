@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Points Table</h3>
{{--                        <a class="btn btn-success btn-sm " href="/admin/tournaments/{{$tournament->id}}/points-table/edit"><i--}}
{{--                                class="cil-user-plus"></i> Update</a>--}}
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/admin/Tournament">Tournaments</a></li>
                            {{--                            <li class="breadcrumb-item "><a href="/admin/tournaments/{{$group->Tournament->id}}/groups">Groups </a></li>--}}
                            <li class="breadcrumb-item active ">Teams</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            @foreach($points_table as $group)

                <div class="card">
                    <div class="card-header">
                        <h5>Group {{ $group['group_name'] }}</h5>
                        {{--                    <a class="btn btn-primary" type="button" href="/admin/groups/{{$group->id}}/teams/create"><i class="fa fa-plus"></i> Add Team</a>--}}
                    </div>
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-styling" id="group-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">Team Name</th>
                                        <th scope="col">M</th>
                                        <th scope="col">W</th>
                                        <th scope="col">L</th>
                                        <th scope="col">D</th>
                                        <th scope="col">P</th>
                                        <th scope="col">NRR</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="group-table-body">
                                    @foreach($group['teams'] as $team)
                                        <tr id="{{$team->id}}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $team->Teams->team_name}}</td>
                                            <td>{{ $team->match }}</td>
                                            <td>{{ $team->won }}</td>
                                            <td>{{ $team->lost }}</td>
                                            <td>{{ $team->draw }}</td>
                                            <td>{{ $team->points }}</td>
                                            <td>{{ $team->nrr }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-outline-primary" href="/admin/groups/{{$team->group_id}}/teams/{{$team->team_id}}/edit">Edit</a>
                                                {{--                                            <a class="btn btn-sm btn-outline-success" type="button"   data-toggle="modal" data-target="#exampleModalCenter" title="">Edit</a>--}}
                                                <form id="team-form" method="post" style="display: inline-block"
                                                      action="/admin/groups/{{$team->group_id}}/teams/{{$team->team_id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger" type="submit">Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
