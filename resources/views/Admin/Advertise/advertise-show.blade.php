@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Admin</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">                                       <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item"><a href="/admin/feedbacks">Feedbacks</a></li>
                            <li class="breadcrumb-item">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="card-body">
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <label class="col-sm-3" for="validationCustom01">Name</label>
                                                        <div class="col-sm-9">
                                                            <img height="50px" width=80px"
                                                                 src="{{ $advertise->getFirstMedia('advertise-image') ? $advertise->getFirstMedia('advertise-image')->getUrl('compressed-image') : asset("images/avatar.png") }}"
                                                                 alt="img not found">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-sm-3">Name</label>
                                                        <div class="col-sm-9">
                                                            <div>{{ $advertise['name'] }}</div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Height</label>
                                                        <div class="col-sm-9">
                                                            <div>{{ $advertise['height'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row ">
                                                        <label class="col-sm-3 col-form-label">Tournament Id</label>
                                                        <div class="col-sm-9">
                                                            <div>{{ $advertise['tournament_id'] }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3">Start Date</label>
                                                        <div class="col-sm-9">
                                                            <div>{{ date('d-m-Y',strtotime($advertise['start_date'])) }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3">End Date</label>
                                                        <div class="col-sm-9">
                                                            <div>{{ date('d-m-Y',strtotime($advertise['end_date'])) }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            <a class="btn btn-primary mt-3 float-right" href="/admin/blogs/{{$advertise['id']}}/edit">Edit</a>--}}
                                            <a class="btn btn-success mt-3 float-right" href="/admin/feedbacks/">back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('js')



@endsection


