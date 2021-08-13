@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <a class="btn btn-primary" href="{{route('Tournament.create')}}" ><i class="fa fa-plus"></i> Create Tournament</a>
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
                {{--                class="fa fa-plus"></i> Create Tournament</a>--}}
            @foreach($Tournament as $t)
                <div class="card b-r-0">
                    <div class="card-header">
                        <h4 style="display: inline-block">{{$loop->iteration}}</h4>
                        <div style="float: right">
                            <a class="btn btn-success btn-sm" href="/admin/Tournament/{{$t->id}}/edit"> Edit </a>
                            <form style="display:inline-block" method="POST" action="/admin/Tournament/{{$t->id}}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure you want to delete it?')" class="btn btn-danger btn-sm"> Delete </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-5">
                            <h2>{{$t->tournament_name}}</h2>
                            <span>{{$t->start_date}} to</span><span> {{$t->end_date}}</span>
                        </div>
                        <a class="btn btn-secondary btn-md mt-1" href="/admin/tournaments/{{$t->id}}/teams">Teams</a>
                        <a class="btn btn-success btn-md mt-1" href="/admin/tournaments/{{$t->id}}/schedules">Schedule</a>
                        <a class="btn btn-primary btn-md mt-1" href="/admin/tournaments/{{$t->id}}/results">Results</a>
                        <a class="btn btn-info btn-md mt-1" href="/admin/tournaments/{{$t->id}}/groups">Groups</a>
                        <a class="btn btn-warning btn-md mt-1" href="/admin/tournaments/{{$t->id}}/points-table">Points Table</a>

                    </div>
                </div>
            @endforeach
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@section('js')

@endsection
