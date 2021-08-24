@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>App Users</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">App Users</li>
                            {{--              <li class="breadcrumb-item active">Product list</li>--}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden b-r-0">
                        <div class="bg-primary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="database"></i></div>
                                <div class="media-body"><span class="m-0">New Users (Today)</span>
                                    <h4 class="mb-0 counter">{{$newUsers}}</h4><i class="icon-bg"
                                                                               data-feather="database"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden b-r-0">
                        <div class="bg-secondary b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="user-plus"></i></div>
                                <div class="media-body"><span class="m-0">App Visits (Today)</span>
                                    <h4 class="mb-0 counter">{{$appUsed}}</h4><i class="icon-bg"
                                                                                 data-feather="shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden b-r-0">
                        <div class="bg-success b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="message-circle"></i></div>
                                <div class="media-body"><span class="m-0">Total Users</span>
                                    <h4 class="mb-0 counter">{{ $totalUsers }}</h4><i class="icon-bg"
                                                                                     data-feather="message-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 col-lg-6">
                    <div class="card o-hidden b-r-0">
                        <div class="bg-info b-r-4 card-body">
                            <div class="media static-top-widget">
                                <div class="align-self-center text-center"><i data-feather="shopping-bag"></i></div>
                                <div class="media-body"><span class="m-0">Matches</span>
                                    <h4 class="mb-0 counter">0</h4><i class="icon-bg"
                                                                                 data-feather="user-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    @include('Admin.layouts.message')
                    <div class="tables">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>IP Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Hit Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($appUsers as $f)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$f->ip_address}}</td>
                                    <td>{{$f->city}}</td>
                                    <td>{{$f->state}}</td>
                                    <td>{{$f->country}}</td>
                                    <td>{{$f->hit_count}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection















