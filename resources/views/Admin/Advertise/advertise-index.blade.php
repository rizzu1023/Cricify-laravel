@extends('Admin.layouts.base')

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h3>Advertise</h3>
                        {{--                                <a class="btn btn-success btn-sm mr-2" href="{{ Route('feedbacks.create') }}"><i class="cil-user-plus"></i> Add New Team</a>--}}
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard"> <i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Advertise</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-success btn-sm mb-3 " href="/admin/advertise/create"><i class="fa fa-plus"></i>Add
                        New Advertise</a>
                </div>
                <div class="card-body">
                    @include('Admin.layouts.message')
                    <div class="tables">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($advertise as $a)
                                <tr>

                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="text-center"><img height="50px" width=80px"
                                                                 src="{{ $a->getFirstMedia('advertise-image') ? $a->getFirstMedia('advertise-image')->getUrl('compressed-image') : asset("images/avatar.png") }}"
                                                                 alt="img not found"></td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->page}}</td>
                                    <td >
                                        <div class="media-body  switch-sm">
                                            <label class="switch">
                                                <input type="checkbox" onchange="toggle_status_function({{$a->id}})" @if($a->status) checked=""@endif ><span class="switch-state" ></span>
                                            </label>
                                        </div>
                                        {{--                                                    </div>--}}
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-sm"
                                           href="/admin/advertise/{{$a->id}}"> Details </a>
                                        <a class="btn btn-success btn-sm"
                                           href="/admin/advertise/{{$a->id}}/edit"> Edit </a>
                                        <form style="display:inline-block" method="POST"
                                              action="/admin/advertise/{{$a->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this team?')">
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
<script>
    function toggle_status_function(advertise_id){
        $.ajax({
            type : 'GET',
            url  : "/super-admin/advertise/status/toggle/" + advertise_id,
            data : {
                "_token": "{{ csrf_token() }}",
            },
            success : function(data){
                if(data.status){
                    $.notify({
                            // title:'Title',
                            message:'Success'
                        },
                        {
                            type:'success',
                            allow_dismiss:false,
                            newest_on_top:false ,
                            mouse_over:false,
                            showProgressbar:false,
                            spacing:10,
                            timer:500,
                            placement:{
                                from:'top',
                                align:'right'
                            },
                            offset:{
                                x:30,
                                y:60
                            },
                            delay:500,
                            z_index:10000,
                            animate:{
                                enter:'animated fadeIn',
                                exit:'animated fadeOut'
                            }
                        });
                };
            },
            error : function(data){
                alert('something went wrong');
            },
        });
    }
</script>
@endsection
