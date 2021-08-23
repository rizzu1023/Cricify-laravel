@extends('Admin.layouts.base')

@section('css')
        <link rel="stylesheet" type="text/css" href="{{asset('Assets/Admin/css/vendors/datatables.css')}}">
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Players</h3>
                        <a style=" float: right" class="btn btn-success btn-sm " href="/admin/player/create"><i class="cil-user-plus"></i> Add New</a>

                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Players</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            @include('Admin.layouts.message')
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="table-responsive product-table">
                        <table class="display dataTable" id="basic-1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Player ID</th>
                                <th>Player Name</th>
                                <th>Player Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($players as $p)
                                <tr id="{{$p->id}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td class="text-center"><img height="50px" width=50px" src="{{ $p->getFirstMedia('player-image') ? $p->getFirstMedia('player-image')->getUrl('player-profile') : asset("images/avatar.png") }}" alt="img not found"></td>
                                    <td>
                                        <h6> {{$p->player_id}}</h6>
                                        {{--                    <span>Interchargebla lens Digital Camera with APS-C-X Trans CMOS Sens</span>--}}
                                    </td>
                                    <td>{{$p->first_name}} {{$p->last_name}}</td>
                                    <td>{{$p->Role->name}}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="/admin/player/{{$p->player_id}}">Details</a>
                                        <a class="btn btn-success btn-sm" href="/admin/player/{{$p->player_id}}/edit">Edit</a>
                                        <form style="display:inline-block" method="POST"
                                              action="/admin/player/{{$p->player_id}}">
                                        @csrf
                                        @method('DELETE')
                                        <!-- <input type="hidden" value="#" name="id"> -->
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this player?');">
                                                Delete
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
        <!-- Container-fluid Ends-->
    </div>
@endsection

@section('js')
            <script src="{{asset('assets/Admin/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('assets/Admin/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection



