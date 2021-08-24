@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Users</h3>
                        {{--                                <a class="btn btn-success btn-sm mr-2" href="{{ Route('feedbacks.create') }}"><i class="cil-user-plus"></i> Add New Team</a>--}}
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                    @include('Admin.layouts.message')
                    <div class="tables">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $f)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$f->name}}</td>
                                    <td>{{$f->email}}</td>
                                    <td>{{$f->active}}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm"
                                           href="/super-admin/users/{{$f->id}}"> Details </a>

                                        <form style="display:inline-block" method="POST"
                                              action="/super-admin/users/{{$f->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">
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

@endsection
